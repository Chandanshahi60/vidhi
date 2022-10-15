<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Unit;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class UnitController extends Controller
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

            $data = Unit::with('floor')->where(function($query){
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

                        $btn = '<a href="'.route("unit-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a data-url="'.route("unit-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('unit-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Unit";
        $data['url'] = route('unit-list');

        return view('admin.unit.unit',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Unit";
        $data['url'] = route('unit-save');

        $floor=Floor::get();

        return view('admin.unit.unit-create',compact('data','floor'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'floor_no' => 'required',
            'unit_no' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Unit();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->unique_id = $request->unique_id;
        $service->unit_no = $request->unit_no;
        $service->floor_no = $request->floor_no;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Unit created successfully'
			]);

    }


    public function show($id){

        $unit = Unit::find($id);
        $data = array();
        $data['title'] = "View Unit";
        return view('admin.unit.unit-show',compact('unit','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $floor=Floor::get();

        $post = Unit::find($id);
        $data['title'] = "Edit Unit";
        $data['url'] = route('unit-update',$id);


        return view('admin.unit.unit-create',compact('post','data','floor'));
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
            'floor_no' => 'required',
            'unit_no' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Unit::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->unique_id = $request->unique_id;
        $service->floor_no = $request->floor_no;
        $service->unit_no = $request->unit_no;
        $service->status = $request->status;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Unit updated successfully'
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
        Unit::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Unit deleted successfully'
			]);
    }
}
