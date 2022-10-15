<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Managementcommittee;
use App\Models\Unit;
use App\Models\Owner;
use App\Models\CommitteeGroup;
use App\Models\Management_member_type;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class ManagementCommitteeController extends Controller
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

            $data = Managementcommittee::where(function($query){
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

                        $btn = '<a href="'.route("management_committee-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("management_committee-view", $row->id).'" class="edit btn btn-primary "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('management_committee-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">Inactive</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Active</span>';
                        }
                        return $status;

                    })

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Management Committee";
        $data['url'] = route('management_committee-list');

        return view('admin.management_committee.management_committee',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = CommitteeGroup::get();
        $management_member = Management_member_type::get();
        $floor= Floor::get();
        $owner= Owner::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Management Committee";
        $data['url'] = route('management_committee-save');

        return view('admin.management_committee.management_committee-create',compact('data','group','floor','unit','owner','management_member'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
             'name' => 'required',
             'email' => 'required',
             'phone' => 'required',
             'password' => 'required',
             'present_address' => 'required',
             'permanent_address' => 'required',
             'designation' => 'required',
             'joining_date' => 'required',
             'ending_date' => 'required',
             'photo' => 'required',
           //  'status' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Managementcommittee();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->owner_id = $request->owner_id;
        $service->name = $request->name;
        $service->committe_name = $request->committe_name;
        $service->group_id = $request->group_id;
        $service->email = $request->email;
        $service->phone = $request->phone;
        $service->password = $request->password;
        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->designation = $request->designation;
        $service->joining_date = $request->joining_date;
        $service->ending_date = $request->ending_date;
        if($request->hasFile('photo'))
        {
            $image = 'managementcommittee_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/managementcommittee_'), $image);
            $image = "/uploads/managementcommittee_/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Management Committee created successfully'
			]);

    }


    public function show($id){

        $management = Managementcommittee::find($id);
        $data = array();
        $data['title'] = "View Management Committee";
        return view('admin.management_committee.management_committee-show',compact('management','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $management_member = Management_member_type::get();
        $group = CommitteeGroup::get();
        $post = Managementcommittee::find($id);
        $data['title'] = "Edit ManagementCommittee";
        $data['url'] = route('management_committee-update',$id);
        $owner= Owner::get();

        $floor= Floor::get();
        $unit= Unit::get();
        return view('admin.management_committee.management_committee-create',compact('post','group','data','floor','unit','owner','management_member'));
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
            'name' => 'required',
             'email' => 'required',
             'phone' => 'required',
             'password' => 'required',
             'present_address' => 'required',
             'permanent_address' => 'required',
             'designation' => 'required',
             'joining_date' => 'required',
             'ending_date' => 'required',
             //'photo' => 'required',
           //  'status' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Managementcommittee::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->owner_id = $request->owner_id;
        $service->name = $request->name;
        $service->committe_name = $request->committe_name;
        $service->group_id = $request->group_id;
        $service->email = $request->email;
        $service->phone = $request->phone;
        $service->password = $request->password;
        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->designation = $request->designation;
        $service->joining_date = $request->joining_date;
        $service->ending_date = $request->ending_date;
        if($request->hasFile('photo'))
        {
            $image = 'managementcommittee_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/managementcommittee_'), $image);
            $image = "/uploads/managementcommittee_/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Management Committee updated successfully'
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
        Managementcommittee::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Management Committee deleted successfully'
			]);
    }



    public function group_create()
    {
        $data = array();
        $data['title'] = "Create Committee Group";
        $data['url'] = route('management_committee-group_save');

        return view('admin.management_committee.management_committee-group_create',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function group_store(Request $request){

        $validator = Validator::make($request->all(), [
             'name' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new CommitteeGroup();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Committee Group created successfully'
			]);

    }
}
