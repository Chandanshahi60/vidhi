<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Admin::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("user-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i></a>
                        <a  style="margin-right: 15px;" href="'.route("user-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('user-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('profile_image',function($row){
                        if(File::exists( public_path( $row->profile_image ) ) && $row->profile_image!=null){
                            $profile = url($row->profile_image);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })
                    ->rawColumns(['action','profile_image'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List User";
        $data['url'] = route('user-list');

        return view('admin.users.user',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create User";
        $data['url'] = route('user-save');

        $roles = DB::table('roles')->get();

        return view('admin.users.user-create',compact('data','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            //'status'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = new Admin();
        $post->name = $request->name;
        $post->email = $request->email;
        $post->mobile = $request->mobile;
        $post->password =  Hash::make($request->password);
        $post->status = $request->status;
        if($request->hasFile('profile_image')){

            $user = 'user_'.time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profile'), $user);
            $user = "/uploads/profile/".$user;
            $post->profile_image = $user;
        }
        $post->save();

        $post->assignRole($request->roles);

        return response()->json([
            'status' => true,
            'msg' => 'User created successfully'
			]);

    }


    public function show($id){

        $user = Admin::find($id);
        $data = array();
        $data['title'] = "View User";
        return view('admin.users.user-show',compact('user','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Admin::find($id);
        $data['title'] = "Edit User";
        $data['url'] = route('user-update',$id);
        $roles = DB::table('roles')->get();

        $userRole = $post->roles->pluck('id')->all();
        // echo "<pre>";print_r($userRole);
        // exit;
        return view('admin.users.user-edit',compact('post','data','roles','userRole'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $validator = Validator::make($request->all(), [
        'name' => 'required',
        'mobile' => 'required|numeric|digits:10|unique:users,mobile,'.$id,
        'email' => 'required|email|unique:users,email,'.$id,
        'status'=>'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        if ($validator->fails()) {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = Admin::find($id);
        $post->name = $request->name;
        $post->email = $request->email;
        $post->mobile = $request->mobile;
        $post->password =  Hash::make($request->password);
        $post->status = $request->status;
        if($request->hasFile('profile_image'))
        {
            $user = 'user_'.time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profile'), $user);
            $user = "/uploads/profile/".$user;
            $post->profile_image = $user;
        }
        $post->save();

        DB::table('model_has_roles')->where('model_id',$post->id)->delete();

        $post->assignRole($request->roles);



        return response()->json([
            'status' => true,
            'msg' => 'User updated successfully'
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
        Admin::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'User deleted successfully'
			]);
    }
}
