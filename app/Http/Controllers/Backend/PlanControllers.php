<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;

class PlanControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type="")
    {

        if ($request->ajax()) {
            $data = Plan:: where(function($query) use ($request){
                        if($request->type=='Inactive'){
                            $query->where('deleted_status',0)->where('status',0);
                        }
                        elseif($request->type=='Trashed'){
                            $query->where('deleted_status',1);
                        }
                        else{
                            $query->where('deleted_status',0)->where('status',1);
                        }
                    })->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $btn = '';
                        if($row->deleted_status!='1'){
                        $btn = '<a href="'.route("plan-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;">Edit</a><a  style="margin-right: 15px;" href="'.route("plan-view", $row->id).'" class="edit btn btn-primary  ">View</a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('plan-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete">Delete</button>';
                        }
                        else{
                            $btn.='<button  style="margin-right: 15px;" type="button" id="restoreButton" data-url="'.route('plan-restore', $row->id).'" class="edit btn btn-primary ml-2 btn-sm restoreButton" data-loading-text="Restore...." data-rest-text="Restore">Restore</button>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $data = array();
         $data['active'] = Plan::where('deleted_status',0)->where('status',1)->count();
         $data['inactive'] = Plan::where('deleted_status',0)->where('status',0)->count();
         $data['trashed'] = Plan::where('deleted_status',1)->count();

        $data['title'] = "List Plan";
        $data['url'] = route('plan-list',$type);

        return view('admin.plan.plan',compact('data','type'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Subscription Plan";
        $data['url'] = route('plan-save');
        return view('admin.plan.plan-create',compact('data'));
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
            'plan_name' => 'required',
            'duration_of_plan' => 'required',
            'no_of_hostel' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails())
        {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = new Plan();
        $post->plan_name = $request->plan_name;
        $post->duration_of_plan = $request->duration_of_plan;
        $post->no_of_hostel = $request->no_of_hostel;
        $post->price = $request->price;
          
        $post->save();


        return response()->json([
            'status' => true,
            'msg' => 'Plan created successfully'
			]);

    }


 public function show($id)
    {
        $plan = Plan::find($id);
        $data = array();
        $data['title'] = "View Plan";
        return view('admin.plan.plan-show',compact('plan','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Plan::find($id);
        $data['title'] = "Edit Plan";
        $data['url'] = route('plan-update',$id);

        return view('admin.plan.plan-edit',compact('post','data'));
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
            'plan_name' => 'required',
            'duration_of_plan' => 'required',
            'no_of_hostel' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = Plan::find($id);
        $post->plan_name = $request->plan_name;
        $post->duration_of_plan = $request->duration_of_plan;
        $post->no_of_hostel = $request->no_of_hostel;
        $post->price = $request->price;
        $post->save();


        return response()->json([
            'status' => true,
            'msg' => 'plan updated successfully'
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
       $data = Plan::find($id);
       $data->deleted_status = 1;
       $data->save();
        // Plan::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Plan deleted successfully'
			]);
    }
     public function restore($id)
    {
       $data = Plan::find($id);
       $data->deleted_status = 0;
       $data->save();
        // Plan::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Plan restore successfully'
			]);
    }
}
