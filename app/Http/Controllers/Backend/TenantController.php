<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Floor;
use App\Models\User;
use App\Models\Unit;
use App\Models\Year;
use App\Models\Month;
use App\Models\TenentFamily;
use App\Models\TenantParking;
use App\Models\TenentMembers;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;
use Auth;

class TenantController extends Controller
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

            $data = Tenant::with('user','unit')->where(function($query){
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

                        $btn = '<a href="'.route("tenant-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("tenant-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('tenant-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

                    ->addColumn('tenant_photo',function($row){
                        if(File::exists( public_path( $row->tenant_photo ) ) && $row->tenant_photo!=null){
                            $profile = asset($row->tenant_photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','tenant_photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Tenant";
        $data['url'] = route('tenant-list');

        return view('admin.tenant.tenant',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = Year::get();
        $month = Month::get();
        $floor= Floor::get();
        $unit= Unit::get();
        $data = array();
        $data['title'] = "Create Tenant";
        $data['url'] = route('tenant-save');
        return view('admin.tenant.tenant-create',compact('data','floor','unit','month','year'));
    }


    public function getunit(Request $request){

        $unit = Unit::where('floor_no',$request->floor_no)->get();
         return response()->json([
            'status' => true,
            'data' => $unit
		]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'tenant_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'contact_no' => 'required',
            'address' => 'required',
            //'nid' => 'required',
           // 'tenant_photo' => 'required',
            'floor_no' => 'required',
            //'unit_no' => 'required',
            'adv_rent' => 'required',

        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;


        $user = new User();
        $user->society_id = session()->get('society_id');
        $user->name = $request->tenant_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->mobile = $request->contact_no;
        $user->role = 'tenant';
        $user->register_otp = 1234;
        $user->password =  Hash::make($request->password);
        $user->save();


        $service = new Tenant();
        $service->user_id = $user->id;
        $service->society_id = session()->get('society_id');
        // $service->tenant_name = $request->tenant_name;
        // $service->email = $request->email;
        // $service->password =  Hash::make($request->password);
        // $service->contact_no = $request->contact_no;
        $service->address = $request->address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->end_date = $request->end_date;
        $service->start_date = $request->start_date;
        $service->floor_no = $request->floor_no;
        $service->unit_no = $request->unit_no;
        $service->adv_rent = $request->adv_rent;
        // $service->per_month_rent = $request->per_month_rent;
        $service->issue_date = $request->issue_date;
        $service->month = $request->month;
        $service->year = $request->year;


        $service->mother_name = $request->mother_name;
        $service->father_name = $request->father_name;
        $service->gender = $request->gender;
        $service->dob = $request->dob;
        $service->date_of_marrige = $request->date_of_marrige;
        $service->occupation = $request->occupation;
        $service->office_address = $request->office_address;
        $service->created_by = auth()->guard('admin')->user()->id;

        if($request->hasFile('tenant_photo'))
        {
            $image = 'tenant_'.time().'.'.$request->tenant_photo->extension();
            $request->tenant_photo->move(public_path('uploads/tenant'), $image);
            $image = "/uploads/tenant/".$image;
            $service->tenant_photo = $image;
        }

        if($request->hasFile('agreement'))
        {
            $image = 'agreement_'.time().'.'.$request->agreement->extension();
            $request->agreement->move(public_path('uploads/agreement'), $image);
            $image = "/uploads/agreement/".$image;
            $service->agreement = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        // if($request->member_contact_no){

        //     $member = new TenentMembers();
        //     $member->society_id = session()->get('society_id');
        //     $member->tenent_id = $service->id;
        //     $member->full_name = $request->full_name;
        //     $member->floor_no = $request->floor_no;
        //     $member->unit_no = $request->unit_no;
        //     $member->contact_no = $request->member_contact_no;
        //     $member->address = $request->member_address;
        //     $member->pan = $request->members_pan;
        //     $member->aadhar = $request->members_aadhar;
        //     $member->member_mother_name = $request->member_mother_name;
        //     $member->member_father_name = $request->member_father_name;
        //     $member->member_gender = $request->member_gender;
        //     $member->member_dob = $request->member_dob;
        //     $member->member_date_of_marrige = $request->member_date_of_marrige;
        //     $member->member_occupation = $request->member_occupation;
        //     $member->updated_by =  Auth::guard('admin')->user()->id;
        //     $member->save();
        // }

        if($request->is_family){

            // Nomination_detail::where('tenant_id', $service->id)->delete();

            foreach ($request->family_name as $key=>$vals)
             {
                 $kids = new TenentFamily();
                 $kids->society_id = session()->get('society_id');
                 $kids->tenent_id = $service->id;
                //  $kids->tenent_member_id = $member->id;
                 $kids->family_name = $request->family_name[$key];
                 $kids->family_father_name = $request->family_father_name[$key];
                 $kids->family_mother_name = $request->family_mother_name[$key];
                 $kids->family_gender = $request->family_gender[$key];
                 $kids->family_contact_no = $request->family_contact_no[$key];
                 $kids->family_password = $request->family_password[$key];
                 $kids->family_dob = $request->family_dob[$key];
                 $kids->family_marriage = $request->family_marriage[$key];
                 $kids->family_occupation = $request->family_occupation[$key];
                 $kids->pan = $request->family_pan[$key];
                 $kids->aadhar = $request->family_aadhar[$key];
                 $kids->save();
            }
        }


        if($request->is_vehicle){

            // Nomination_detail::where('tenant_id', $service->id)->delete();

            foreach ($request->vehicleflat_no as $key=>$vals)
             {
                 $vehicle = new TenantParking();
                 $vehicle->society_id = session()->get('society_id');
                 $vehicle->created_by = auth()->guard('admin')->user()->id;
                 $vehicle->tenant_id = $service->id;
                 $vehicle->tenant_name = $service->tenant_name;
                 $vehicle->flat_no = $request->vehicleflat_no[$key];
                 $vehicle->vehicle_type = $request->vehicle_type[$key];
                 $vehicle->rc_number = $request->rc_number[$key];
                 $vehicle->vehicle_no = $request->vehicle_no[$key];

                 $vehicle->is_insured = $request->is_insured[$key];
                 $vehicle->parking_no = $request->parking_no[$key];
                 $vehicle->save();
            }
        }

        return response()->json([
            'status' => true,
            'msg' => 'Tenant created successfully'
			]);

    }


    public function show($id){

        $tenant = Tenant::with('tenent_members_details')->find($id);
        $data = array();
        $data['title'] = "View Tenant";
        return view('admin.tenant.tenant-show',compact('tenant','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $year = Year::get();
        $month = Month::get();
        $post = Tenant::with('user','tenent_members_details')->find($id);
        // prd($post);
        $data['title'] = "Edit Tenant";
        $data['url'] = route('tenant-update',$id);
        $floor= Floor::get();
        $unit= Unit::get();

        return view('admin.tenant.tenant-create',compact('post','data','floor','unit','month','year'));
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
            'tenant_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'contact_no' => 'required',
           'username' => 'required',
            // 'nid' => 'required',
           // 'tenant_photo' => 'required',
            'floor_no' => 'required',
            //'unit_no' => 'required',
            'adv_rent' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Tenant::find($id);

        $user = User::find($service->user_id);
        $user->society_id = session()->get('society_id');
        $user->name = $request->tenant_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->mobile = $request->contact_no;
        $user->password =  Hash::make($request->password);
        $user->save();


        $service->society_id = session()->get('society_id');
        // $service->tenant_name = $request->tenant_name;
        // $service->email = $request->email;
        // $service->password =  Hash::make($request->password);
        // $service->contact_no = $request->contact_no;
        $service->address = $request->address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->floor_no = $request->floor_no;
        $service->unit_no = $request->unit_no;
        $service->adv_rent = $request->adv_rent;
        // $service->per_month_rent = $request->per_month_rent;
        $service->issue_date = $request->issue_date;
        $service->month = $request->month;
        $service->year = $request->year;

        $service->mother_name = $request->mother_name;
        $service->father_name = $request->father_name;
        $service->gender = $request->gender;
        $service->dob = $request->dob;
        $service->date_of_marrige = $request->date_of_marrige;
        $service->occupation = $request->occupation;
        $service->office_address = $request->office_address;
        $service->created_by = auth()->guard('admin')->user()->id;


        if($request->hasFile('tenant_photo'))
        {
            $image = 'tenant_'.time().'.'.$request->tenant_photo->extension();
            $request->tenant_photo->move(public_path('uploads/tenant'), $image);
            $image = "/uploads/tenant/".$image;
            $service->tenant_photo = $image;
        }

        $service->status = $request->status;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        // if($request->member_contact_no){

        //     $member = TenentMembers::where('tenent_id',$service->id)->first();
        //     if(!$member){
        //         $member = new TenentMembers();
        //     }
        //     $member->society_id = session()->get('society_id');
        //     $member->society_id = session()->get('society_id');
        //     $member->tenent_id = $service->id;
        //     $member->full_name = $request->full_name;
        //     $member->floor_no = $request->floor_no;
        //     $member->unit_no = $request->unit_no;
        //     $member->contact_no = $request->member_contact_no;
        //     $member->address = $request->member_address;
        //     $member->pan = $request->members_pan;
        //     $member->aadhar = $request->members_aadhar;
        //     $member->member_mother_name = $request->member_mother_name;
        //     $member->member_father_name = $request->member_father_name;
        //     $member->member_gender = $request->member_gender;
        //     $member->member_dob = $request->member_dob;
        //     $member->member_date_of_marrige = $request->member_date_of_marrige;
        //     $member->member_occupation = $request->member_occupation;
        //     $member->updated_by =  Auth::guard('admin')->user()->id;
        //     $member->save();
        // }

        if($request->is_family){

            TenentFamily::where('tenent_id',$service->id)->delete();

            foreach ($request->family_name as $key=>$vals)
             {
                 $kids = new TenentFamily();
                 $kids->society_id = session()->get('society_id');
                 $kids->tenent_id = $service->id;
                //  $kids->tenent_member_id = $member->id;
                 $kids->family_name = $request->family_name[$key];
                 $kids->family_father_name = $request->family_father_name[$key];
                 $kids->family_mother_name = $request->family_mother_name[$key];
                 $kids->family_gender = $request->family_gender[$key];
                 $kids->family_contact_no = $request->family_contact_no[$key];
                 $kids->family_password = $request->family_password[$key];
                 $kids->family_dob = $request->family_dob[$key];
                 $kids->family_marriage = $request->family_marriage[$key];
                 $kids->family_occupation = $request->family_occupation[$key];
                 $kids->pan = $request->family_pan[$key];
                 $kids->aadhar = $request->family_aadhar[$key];
                 $kids->save();
            }
        }

        if($request->is_vehicle){

            TenantParking::where('tenant_id', $service->id)->delete();

            foreach ($request->vehicleflat_no as $key=>$vals)
             {
                 $vehicle = new TenantParking();
                 $vehicle->society_id = session()->get('society_id');
                 $vehicle->created_by = auth()->guard('admin')->user()->id;
                 $vehicle->tenant_id = $service->id;
                 $vehicle->tenant_name = $service->tenant_name;
                 $vehicle->flat_no = $request->vehicleflat_no[$key];
                 $vehicle->vehicle_type = $request->vehicle_type[$key];
                 $vehicle->rc_number = $request->rc_number[$key];
                 $vehicle->vehicle_no = $request->vehicle_no[$key];

                 $vehicle->is_insured = $request->is_insured[$key];
                 $vehicle->parking_no = $request->parking_no[$key];
                 $vehicle->save();
            }
        }


        return response()->json([
            'status' => true,
            'msg' => 'Tenant updated successfully'
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
        Tenant::find($id)->delete();
        TenentFamily::where('tenent_id',$id)->delete();
        TenentMembers::where('tenent_id',$id)->delete();
        TenantParking::where('tenent_id',$id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Tenant deleted successfully'
			]);
    }


    public function parkingdestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parking_id'=>'required|exists:tenant_parking,id',
        ]);

        if ($validator->fails()){

            $message = [];
            foreach($validator->errors()->getMessages() as $keys=>$vals)
            {
               foreach($vals as $k=>$v)
               {
                 $message[] =  $v;
               }
            }

            return response()->json([
                'status' => false,
                'message' => $message[0]
                ]);
        }

        TenantParking::find($request->parking_id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Tenant Parking deleted successfully'
			]);
    }

    public function familydestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'family_id'=>'required|exists:tenent_family_members,id',
        ]);

        if ($validator->fails()){

            $message = [];
            foreach($validator->errors()->getMessages() as $keys=>$vals)
            {
               foreach($vals as $k=>$v)
               {
                 $message[] =  $v;
               }
            }

            return response()->json([
                'status' => false,
                'message' => $message[0]
                ]);
        }

        TenentFamily::find($request->family_id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Tenant Family deleted successfully'
			]);
    }


}
