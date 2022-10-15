<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\Owner;
use App\Models\Fund;
use App\Models\Year;
use App\Models\Month;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class FundController extends Controller
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

            $data = Fund::with('owner')->where(function($query){
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

                        $btn = '<a href="'.route("fund-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("fund-view", $row->id).'" class="edit btn btn-primary "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('fund-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Fund";
        $data['url'] = route('fund-list');
        // echo session()->get('society_id');
        // exit;

        return view('admin.fund.fund',compact('data'));
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
        $data['title'] = "Create Fund";
        $data['url'] = route('fund-save');

        $owner = Owner::get();
        return view('admin.fund.fund-create',compact('data','owner','month','year'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'issue_date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'total_amt' => 'required',
            'purpose' => 'required',
         //   'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Fund();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->owner_name = $request->owner_name;
        $service->issue_date = $request->issue_date;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->total_amt = $request->total_amt;
        $service->purpose = $request->purpose;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Fund created successfully'
			]);

    }


    public function show($id){

        $fund = Fund::find($id);
        $data = array();
        $data['title'] = "View Fund";
        return view('admin.fund.fund-show',compact('fund','data'));
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
        $owner = Owner::get();
        $post = Fund::find($id);
        $data['title'] = "Edit Fund";
        $data['url'] = route('fund-update',$id);
        return view('admin.fund.fund-create',compact('post','data','owner','year','month'));
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
            'owner_name' => 'required',
            'issue_date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'total_amt' => 'required',
            'purpose' => 'required',
          //  'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Fund::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->owner_name = $request->owner_name;
        $service->issue_date = $request->issue_date;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->total_amt = $request->total_amt;
        $service->purpose = $request->purpose;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Fund updated successfully'
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
        Fund::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Fund deleted successfully'
			]);
    }
}
