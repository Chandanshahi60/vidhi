<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventsImage;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class EventController extends Controller
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

            $data = Events::where(function($query){
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

                        $btn = '<a href="'.route("event-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a data-url="'.route("event-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('event-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
                    })
                    ->addColumn('image',function($row){
                        if(File::exists( public_path( $row->image ) ) && $row->image!=null){
                            $profile = url($row->image);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

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

                    ->rawColumns(['action','status','image'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Events";
        $data['url'] = route('event-list');

        return view('admin.event.event',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Create Events";
        $data['url'] = route('event-save');
        return view('admin.event.event-create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' =>'required|string',
            'start_date' =>'required',
            'end_date' =>'required',
            'venue' =>'required',
            'organiser' =>'required',
            'city' =>'required',
            'description' =>'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $events = new Events();
        $events->user_id = auth()->guard('admin')->user()->id;
        $events->society_id = session()->get('society_id');
        $events->title = $request->title;
        $events->start_date = $request->start_date;
        $events->end_date = $request->end_date;
        $events->venue = $request->venue;
        $events->facebook_url = $request->facebook_url;
        $events->organiser = $request->organiser;
        $events->city = $request->city;
        $events->description = $request->description;
        $image = "";
        if($request->hasFile('image'))
        {
        $image = 'events_'.time().'.'.$request->image->extension();
        $request->image->move(public_path('/uploads/events'), $image);
        $image = "/uploads/events/".$image;
        }
        $events->image = $image ;
        $events->created_at = date('Y-m-d H:i:s');
        $events->updated_at = date('Y-m-d H:i:s');
        $events->save();
        if ($request->file('files')) {

            foreach ($request->file('files') as $key=>$file) {

                $social_images = new EventsImage();
                $social_images->event_id = $events->id;

                $image = 'social_images'.time().$key.'.'.$file->extension();
                $file->move(public_path('/uploads/social_images'),$image);
                $image = "/uploads/social_images/".$image;
                $social_images->image = $image;
                $social_images->save();
            }

        }

        return response()->json([
            'status' => true,
            'msg' => 'Event created successfully'
			]);

    }


    public function show($id){

        $event = Events::find($id);
        $data = array();
        $data['title'] = "View Events";
        return view('admin.event.event-show',compact('event','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = Events::find($id);
        $data['title'] = "Edit Events";
        $data['url'] = route('event-update',$id);


        return view('admin.event.event-create',compact('post','data'));
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
            'title' =>'required|string',
            'start_date' =>'required',
            'end_date' =>'required',
            'venue' =>'required',
            'organiser' =>'required',
            'city' =>'required',
            'description' =>'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Events::find($id);
        $events->user_id = auth()->guard('admin')->user()->id;
        $events->society_id = session()->get('society_id');
        $events->title = $request->title;
        $events->start_date = $request->start_date;
        $events->end_date = $request->end_date;
        $events->venue = $request->venue;
        $events->facebook_url = $request->facebook_url;
        $events->organiser = $request->organiser;
        $events->city = $request->city;
        $events->description = $request->description;
        $image = "";
        if($request->hasFile('image'))
        {
        $image = 'events_'.time().'.'.$request->image->extension();
        $request->image->move(public_path('/uploads/events'), $image);
        $image = "/uploads/events/".$image;
        }
        $events->image = $image ;
        $events->created_at = date('Y-m-d H:i:s');
        $events->updated_at = date('Y-m-d H:i:s');
        $events->save();
        if ($request->file('files')) {

            EventsImage::where('event_id',$events->id)->delete();
            foreach ($request->file('files') as $key=>$file) {

                $event_images = new EventsImage();
                $event_images->event_id = $events->id;

                $image = 'event_images'.time().$key.'.'.$file->extension();
                $file->move(public_path('/uploads/event_images'),$image);
                $image = "/uploads/event_images/".$image;
                $event_images->image = $image;
                $event_images->save();
            }

        }
        return response()->json([
            'status' => true,
            'msg' => 'Event updated successfully'
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
        Events::find($id)->delete();
        EventsImage::where('event_id',$id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Event deleted successfully'
			]);
    }
}
