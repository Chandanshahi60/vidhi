<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Admin_setup;
use App\Models\Unit;
use App\Models\Building;
use App\Models\Owner;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class AdminSetupController extends Controller
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

            $data = Admin_setup::where(function($query){
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

                        $btn = '<a href="'.route("admin_setup-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("admin_setup-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('admin_setup-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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
                    ->addColumn('photo',function($row){
                        if(File::exists( public_path( $row->photo ) ) && $row->photo!=null){
                            $profile = url($row->photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Admin setup";
        $data['url'] = route('admin_setup-list');

        return view('admin.settings.admin_setup.admin_setup',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $building= Building::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Admin setup";
        $data['url'] = route('admin_setup-save');

        $owner = Owner::get();
        return view('admin.settings.admin_setup.admin_setup-create',compact('unit','floor','data','owner','building'));
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
           'contact_no' => 'required',
           'password' => 'required',
           'present_address' => 'required',
           'branch' => 'required',
           'photo' => 'required',
           'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Admin_setup();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->contact_no = $request->contact_no;
        $service->password = $request->password;
        $service->present_address = $request->present_address;
        $service->branch = $request->branch;
        if($request->hasFile('photo'))
        {
            $image = 'Admin_setup_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/admin_setup'), $image);
            $image = "/uploads/admin_setup/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Admin setup created successfully'
			]);

    }


    public function show($id){

        $admin_setup = Admin_setup::find($id);
        $data = array();
        $data['title'] = "View Admin setup";
        return view('admin.settings.admin_setup.admin_setup-show',compact('admin_setup','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $owner = Owner::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $post = Admin_setup::find($id);
        $data['title'] = "Edit Admin setup";
        $data['url'] = route('admin_setup-update',$id);
        return view('admin.settings.admin_setup.admin_setup-create',compact('unit','floor','post','data','owner'));
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
            'contact_no' => 'required',
            'password' => 'required',
            'present_address' => 'required',
            'branch' => 'required',
            // 'photo' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Admin_setup::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->contact_no = $request->contact_no;
        $service->password = $request->password;
        $service->present_address = $request->present_address;
        $service->branch = $request->branch;
        if($request->hasFile('photo'))
        {
            $image = 'Admin_setup_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/admin_setup'), $image);
            $image = "/uploads/admin_setup/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Admin setup updated successfully'
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
        Admin_setup::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Admin setup deleted successfully'
			]);
    }
}
