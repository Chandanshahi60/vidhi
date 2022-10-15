<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\MaintenanceCost;
use App\Models\Unit;
use App\Models\Year;
use App\Models\Month;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class MaintenanceCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $society_id;

     public function __construct()
     {
        $this->society_id = session()->get('society_id');
     }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = MaintenanceCost::where(function($query){
                                    if(Auth()->user()->hasRole('Super Admin')){
                                        $query->where('society_id',session()->get('society_id'));
                                    }
                                    else{
                                        $query->where('user_id',Auth()->guard('admin')->user()->id);
                                    }
                            })
                            ->latest()
                            ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("maintenanceCost-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("maintenanceCost-view", $row->id).'" class="edit btn btn-primary "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('maintenanceCost-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">Due</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Paid</span>';
                        }
                        return $status;

                    })

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List MaintenanceCost";
        $data['url'] = route('maintenanceCost-list');

        return view('admin.maintenanceCost.maintenanceCost',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = Year::get();
        $month = Month::get();
        $data = array();
        $data['title'] = "Create MaintenanceCost";
        $data['url'] = route('maintenanceCost-save');

        return view('admin.maintenanceCost.maintenanceCost-create',compact('data','year','month'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'title' => 'required',
            'amount' => 'required',
            'details' => 'required',
           // 'status' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new MaintenanceCost();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->date = $request->date;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->title = $request->title;
        $service->amount = $request->amount;
        $service->detail = $request->detail;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'MaintenanceCost created successfully'
			]);

    }


    public function show($id){

        $maintenence = MaintenanceCost::find($id);
        $data = array();
        $data['title'] = "View MaintenanceCost";
        return view('admin.maintenanceCost.maintenanceCost-show',compact('maintenence','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $year = Year::get();
        $month = Month::get();

        $post = MaintenanceCost::find($id);
        $data['title'] = "Edit MaintenanceCost";
        $data['url'] = route('maintenanceCost-update',$id);
        return view('admin.maintenanceCost.maintenanceCost-create',compact('post','data','year','month'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'title' => 'required',
            'amount' => 'required',
            'details' => 'required',
           // 'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = MaintenanceCost::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->date = $request->date;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->title = $request->title;
        $service->amount = $request->amount;
        $service->detail = $request->detail;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'MaintenanceCost updated successfully'
			]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MaintenanceCost::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'MaintenanceCost deleted successfully'
			]);
    }
}
