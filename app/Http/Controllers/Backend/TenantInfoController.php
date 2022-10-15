<?php
namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Owner_Utility;
use App\Models\CommitteeGroup;
use App\Models\Month;
use App\Models\Management_member_type;
use App\Models\Year;
use App\Models\Unit;
use App\Models\User;
use App\Models\Floor;
use App\Models\Managementcommittee;
use App\Models\SocietyParking;
use App\Models\Nomination_detail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Society;
use App\Models\SocietyFamily;
use App\Models\SocietyMembers;
use App\Models\Owner_kids;
use App\Models\SocietyCommitte;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class TenantInfoController extends Controller
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

            $data = Owner::where('role','tenant')->where(function($query){
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

                        $btn = '<a href="'.route("tenantinfo-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("tenantinfo-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('tenantinfo-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

                    ->addColumn('owner_photo',function($row){
                        if(File::exists( public_path( $row->photo ) ) && $row->photo!=null){
                            $profile = url($row->photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','owner_photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Owner";
        $data['url'] = route('tenantinfo-list');

        return view('admin.tenantnew.owner',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $management_member = Management_member_type::get();
        $committee = Managementcommittee::get();
        $owner_unit = Unit::get();
        $group = CommitteeGroup::get();
        $data = array();
        $data['title'] = "Create Tenant";
        $data['url'] = route('tenantinfo-save');
        return view('admin.tenantnew.owner-create',compact('data','owner_unit','committee','management_member','group'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'contact_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'username' => 'required',
            'owner_unit' => 'required',
            'owner_photo' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}
        $service = new Owner();

        $service->name = $request->owner_name;
        $service->role = 'tenant';
        // $service->register_otp = 1234;
        $service->email = $request->email;
        $service->username = $request->username;
        $service->mobile = $request->contact_no;
        $service->password =  Hash::make($request->password);

        // $service->user_id = $user->id;
        $service->society_id = session()->get('society_id');
        // $service->owner_name = $request->owner_name;
        // $service->email = $request->email;
        // $service->password =  Hash::make($request->password);
        // $service->contact_no = $request->contact_no;


        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;

        $service->property_type = $request->property_type;
        $service->property_owned = $request->property_owned;
        $service->flat_no = $request->flat_no;
        $service->mother_name = $request->mother_name;
        $service->father_name = $request->father_name;
        $service->gender = $request->gender;
        $service->dob = $request->dob;
        $service->date_of_marrige = $request->date_of_marrige;
        $service->occupation = $request->occupation;
        $service->office_address = $request->office_address;
        $service->created_by = auth()->guard('admin')->user()->id;
        if(isset($request->owner_unit) && count($request->owner_unit) > 0){
            $service->owner_unit = implode(',',$request->owner_unit);
        }
        if($request->hasFile('owner_photo'))
        {
            $image = 'owner_'.time().'.'.$request->owner_photo->extension();
            $request->owner_photo->move(public_path('uploads/owner'), $image);
            $image = "/uploads/owner/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');

        $service->save();

        if($request->is_committe){

            $committee = new Managementcommittee();
            $committee->society_id = session()->get('society_id');
            $committee->owner_id = $service->id;
            $committee->user_id = Auth::guard('admin')->user()->id;
            $committee->group_id = $request->group_id;
            $committee->email = $request->email;
            $committee->name = $request->committe_name;
            $committee->aadhar = $request->aadhar;
            $committee->pan = $request->pan;
            $committee->designation = $request->designation;
            $committee->phone = $request->committee_contact_no;
            $committee->joining_date = $request->joining_date;
            $committee->ending_date = $request->ending_date;
            $committee->present_address = $request->present_address;
            $committee->present_address = $request->present_address;
            if($request->hasFile('committee_photo'))
            {
                $image = 'committee_'.time().'.'.$request->committee_photo->extension();
                $request->committee_photo->move(public_path('uploads/committee'), $image);
                $image = "/uploads/committee/".$image;
                $committee->photo = $image;
            }
            $committee->save();
        }

        // if($request->member_contact_no){

        //     $member = new SocietyMembers();
        //     $member->society_id = session()->get('society_id');
        //     $member->owner_id = $service->id;
        //     $member->full_name = $request->full_name;
        //     $member->flat_no = $request->flat_no;
        //     $member->contact_no = $request->member_contact_no;
        //     $member->property_type = $request->property_type;
        //     $member->property_owned = $request->property_owned;
        //     $member->address = $request->address;
        //     $member->updated_by =  Auth::guard('admin')->user()->id;
        //     $member->property_owner_name = $request->owner_name;
        //     $member->owner_contact_no = $request->contact_no;
        //     $member->owner_address = $request->permanent_address;
        //     $member->pan = $request->member_pan;
        //     $member->member_mother_name = $request->member_mother_name;
        //     $member->member_father_name = $request->member_father_name;
        //     $member->member_gender = $request->member_gender;
        //     $member->member_dob = $request->member_dob;
        //     $member->member_date_of_marrige = $request->member_date_of_marrige;
        //     $member->member_occupation = $request->member_occupation;
        //     $member->aadhar = $request->member_aadhar;
        //     $member->save();
        // }


        if($request->is_nominee){

            // Nomination_detail::where('owner_id', $service->id)->delete();

            foreach ($request->nominator_name as $key=>$vals)
             {
                 $nomination = new Nomination_detail();
                 $nomination->owner_id = $service->id;
                 $nomination->nominated_name = $request->nominated_name[$key];
                 $nomination->percentage = $request->percentage[$key];
                 $nomination->nominator_name = $vals;
                 if(isset($request->owner_unit) && count($request->owner_unit) > 0){
                     $nomination->owner_unit = implode(',',$request->owner_unit);
                 }
                 $nomination->save();
            }
        }



        if($request->is_vehicle){

            // Nomination_detail::where('owner_id', $service->id)->delete();

            foreach ($request->vehicleflat_no as $key=>$vals)
             {
                 $vehicle = new SocietyParking();
                 $vehicle->society_id = session()->get('society_id');
                 $vehicle->created_by = auth()->guard('admin')->user()->id;
                 $vehicle->owner_id = $service->id;
                 $vehicle->owner_name = $service->owner_name;
                 $vehicle->flat_no = $request->vehicleflat_no[$key];
                 $vehicle->vehicle_type = $request->vehicle_type[$key];
                 $vehicle->rc_number = $request->rc_number[$key];
                 $vehicle->vehicle_no = $request->vehicle_no[$key];

                 $vehicle->is_insured = $request->is_insured[$key];
                 $vehicle->parking_no = $request->parking_no[$key];
                 $vehicle->save();
            }
        }


        if($request->is_family){

            // Nomination_detail::where('owner_id', $service->id)->delete();

            foreach ($request->family_name as $key=>$vals)
             {
                 $kids = new SocietyFamily();
                 $kids->society_id = session()->get('society_id');
                 $kids->owner_id = $service->id;
                //  $kids->society_member_id = $member->id;
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
        return response()->json([
            'status' => true,
            'msg' => 'Owner created successfully'
			]);

    }


    public function show($id){

        $owner = Owner::with('committe_details','society_members_details','nominee_details')->find($id);
        $data = array();
        $data['title'] = "View Owner";
        return view('admin.tenantnew.owner-show',compact('owner','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $group = CommitteeGroup::get();
        $management_member = Management_member_type::get();
        // $post = Owner::with('committe_details','society_members_details','parking_details','workers','security')->find($id);
        $committee = Managementcommittee::get();
        $owner_unit = Unit::get();

        $post = Owner::with('user','committe_details','family_details','nominee_details','parking_details')->find($id);
        // prd($post);
        $data['title'] = "Edit Tenant";
        $data['url'] = route('tenantinfo-update',$id);


        return view('admin.tenantnew.owner-create',compact('post','data','owner_unit','committee','management_member','group'));
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
            'owner_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'contact_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'aadhar' => 'required',
            'owner_unit' => 'required',
            'username' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Owner::find($id);


        $user = User::find($service->user_id);
        $user->society_id = session()->get('society_id');
        $user->name = $request->owner_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->mobile = $request->contact_no;
        $service->role = 'tenant';
        $user->password =  Hash::make($request->password);
        $user->save();


        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->owner_name;
        $service->email = $request->email;
        $service->username = $request->username;
        $service->mobile = $request->contact_no;
        $service->password =  Hash::make($request->password);


        // $service->owner_name = $request->owner_name;
        // $service->email = $request->email;
        // $service->password =  Hash::make($request->password);
        // $service->contact_no = $request->contact_no;
        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->aadhar = $request->aadhar;

        $service->property_type = $request->property_type;
        $service->property_owned = $request->property_owned;
        $service->flat_no = $request->flat_no;
        $service->mother_name = $request->mother_name;
        $service->father_name = $request->father_name;
        $service->gender = $request->gender;
        $service->dob = $request->dob;
        $service->date_of_marrige = $request->date_of_marrige;
        $service->occupation = $request->occupation;
        $service->office_address = $request->office_address;

        if(isset($request->owner_unit) && count($request->owner_unit) > 0){
            $service->owner_unit = implode(',',$request->owner_unit);
        }
        if($request->hasFile('owner_photo'))
        {
            $image = 'owner_'.time().'.'.$request->owner_photo->extension();
            $request->owner_photo->move(public_path('uploads/owner'), $image);
            $image = "/uploads/owner/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        if($request->is_nominee){

            Nomination_detail::where('owner_id', $service->id)->delete();

            foreach ($request->nominator_name as $key=>$vals)
            {
                $nomination = new Nomination_detail();
                $nomination->owner_id = $service->id;
                $nomination->nominated_name = $request->nominated_name[$key];
                $nomination->percentage = $request->percentage[$key];
                $nomination->nominator_name = $vals;
                if(isset($request->owner_unit) && count($request->owner_unit) > 0){
                    $nomination->owner_unit = implode(',',$request->owner_unit);
                }
                $nomination->save();
            }
        }


        if($request->is_committe){

            $committee = Managementcommittee::where('owner_id', $service->id)->first();
            if(!$committee){
                $committee = new Managementcommittee();
            }
            $committee->society_id = session()->get('society_id');
            $committee->owner_id = $service->id;
            $committee->user_id = Auth::guard('admin')->user()->id;
            $committee->email = $request->email;
            $committee->aadhar = $request->aadhar;
            $committee->group_id = $request->group_id;
            $committee->pan = $request->pan;
            $committee->name = $request->committe_name;
            $committee->designation = $request->designation;
            $committee->phone = $request->committee_contact_no;
            $committee->joining_date = $request->joining_date;
            $committee->ending_date = $request->ending_date;
            $committee->present_address = $request->present_address;
            $committee->present_address = $request->present_address;
            if($request->hasFile('committee_photo'))
            {
                $image = 'committee_'.time().'.'.$request->committee_photo->extension();
                $request->committee_photo->move(public_path('uploads/committee'), $image);
                $image = "/uploads/committee/".$image;
                $committee->photo = $image;
            }
            $committee->save();
        }

        // if($request->member_contact_no){

        //     $member = SocietyMembers::where('owner_id', $service->id)->first();
        //     if(!$member){
        //         $member = new SocietyMembers();
        //     }
        //     $member->society_id = session()->get('society_id');
        //     $member->owner_id = $service->id;
        //     $member->full_name = $request->full_name;
        //     $member->flat_no = $request->flat_no;
        //     $member->contact_no = $request->member_contact_no;
        //     $member->property_type = $request->property_type;
        //     $member->property_owned = $request->property_owned;
        //     $member->address = $request->address;
        //     $member->updated_by =  Auth::guard('admin')->user()->id;
        //     $member->property_owner_name = $request->owner_name;
        //     $member->owner_contact_no = $request->contact_no;
        //     $member->owner_address = $request->permanent_address;
        //     $member->pan = $request->pan;
        //     $member->member_mother_name = $request->member_mother_name;
        //     $member->member_father_name = $request->member_father_name;
        //     $member->member_gender = $request->member_gender;
        //     $member->member_dob = $request->member_dob;
        //     $member->member_date_of_marrige = $request->member_date_of_marrige;
        //     $member->member_occupation = $request->member_occupation;
        //     $member->aadhar = $request->aadhar;
        //     $member->save();
        // }

        if($request->is_vehicle){

            SocietyParking::where('owner_id', $service->id)->delete();

            foreach ($request->vehicleflat_no as $key=>$vals)
             {
                 $vehicle = new SocietyParking();
                 $vehicle->society_id = session()->get('society_id');
                 $vehicle->created_by = auth()->guard('admin')->user()->id;
                 $vehicle->owner_id = $service->id;
                 $vehicle->owner_name = $service->owner_name;
                 $vehicle->flat_no = $request->vehicleflat_no[$key];
                 $vehicle->vehicle_type = $request->vehicle_type[$key];
                 $vehicle->rc_number = $request->rc_number[$key];
                 $vehicle->vehicle_no = $request->vehicle_no[$key];

                 $vehicle->is_insured = $request->is_insured[$key];
                 $vehicle->parking_no = $request->parking_no[$key];
                 $vehicle->save();
            }
        }

        if($request->is_family){

            // SocietyFamily::where('owner_id', $service->id)->where('society_member_id',$member->id)->delete();
            SocietyFamily::where('owner_id', $service->id)->delete();


            foreach ($request->family_name as $key=>$vals)
             {
                 $kids = new SocietyFamily();
                 $kids->society_id = session()->get('society_id');
                 $kids->owner_id = $service->id;
                //  $kids->society_member_id = $member->id;
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

        return response()->json([
            'status' => true,
            'msg' => 'Owner updated successfully'
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
        Owner::find($id)->delete();
        SocietyFamily::where('owner_id', $id)->delete();
        Nomination_detail::where('owner_id', $id)->delete();
        SocietyMembers::where('owner_id', $id)->delete();
        Managementcommittee::where('owner_id', $id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Owner deleted successfully'
			]);
    }




    public function parkingdestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parking_id'=>'required|exists:society_parking,id',
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

        SocietyParking::find($request->parking_id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Owner Parking deleted successfully'
			]);
    }

    public function familydestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'family_id'=>'required|exists:society_family_members,id',
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

        SocietyFamily::find($request->family_id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Owner Family deleted successfully'
			]);
    }


    public function nomineedestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nominee_id'=>'required|exists:nomination_detail,id',
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

        Nomination_detail::find($request->nominee_id)->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Owner Nominee deleted successfully'
			]);
    }



}
