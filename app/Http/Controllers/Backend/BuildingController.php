<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Building;
use App\Models\Unit;
use App\Models\Owner;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class BuildingController extends Controller
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

            $data = Building::where(function($query){
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

                        $btn = '<a href="'.route("building-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("building-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('building-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Building";
        $data['url'] = route('building-list');

        return view('admin.settings.building.building',compact('data'));
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
        $data['title'] = "Create Building";
        $data['url'] = route('building-save');

        $owner = Owner::get();
        return view('admin.settings.building.building-create',compact('unit','floor','data','owner'));
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
           'email' => 'required',
           'contact_no' => 'required',
           'security_guard_mobile' => 'required',
           'secretary_mobile' => 'required',
           'moderator_mobile' => 'required',
           'building_construction_year' => 'required',
           'address' => 'required',
           'photo' => 'required',
           'status' => 'required',
           'company_name' => 'required',
           'company_address' => 'required',
           'company_mobile' => 'required',
           'apartment_rules' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Building();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->contact_no = $request->contact_no;
        $service->security_guard_mobile = $request->security_guard_mobile;
        $service->secretary_mobile = $request->secretary_mobile;
        $service->moderator_mobile = $request->moderator_mobile;
        $service->building_construction_year = $request->building_construction_year;
        $service->address = $request->address;
        if($request->hasFile('photo'))
        {
            $image = 'building_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/building'), $image);
            $image = "/uploads/building/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->company_name = $request->company_name;
        $service->company_mobile = $request->company_mobile;
        $service->company_address = $request->company_address;
        $service->apartment_rules = $request->apartment_rules;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Building created successfully'
			]);

    }


    public function show($id){

        $building = Building::find($id);
        $data = array();
        $data['title'] = "View Building";
        return view('admin.settings.building.building-show',compact('building','data'));
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
        $post = Building::find($id);
        $data['title'] = "Edit Building";
        $data['url'] = route('building-update',$id);
        return view('admin.settings.building.building-create',compact('unit','floor','post','data','owner'));
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
            'email' => 'required',
            'contact_no' => 'required',
            'security_guard_mobile' => 'required',
            'secretary_mobile' => 'required',
            'moderator_mobile' => 'required',
            'building_construction_year' => 'required',
            'address' => 'required',
            //'photo' => 'required',
            //'status' => 'required',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_mobile' => 'required',
            'apartment_rules' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Building::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->contact_no = $request->contact_no;
        $service->security_guard_mobile = $request->security_guard_mobile;
        $service->secretary_mobile = $request->secretary_mobile;
        $service->moderator_mobile = $request->moderator_mobile;
        $service->building_construction_year = $request->building_construction_year;
        $service->address = $request->address;
        if($request->hasFile('photo'))
        {
            $image = 'building_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/building'), $image);
            $image = "/uploads/building/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->company_name = $request->company_name;
        $service->company_mobile = $request->company_mobile;
        $service->company_address = $request->company_address;
        $service->apartment_rules = $request->apartment_rules;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Building updated successfully'
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
        Building::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Building deleted successfully'
			]);
    }
}
