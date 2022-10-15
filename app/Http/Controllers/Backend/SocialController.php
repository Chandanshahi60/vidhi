<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\Social_images;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class SocialController extends Controller
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

            $data = Social::where(function($query){
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

                        $btn = '<a href="'.route("social-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a data-url="'.route("social-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('social-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

                        return $btn;
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

                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Social";
        $data['url'] = route('social-list');

        return view('admin.social.social',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Create Social";
        $data['url'] = route('social-save');
        return view('admin.social.social-create',compact('data'));
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

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Social();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->status = $request->status;
        $service->date = $request->date;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();
        if ($request->file('files')) {

            foreach ($request->file('files') as $key=>$file) {

                $social_images = new Social_images();
                $social_images->social_id = $service->id;

                $image = 'social_images'.time().$key.'.'.$file->extension();
                $file->move(public_path('/uploads/social_images'),$image);
                $image = "/uploads/social_images/".$image;
                $social_images->image = $image;
                $social_images->save();
            }

        }

        return response()->json([
            'status' => true,
            'msg' => 'Social created successfully'
			]);

    }


    public function show($id){

        $social = Social::find($id);
        $data = array();
        $data['title'] = "View Social";
        return view('admin.social.social-show',compact('social','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = Social::find($id);
        $data['title'] = "Edit Social";
        $data['url'] = route('social-update',$id);


        return view('admin.social.social-create',compact('post','data'));
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

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Social::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->title = $request->title;
        $service->status = $request->status;
        if($request->date)
        {
        $service->date = $request->date;
        }
        else{
            $service->date = date('Y-m-d');
        }
        
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        if ($request->file('files')) {

            Social_images::where('social_id', $service->id)->delete();

            foreach ($request->file('files') as $key=>$file) {

                $social_images = new Social_images();
                $social_images->social_id = $service->id;

                $image = 'social_images'.time().$key.'.'.$file->extension();
                $file->move(public_path('/uploads/social_images'),$image);
                $image = "/uploads/social_images/".$image;
                $social_images->image = $image;
                $social_images->save();
            }

        }

        return response()->json([
            'status' => true,
            'msg' => 'Social updated successfully'
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
        Social::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Social deleted successfully'
			]);
    }
}
