<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use DB;
use Hash;
use DataTables;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Role::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("role-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                       <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('role-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Role";
        $data['url'] = route('role-list');

        return view('admin.role.role',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Role";
        $data['url'] = route('role-save');

        $permission = Permission::where('parent_id',0)->latest()->get();
        foreach($permission as $key=>$vals){
            $vals->child_permission =  Permission::where('parent_id',$vals->id)->get();
        }

        return view('admin.role.role-create',compact('data', 'permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";print_r($request->permission);
        // exit;
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
          ]);

        if ($validator->fails())
        {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $role = Role::create(['name' =>  $request->name]);
        $role->syncPermissions($request->permission);

        return response()->json([
            'status' => true,
            'msg' => 'Role created successfully'
			]);

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Role::find($id);
        $data['title'] = "Edit Role";
        $data['url'] = route('role-update',$id);

        $rolePermissions  = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();


        $permission = Permission::where('parent_id',0)->latest()->get();
        foreach($permission as $key=>$vals){
            $vals->child_permission =  Permission::where('parent_id',$vals->id)->get();
        }

        // echo "<pre>";print_r($permission);
        // exit;

        return view('admin.role.role-edit',compact('post','data', 'permission', 'rolePermissions'));
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
        'name' => 'required|unique:roles,name,'.$id,
            'permission' => 'required'
      ]);

        if ($validator->fails()) {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);


        return response()->json([
            'status' => true,
            'msg' => 'Role updated successfully'
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
        Role::find($id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Role deleted successfully'
			]);
    }
}
