<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FrontUser;
use App\Models\Vendor;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;

class NotificationController extends Controller
{
    /**

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

    */




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data = array();
        $data['title'] = "Create Notification";
        $data['url'] = route('notification-store');
        $user = DB::table('users')->get();
        $vendor = DB::table('vendor')->where('status',1)->get();

        // echo "<pre>";print_r($vendor);
        // exit;

        return view('admin.notification.notification-create',compact('user','vendor','data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_type' => 'required',
        ]);


        if ($validator->fails()){
           return response()->json([
            'status' => false,
            'errors' => $validator->errors()
            ]);
        }

        if($request->user_type==1){
            $tokenArray =  User::whereIn('id',$request->user_id)->whereNotNull('device_key')->where('status',1)->pluck('device_key')->toArray();
        }
        else{
            $tokenArray =  Vendor::whereIn('id',$request->id)->whereNotNull('device_key')->where('status',1)->pluck('device_key')->toArray();
        }
       // prd($tokenArray);



        if($request->hasFile('image')){
            $banner = 'image'.time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/notification'), $banner);
            $banner = "/uploads/notification/".$banner;

        }

        // 'http://apneedukan.com/meraroom/public/admin/assets/images/dashboard/logo.jpg'

        $message=   array(
            'title' => 'Notification',
            'body' =>  $request->message ,
            'sound'=>'Default',
            'image'=> asset($banner),
            "content_available" => true,
            "priority" => "high"
        );

         if($request->user_type==1){
                $this->sendPushNotificationToFCMSeverToCustomer($tokenArray,$message,$message);
         }
         else{
                $this->sendPushNotificationToFCMSeverVendor([implode(',',$tokenArray)],$message,$message);
         }


        return response()->json([
            'status' => true,
            'msg' => 'Notification created successfully'
        	]);

    }


    public function sendPushNotificationToFCMSeverToCustomer($tokenarr=array(), $message=array(),$extraNotificationData=array()){


        $notificationkey = 'AAAAA7JiY8Y:APA91bEWVyQI3vkxkZiMJLaoajkaFAmZqehPW5gQFnUCaCoqVv9MydzF0dNbKowQLYhPQwz0h6yP5tLhOs78ca1lZ-s5tfn7bl436Lz0R-w4y_8e06gavSSIP7V323ilbbz3u725TF9W';

        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' =>$tokenarr,
            'priority' =>  'high' ,
            'notification' =>$message,
            'data'=>$message
        );


        $headers = array(
            'Authorization:key='.$notificationkey,
            'Content-Type:application/json'
        );

        $ch = curl_init();

        // Set the url, number of POST vars, POST data

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }



        public function sendPushNotificationToFCMSeverVendor($tokenarr=array(), $message=array(),$extraNotificationData=array()) {
       /*
        echo "<pre>";print_r($tokenarr);
        exit;
        */
        $notificationkey = 'AAAAhiK7DDg:APA91bEua6tEFrKfXmxODRXxhx81Ru8hBi2GuggKxRTFFEe2_l10J0HjH9LiQRPVU3Lb4VpTPsLlIUnyk8wWi2t2xg1rOhmQz0g1UM2YICEd8iXRSCFUIvsLZTLbwYo2eYQfLkub70lU';
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        /* $message=   array(
        		'title' => 'Booking ID 4745547',
				'body' =>  'Your Booking has Been Done ' ,
				'sound'=>'Default',
				'image'=> ''
			); */

        $fields = array(
            'registration_ids' =>$tokenarr,
            'priority' =>  'high' ,
            'notification' =>$message,
            'data'=>$message
        );
//echo json_encode($fields);die;
        $headers = array(
            'Authorization:key='.$notificationkey,
            'Content-Type:application/json'
        );
        // print_r($fields);die;
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        //sleep(2);
        //print_r($result);die;
        return $result;
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dayslot = DaySlots::find($id);
        $dayslot->timeslot = TimeSlots::where('day_slot_id',$dayslot->id)->get();
        return view('admin.slot.slot-edit',compact('dayslot'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
        ]);

        if ($validator->fails())
        {
		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}


        $post = DaySlots::find($id);
        $post->date = $request->date;
        $post->save();

        TimeSlots::where('day_slot_id',$id)->delete();

        foreach($request->start_time as $key=>$vals)
        {
            $start_time = date('h:i A',strtotime($vals));
            $end_time = date('h:i A',strtotime($request->end_time[$key]));


            $timeslot = new TimeSlots();
            $timeslot->day_slot_id = $post->id;
            $timeslot->timeslots = $start_time.' To '.$end_time;
            $timeslot->created_at = date('Y-m-d H:i:s');
            $timeslot->updated_at = date('Y-m-d H:i:s');
            $timeslot->save();
        }


        return response()->json([
            'status' => true,
            'msg' => 'TimeSlots updated successfully'
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
        TimeSlots::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'TimeSlots deleted successfully'
			]);
    }
}
