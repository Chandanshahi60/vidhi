<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Notice_tenant;
use App\Models\Notice_owner;
use App\Models\Notice_employee;
use App\Models\Meeting;
use App\Models\Unit;
use App\Models\Owner;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class NoticeController extends Controller
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

    public function tenant_index(Request $request)
    {

        if ($request->ajax()) {

            $data = Notice_tenant::where(function($query){
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

                        $btn = '<a href="'.route("tenant_notice-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("tenant_notice-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('tenant_notice-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">Disable</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Publish Now</span>';
                        }
                        return $status;

                    })

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Notice";
        $data['url'] = route('tenant_notice-list');

        return view('admin.notice.tenant.tenant_notice',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tenant_create()
    {
        $data = array();
        $data['title'] = "Create Notice";
        $data['url'] = route('tenant_notice-save');

        $owner = Owner::get();
        return view('admin.notice.tenant.tenant_notice-create',compact('data','owner'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function tenant_store(Request $request){

        $validator = Validator::make($request->all(), [
           'title' => 'required',
           'date' => 'required',
           //'status' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Notice_tenant();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Notice created successfully'
			]);

    }


    public function tenant_show($id){

        $tenant = Notice_tenant::find($id);
        $data = array();
        $data['title'] = "View Notice";
        return view('admin.notice.tenant.tenant_notice-show',compact('tenant','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tenant_edit($id){
        $owner = Owner::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $post = Notice_tenant::find($id);
        $data['title'] = "Edit Notice";
        $data['url'] = route('tenant_notice-update',$id);
        return view('admin.notice.tenant.tenant_notice-create',compact('unit','floor','post','data','owner'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tenant_update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
           // 'status' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Notice_tenant::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Notice updated successfully'
			]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tenant_destroy($id)
    {
        Notice_tenant::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Notice deleted successfully'
			]);
    }



    // employee







    public function employee_index(Request $request)
    {

        if ($request->ajax()) {

            $data = Notice_employee::where(function($query){
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

                        $btn = '<a href="'.route("employee_notice-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("employee_notice-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('employee_notice-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">Disable</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Publish Now</span>';
                        }
                        return $status;

                    })

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Notice";
        $data['url'] = route('employee_notice-list');

        return view('admin.notice.employee.employee_notice',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_create()
    {
        $floor= Floor::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Notice";
        $data['url'] = route('employee_notice-save');

        $owner = Owner::get();
        return view('admin.notice.employee.employee_notice-create',compact('unit','floor','data','owner'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function employee_store(Request $request){

        $validator = Validator::make($request->all(), [
           // 'renter_name' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Notice_employee();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Notice created successfully'
			]);

    }


    public function employee_show($id){

        $employee = Notice_employee::find($id);
        $data = array();
        $data['title'] = "View Notice";
        return view('admin.notice.employee.employee_notice-show',compact('employee','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employee_edit($id){
        $owner = Owner::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $post = Notice_employee::find($id);
        $data['title'] = "Edit Notice";
        $data['url'] = route('employee_notice-update',$id);
        return view('admin.notice.employee.employee_notice-create',compact('unit','floor','post','data','owner'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employee_update(Request $request, $id){

        $validator = Validator::make($request->all(), [
          //  'name' => 'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Notice_employee::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Notice updated successfully'
			]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employee_destroy($id)
    {
        Notice_employee::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Notice deleted successfully'
			]);
    }






    // Owner



    public function owner_index(Request $request)
    {

        if ($request->ajax()) {

            $data = Notice_owner::where(function($query){
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

                        $btn = '<a href="'.route("owner_notice-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("owner_notice-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('owner_notice-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('status',function($row){

                        $status = null;
                        if($row->status==0){
                            $status = '<span class="badge badge-warning">Disable</span>';
                        }
                        elseif($row->status==1){
                            $status = '<span class="badge badge-success">Publish Now</span>';
                        }
                        return $status;

                    })

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Notice";
        $data['url'] = route('owner_notice-list');

        return view('admin.notice.owner.owner_notice',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function owner_create()
    {
        $floor= Floor::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Notice";
        $data['url'] = route('owner_notice-save');

        $owner = Owner::get();
        return view('admin.notice.owner.owner_notice-create',compact('unit','floor','data','owner'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function owner_store(Request $request){

        $validator = Validator::make($request->all(), [
           // 'renter_name' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Notice_owner();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->type = $request->type;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Notice created successfully'
			]);

    }


    public function owner_show($id){

        $owner = Notice_owner::find($id);
        $data = array();
        $data['title'] = "View Notice";
        return view('admin.notice.owner.owner_notice-show',compact('owner','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function owner_edit($id){
        $owner = Owner::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $post = Notice_owner::find($id);
        $data['title'] = "Edit Notice";
        $data['url'] = route('owner_notice-update',$id);
        return view('admin.notice.owner.owner_notice-create',compact('unit','floor','post','data','owner'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function owner_update(Request $request, $id){

        $validator = Validator::make($request->all(), [
          //  'name' => 'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Notice_owner::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->type = $request->type;
        $service->meeting_desc = $request->meeting_desc;
        $service->date = $request->date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();
        return response()->json([
            'status' => true,
            'msg' => 'Notice updated successfully'
			]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function owner_destroy($id)
    {
        Notice_owner::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Notice deleted successfully'
			]);
    }




}
