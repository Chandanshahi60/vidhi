<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
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

class MeetingController extends Controller
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

            $data = Meeting::where(function($query){
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

                        $btn = '<a href="'.route("meeting-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("meeting-view", $row->id).'" class="edit btn btn-primary"><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('meeting-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Meeting";
        $data['url'] = route('meeting-list');

        return view('admin.meeting.meeting',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floor= Floor::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Meeting";
        $data['url'] = route('meeting-save');

        $owner = Owner::get();
        return view('admin.meeting.meeting-create',compact('unit','floor','data','owner'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'meeting_issue_date' => 'required',
            'title' => 'required',
            'meeting_desc' => 'required',
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

        $service = new Meeting();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->meeting_issue_date = $request->meeting_issue_date;
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Meeting created successfully'
			]);

    }


    public function show($id){

        $meeting = Meeting::find($id);
        $data = array();
        $data['title'] = "View Meeting";
        return view('admin.meeting.meeting-show',compact('meeting','data'));
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
        $post = Meeting::find($id);
        $data['title'] = "Edit Meeting";
        $data['url'] = route('meeting-update',$id);
        return view('admin.meeting.meeting-create',compact('unit','floor','post','data','owner'));
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
            'meeting_issue_date' => 'required',
            'title' => 'required',
            'meeting_desc' => 'required',
            //'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Meeting::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->meeting_issue_date = $request->meeting_issue_date;
        $service->title = $request->title;
        $service->meeting_desc = $request->meeting_desc;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Meeting updated successfully'
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
        Meeting::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Meeting deleted successfully'
			]);
    }
}
