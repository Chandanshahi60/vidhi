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

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $permisssion = Permission::where('parent_id',0)->latest()->get();
        foreach($permisssion as $key=>$vals){
            $vals->child_permission =  Permission::where('parent_id',$vals->id)->get();
        }

        // echo "<pre>";print_r($permisssion);
        // exit;
        if ($request->ajax()) {
            $data = Permission::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("permission-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                       <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('permission-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Permission";
        $data['url'] = route('permission-list');

        return view('admin.permission.permission',compact('data','permisssion'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Permission";
        $data['url'] = route('permission-save');

        return view('admin.permission.permission-create',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // echo "<pre>";print_r($request->all());
        // exit;

        $validator = Validator::make($request->all(), [
            'name' => 'required'
          ]);

        if ($validator->fails())
        {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $permission = ['name' =>  $request->name];

        if(isset($request->permissions) && count($request->permissions) > 0){

            foreach($request->permissions  as $key=>$vals){

                $parent = Permission::firstOrCreate(['name' => strtok($request->name," ").' Master']);

                Permission::firstOrCreate(['name' => strtok($request->name," ").' '.$vals,'parent_id'=>$parent->id]);

            }

        }
        else{
            Permission::create($permission);
        }




        return response()->json([
            'status' => true,
            'msg' => 'Permission created successfully'
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
        $post = Permission::find($id);
        $post->child_permission = Permission::where('parent_id',$id)->get();

        $allPermission = Permission::where('parent_id',$id)->pluck('id')->toArray();

        $rolePermissions = DB::table("role_has_permissions")
                            ->whereIn("role_has_permissions.permission_id",$allPermission)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();

        // echo "<pre>";print_r($rolePermissions);
        // exit;
        $data['title'] = "Edit Permission";
        $data['url'] = route('permission-update',$id);

        return view('admin.permission.permission-edit',compact('post','data','rolePermissions'));
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
      ]);

        if ($validator->fails()) {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = Permission::find($id);
        $post->name = $request->name;
        $post->save();

        $permissionname = explode(' ',$request->name);

        Permission::where('parent_id',$id)->delete();

        $permission = ['name' =>  $request->name];

        if(isset($request->permissions) && count($request->permissions) > 0){

            foreach($request->permissions  as $key=>$vals){

                $parent = Permission::firstOrCreate(['name' => strtok($request->name," ").' Master']);

                Permission::firstOrCreate(['name' => strtok($request->name," ").' '.$vals,'parent_id'=>$parent->id]);

            }

        }
        else{
            Permission::create($permission);
        }


        return response()->json([
            'status' => true,
            'msg' => 'Permission updated successfully'
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
        Permission::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Permission deleted successfully'
			]);
    }
}
