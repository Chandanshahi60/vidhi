<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expenses_record;
use App\Models\Vendor;
use App\Models\Floor;
use App\Models\Unit;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class Expenses_recordController extends Controller
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

            $data = Expenses_record::where(function($query){
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

                        $btn = '<a href="'.route("expenses_record-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("expenses_record-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('expenses_record-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">InActive</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Active</span>';
                        }
                        return $status;

                    })

                    ->addColumn('expenses_record_photo',function($row){
                        if(File::exists( public_path( $row->expenses_record_photo ) ) && $row->expenses_record_photo!=null){
                            $profile = asset($row->expenses_record_photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','expenses_record_photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Expenses_record";
        $data['url'] = route('expenses_record-list');

        return view('admin.expenses_record.expenses_record',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $vendor = Vendor::get();
        $data = array();
        $data['title'] = "Create Expenses_record";
        $data['url'] = route('expenses_record-save');
        return view('admin.expenses_record.expenses_record-create',compact('vendor','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title'=>'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Expenses_record();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->description = $request->description;
        $service->vendor =  $request->vendor;
        $service->account = $request->account;
        $service->amount = $request->amount;
        $service->approvers = $request->approvers;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Expenses_record created successfully'
			]);

    }


    public function show($id){

        $expenses_record = Expenses_record::with('vendor')->find($id);
        // prd($expenses_record);
        $data = array();
        $data['title'] = "View Expenses_record";
        return view('admin.expenses_record.expenses_record-show',compact('expenses_record','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $vendor = Vendor::get();

        $post = Expenses_record::find($id);
        $data['title'] = "Edit Expenses_record";
        $data['url'] = route('expenses_record-update',$id);
        $floor= Floor::get();
        $unit= Unit::get();

        return view('admin.expenses_record.expenses_record-create',compact('post','vendor','data','floor','unit'));
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
            'title'=>'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Expenses_record::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->description = $request->description;
        $service->vendor =  $request->vendor;
        $service->account = $request->account;
        $service->amount = $request->amount;
        $service->approvers = $request->approvers;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Expenses_record updated successfully'
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
        Expenses_record::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Expenses_record deleted successfully'
			]);
    }
}
