<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;
use Auth;
use App\Models\Society;
use App\Models\SocietyCommitte;
use App\Models\SocietyMembers;
use App\Models\SocietyFamily;
use App\Models\SocietyParking;
use App\Models\SocietyWorkers;
use App\Models\SocietySecurity;
use App\Models\Nomination_detail;
use App\Models\Admin;

class SocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Society::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="'.route("society-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a><a  style="margin-right: 15px;" href="'.route("society-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('society-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Society";
        $data['url'] = route('society-list');

        return view('admin.society.society',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array();
        $data['title'] = "Create Society";
        $data['url'] = route('society-save');



        return view('admin.society.society-create',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        // prd($request->all());

        $validator = Validator::make($request->all(), [
            'society_name' => 'required',
            'society_address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'pincode' => 'required|digits:6',
            'society_unique_id' => 'required|unique:society,society_unique_id',
            'total_flats' => 'nullable',
            'emergency_contact_no' => 'required|digits:10',
            'secrataty_mobile' => 'required|digits:10',
            'email'=>'required|unique:society,email',
            'rwa_registration'=>'required',
            'registration_date'=>'required|date',
            'election_due_date'=>'required',
            'last_election_held'=>'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $post = new Admin();
        $post->email = $request->email;
        $post->password =  Hash::make($request->password);
        $post->save();

        $post->assignRole(2);

        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->user()->id;
        $data['created_by'] = Auth::guard('admin')->user()->id;

        $society = Society::create($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'Society created successfully'
			]);

    }


    public function show($id){

        $post = Society::with('committe_details','society_members_details','parking_details','workers','security')->find($id);
        $data['title'] = "View society";
        $data['url'] = route('society-update',$id);
        return view('admin.society.society-show',compact('data','post'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = Society::with('committe_details','society_members_details','parking_details','workers','security')->find($id);
      //  prd($post);
        $data['title'] = "Edit society";
        $data['url'] = route('society-update',$id);

        return view('admin.society.society-edit',compact('post','data'));
    }

    public function societyMemberupdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            // 'flat_no' => 'required',
            // 'contact_no' => 'required|digits:10',
            'property_type' => 'required|string',
            'property_owned' => 'required',
            // 'address' => 'required',
            'property_owner_name' => ($request->property_owned==0)?'required|string':'',
            'owner_contact_no' => ($request->property_owned==0)?'required|digits:10':'',
            'owner_address' => ($request->property_owned==0)?'required':'',
            // 'family_contact_no.*'=>'required|unique:society_family_members,family_contact_no,13'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

        $data = $request->all();
        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $societyMembers =  SocietyMembers::updateOrCreate(['society_id'=>$id],$data);

        $familtyData = $request->except('_token','full_name','flat_no','contact_no','is_committee_member','is_add_family_members','is_vehicle','is_staff_members','is_nominee','name','designation','from_date','till_date','owner_name','vehicle_type','rc_number','is_insured','parking_no','f_name','permanent_address','aadhar_card','property_type','property_owned','address','nominator_name','nominated_name','percentage','property_owner_name','owner_contact_no','owner_address');

// prd($request->all());
        $getActualData  = $this->getInsertableData($familtyData);

        DB::table('society_family_members')->where(['society_id'=>$id,'society_member_id'=>$societyMembers->id])->delete();


            foreach($getActualData as $key=>$vals){

                    $family = SocietyFamily::where('society_id',$id)->where('society_member_id',$societyMembers->id)->where('family_contact_no',$getActualData[$key]['family_contact_no'])->first();
                    if(!$family){
                        $family = new SocietyFamily();
                    }
                    $family->society_id = $id;
                    $family->society_member_id = $societyMembers->id;

                    $family->family_name =  $getActualData[$key]['family_name'];
                    $family->family_father_name =  $getActualData[$key]['family_father_name'];
                    $family->family_mother_name =  $getActualData[$key]['family_mother_name'];
                    $family->family_gender =  $getActualData[$key]['family_gender'];
                    $family->family_contact_no =  $getActualData[$key]['family_contact_no'];
                    $family->family_dob =  $getActualData[$key]['family_dob'];
                    $family->family_marriage =  $getActualData[$key]['family_marriage'];
                    $family->family_occupation =  $getActualData[$key]['family_occupation'];
                    $family->save();

            }


            $nomineeData = $request->except('_token','full_name','family_name','family_father_name','family_occupation','family_marriage','family_dob','family_contact_no','family_mother_name','family_gender','flat_no','contact_no','is_committee_member','is_add_family_members','is_vehicle','is_staff_members','is_nominee','name','designation','from_date','till_date','owner_name','vehicle_type','rc_number','is_insured','parking_no','f_name','permanent_address','aadhar_card','property_type','property_owned','address','property_owner_name','owner_contact_no','owner_address');
// prd($nomineeData);
            $getNomineeData  = $this->getInsernomineetableData($nomineeData);

            DB::table('nomination_detail')->where('society_id',$id)->delete();

            foreach($getNomineeData as $key=>$vals){

                $nominee = Nomination_detail::where('society_id',$id)->where('nominator_name',$getNomineeData[$key]['nominator_name'])->first();
                if(!$nominee){
                    $nominee = new Nomination_detail();
                }
                $nominee->society_id = $id;
                $nominee->owner_id = $societyMembers->id;

                $nominee->nominator_name =  $getNomineeData[$key]['nominator_name'];
                $nominee->nominated_name =  $getNomineeData[$key]['nominated_name'];
                $nominee->percentage =  $getNomineeData[$key]['percentage'];
                $nominee->save();

            }



            $society = Society::find($id);
            $society->is_nominee = $request->is_nominee;
            $society->is_staff_members = $request->is_staff_members;
            $society->is_vehicle = $request->is_vehicle;
            $society->is_add_family_members = $request->is_add_family_members;
            $society->is_committee_member = $request->is_committee_member;
            $society->save();

        return response()->json([
            'status' => true,
            'msg' => 'Society Members Details updated successfully'
			]);

    }

    public function societyParkingupdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'owner_name' => 'required',
            'flat_no' => 'required',
            'vehicle_type' => 'required',
            'rc_number' => 'required',
            'is_insured' =>'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

        $data = $request->all();
        $data['created_by'] = Auth::guard('admin')->user()->id;

        $society = SocietyParking::updateOrCreate(['society_id'=>$id],$data);

        return response()->json([
            'status' => true,
            'msg' => 'Society Parking updated successfully'
		]);

    }

    public function societyWorkersupdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'f_name' => 'required',
            'aadhar_card'=>'required|digits:12',
            'address' => 'required|string',
            'permanent_address' => 'required',
            'flat_no' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

        $data = $request->all();
        $data['created_by'] = Auth::guard('admin')->user()->id;

        $society = SocietyWorkers::updateOrCreate(['society_id'=>$id],$data);

        return response()->json([
            'status' => true,
            'msg' => 'Society Workers updated successfully'
		]);

    }

    public function societySecurityupdate(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'fathers_name' => 'required',
            'dob' => 'required',
            'education' => 'required|string',
            'address'=>'required',
            'aadhar_card'=>'required|digits:12',
            'permanent_address' => 'required',
            'is_security_agency'=>'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->all();
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $society = SocietySecurity::updateOrCreate(['society_id'=>$id],$data);

        return response()->json([
            'status' => true,
            'msg' => 'Society Security updated successfully'
		]);

    }



    public function committeUpdate(Request $request, $id){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'contact_no' => 'required|digits:10',
            'from_date' => 'required',
            'till_date' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $data = $request->except('_token');
        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $society = SocietyCommitte::updateOrCreate(['society_id'=>$id],$data);

        return response()->json([
            'status' => true,
            'msg' => 'Committe updated successfully'
			]);


    }

    public function getInsertableData($array){

        $data = array();

        foreach($array as $key1=>$vals1){
            foreach($vals1 as $key2=>$vals1){
                $data[$key2][$key1] = $vals1;
            }
        }
        return $data;
    }


    public function getInsernomineetableData($array){

        $data = array();

        foreach($array as $key1=>$vals1){
            foreach($vals1 as $key2=>$vals1){
                $data[$key2][$key1] = $vals1;
            }
        }
        return $data;
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
            'society_name' => 'required',
            'society_address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'pincode' => 'required|digits:6',
            'society_unique_id' => 'required|unique:society,society_unique_id,'.$id,
            'total_flats' => 'nullable',
            'emergency_contact_no' => 'required|digits:10',
            'secrataty_mobile' => 'required|digits:10',
            'email'=>'required|unique:society,email,'.$id,
            'rwa_registration'=>'required',
            'registration_date'=>'required|date',
            'election_due_date'=>'required',
            'last_election_held'=>'required'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $data = $request->except('_token');
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $society = Society::find($id)->update($data);


        return response()->json([
            'status' => true,
            'msg' => 'Society updated successfully'
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
        Society::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Society deleted successfully'
			]);
    }
}
