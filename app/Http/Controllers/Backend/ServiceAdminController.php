<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceAdmin;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class ServiceAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = ServiceAdmin::where(function($query){
                if(Auth()->user()->hasRole('Super Admin')){
                    $query->where('society_id',session()->get('society_id'));
                }
                else{
                    $query->where('user_id',Auth()->guard('admin')->user()->id);
                }
        })->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("service_admin-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a data-url="'.route("service_admin-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('service_admin-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';
                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">'.$row->status.'</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">'.$row->status.'</span>';
                        }
                        return $status;

                    })
                    ->editColumn('image',function($row){
                        return '<img width="100" height="100" src="'.URL::to($row->image).'" />';
                    })
                    ->rawColumns(['action','status','image'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Service Admin";
        $data['url'] = route('service_admin-list');

        return view('admin.service_admin.service',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Service Admin";
        $data['url'] = route('service_admin-save');

        return view('admin.service_admin.service-create',compact('data'));
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
            'image' => 'required|image|mimes:jpg,png,jpeg,svg',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $service = new ServiceAdmin();
        $service->name = $request->name;
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        if($request->hasFile('image'))
        {
            $image = 'service_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/service'), $image);
            $image = "/uploads/service/".$image;
            $service->image = $image;
        }

        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Service Admin created successfully'
			]);

    }


    public function show($id){

        $service = ServiceAdmin::find($id);
        $data = array();
        $data['title'] = "View Service Admin";
        return view('admin.service_admin.service-show',compact('service','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = ServiceAdmin::find($id);
        $data['title'] = "Edit Service Admin";
        $data['url'] = route('service_admin-update',$id);


        return view('admin.service_admin.service-edit',compact('post','data'));
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
            'image' => 'required|image|mimes:jpg,png,jpeg,svg',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = ServiceAdmin::find($id);
        $service->name = $request->name;
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        if($request->hasFile('image'))
        {
            $image = 'service_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/service'), $image);
            $image = "/uploads/service/".$image;
            $service->image = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Service Admin updated successfully'
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
        ServiceAdmin::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Service Admin deleted successfully'
			]);
    }
}
