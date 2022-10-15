<?php
namespace App\Http\Controllers\API\V1;
use App\Models\User;
use App\Models\Owner;
use App\Models\Banner;
use App\Models\Events;
use App\Models\Social;
use App\Models\EventsImage;
use App\Models\Visitors;
use App\Models\Service;
use App\Models\SocietyFamily;
use App\Models\TenentFamily;
use App\Models\Notice_owner;
use App\Models\Notice_tenant;
use App\Models\Notice_employee;
use App\Models\Tenant;
use Validator;
use Auth;
use Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppDataController extends Controller
{
    public function __construct()
    {


    }

    public function UpdateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
			'name'=>'nullable',
        	'email'=>'nullable|email|unique:users,email',
            'mobile'=>'nullable|numeric|digits:10|unique:users,mobile',
            'address'=>'nullable',
            'profile_pic'=>'nullable'
        ]);

		if ($validator->fails())
		{
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


		$users = User::where('id',auth()->guard('api')->user()->id)->first();

		if($request->has('name')  && $request->name!=null)
		{
			$users->name = $request->name;
		}
		if($request->has('email')  && $request->email!=null)
		{
			$users->email = $request->email;
		}

		if($request->has('mobile') && $request->mobile!=null)
		{
			$users->mobile = $request->mobile;
		}

        $users->save();


        if($users->role == 'owner')
        {
            $owner = Owner::where('user_id',$users->id)->first();

            if($request->has('address') && $request->address!=null)
            {
                $owner->present_address = $request->address;
            }

            if($request->has('profile_pic') && $request->profile_pic!=null)
            {
                $profile_image = 'profile_'.time().'.'.$request->profile_pic->extension();
                $request->profile_pic->move(public_path('uploads/profile'), $profile_image);
                $profile_image = "uploads/profile/".$profile_image;
                $owner->owner_photo = $profile_image;
            }
            $owner->save();
        }
        elseif($users->role == 'tenant')
        {
            $tenant = Tenant::where('user_id',$users->id)->first();

            if($request->has('address') && $request->address!=null)
            {
                $tenant->address = $request->address;
            }

            if($request->has('profile_pic') && $request->profile_pic!=null)
            {
                $profile_image = 'profile_'.time().'.'.$request->profile_pic->extension();
                $request->profile_pic->move(public_path('uploads/profile'), $profile_image);
                $profile_image = "uploads/profile/".$profile_image;
                $tenant->tenant_photo = $profile_image;
            }

            $tenant->save();
        }


		$users->updated_at = date('Y-m-d H:i:s');



        return response()->json([
            'status' => true,
            'message' => 'Profile Updated Successfully'
        ]);
    }

    public function banner(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
            {
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

        $society_id = auth()->guard('api')->user()->society_id;
        $banner = Banner::where('society_id',$society_id)->get();

        return response()->json([
            'status' => true,
            'banner' => $banner
        ]);
    }


    public function userinfo(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
            {
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

        $user = auth()->guard('api')->user();
        // if($user->role == 'owner')
        // {
            $user = auth()->guard('api')->user();

            $user = Owner::where('id',$user->id)->first();
            return response()->json(['status' => true,'user' => $user]);
        // }
        // elseif($user->role == 'tenant')
        // {
        //     $user = auth()->guard('api')->user();

        //     $user = Tenant::where('user_id',$user->id)->select('tenant.*','users.name','users.email','users.mobile')->join('users','users.id','=','tenant.user_id')->first();
        //     return response()->json(['status' => true,'user' => $user]);
        // }

        return response()->json([
            'status' => true,
            'banner' => $user
        ]);
    }


    public function member(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
            {
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

        $user = auth()->guard('api')->user();

        $member = Owner::where('society_id',$user->society_id)->get();

        // foreach($member as $key=>$val)
        // {
        //      if($val->role == 'owner')
        //     {
        //         $val->details = Owner::where('user_id',$val->id)->select('*','owner_photo as photo','owner_unit as unit_no')->first();
        //     }
        //     elseif($val->role == 'tenant')
        //     {
        //       $val->details = Tenant::where('user_id',$val->id)->select('*','tenant_photo as photo')->first();
        //     }
        // }

        return response()->json([
            'status' => true,
            'member' => $member
        ]);
    }
    
    
    public function memberDetail(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'member_id'=>'required',
        ]);

        if ($validator->fails())
            {
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

        $user = auth()->guard('api')->user();

        $member = Owner::with('committe_details','nominee_details','parking_details','family_details','unit')->where('society_id',$user->society_id)->where('id',$request->member_id)->get();

        // foreach($member as $key=>$val)
        // {
        //      if($val->role == 'owner')
        //     {
        //         $val->details = Owner::where('user_id',$val->id)->select('*','owner_photo as photo','owner_unit as unit_no')->first();
        //     }
        //     elseif($val->role == 'tenant')
        //     {
        //       $val->details = Tenant::where('user_id',$val->id)->select('*','tenant_photo as photo')->first();
        //     }
        // }

        return response()->json([
            'status' => true,
            'member' => $member
        ]);
    }
    

    public function visitors(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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

        $society_id = auth()->guard('api')->user()->society_id;
        $visitors = Visitors::where('society_id',$society_id)->where('society_owner',auth()->guard('api')->user()->id)->get();

        return response()->json([
            'status' => true,
            'visitors' => $visitors
        ]);
    }


    public function events_list(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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
        $todate = date('Y-m-d');


        $society_id = auth()->guard('api')->user()->society_id;
        $upcomingevent = Events::where('society_id',$society_id)->where('end_date','>=',$todate)->get();
        $pastevent = Events::where('society_id',$society_id)->where('end_date','<',$todate)->get();

        return response()->json([
            'status' => true,
            'upcoming_event' => $upcomingevent,
            'past_event' => $pastevent
        ]);
    }

    public function event_detail(Request $request)
    {
         $validator = Validator::make($request->all(), [
        'event_id'=>'required'
        ]);

        if ($validator->fails())
    		{
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

        $society_id = auth()->guard('api')->user()->society_id;
        $event = Events::with('event_image')->where('society_id',$society_id)->where('id',$request->event_id)->get();

        return response()->json([
            'status' => true,
            'event' => $event
        ]);
    }
    
    
    public function socialconnects(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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


        $society_id = auth()->guard('api')->user()->society_id;
        $socialconnects = Social::with('social_images')->where('society_id',$society_id)->get();

        return response()->json([
            'status' => true,
            'social_connects' => $socialconnects,
        ]);
    }



    public function mydues(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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

        $society_id = auth()->guard('api')->user()->society_id;



        return response()->json([
            'status' => true,
            'mydues' => ([

            ['name' => 'Electricity',
            'price' => 500],
            [
            'name' => 'Lift Maintenance',
            'price' => 200
            ],
            [
            'name' => 'Society Maintenance',
            'price' => 500
            ]
            ])

        ]);
    }


    public function service(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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

        $society_id = auth()->guard('api')->user()->society_id;
        $services = Service::where('society_id',$society_id)->get();

        return response()->json([
            'status' => true,
            'services' => $services
        ]);
    }

    public function notice(Request $request)
    {
         $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails())
    		{
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

        $society_id = auth()->guard('api')->user()->society_id;
        $Owner_notice = Notice_owner::where('society_id',$society_id)->get();

        return response()->json([
            'status' => true,
            'Notice' => $Owner_notice,
        ]);
    }





}
