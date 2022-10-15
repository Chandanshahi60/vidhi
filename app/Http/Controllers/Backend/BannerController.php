<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Banner::where(function($query){
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

                        $btn = '<a href="'.route("banner-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a data-url="'.route("banner-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('banner-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';
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

        $data['title'] = "List Banner";
        $data['url'] = route('banner-list');

        return view('admin.banner.banner',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Create Banner";
        $data['url'] = route('banner-save');

        return view('admin.banner.banner-create',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $banner = new Banner();
        $banner->title = $request->title;
        $banner->user_id = auth()->guard('admin')->user()->id;
        $banner->society_id = session()->get('society_id');
        if($request->hasFile('image'))
        {
            $image = 'service_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/service'), $image);
            $image = "/uploads/service/".$image;
            $banner->image = $image;
        }

        $banner->status = $request->status;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->save();

        return response()->json([
            'status' => true,
            'msg' => 'Banner created successfully'
			]);

    }


    public function show($id){

        $banner = Banner::find($id);
        $data = array();
        $data['title'] = "View Banner";
        return view('admin.banner.banner-show',compact('banner','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = Banner::find($id);
        $data['title'] = "Edit Banner";
        $data['url'] = route('banner-update',$id);


        return view('admin.banner.banner-edit',compact('post','data'));
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
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $banner = Banner::find($id);
        $banner->title = $request->title;
        $banner->user_id = auth()->guard('admin')->user()->id;
        $banner->society_id = session()->get('society_id');
        if($request->hasFile('image'))
        {
            $image = 'service_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/service'), $image);
            $image = "/uploads/service/".$image;
            $banner->image = $image;
        }
        $banner->status = $request->status;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->save();


        return response()->json([
            'status' => true,
            'msg' => 'Banner updated successfully'
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
        Banner::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Banner deleted successfully'
			]);
    }
}
