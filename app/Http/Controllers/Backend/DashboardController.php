<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Owner_Utility;
use App\Models\Rent;
use App\Models\Employee;
use App\Models\Tenant;
use App\Models\Visitors;
use App\Models\MaintenanceCost;
use App\Models\Fund;
use App\Models\Society;
use App\Models\Owner;
use App\Models\Service;

use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

       $unit = Unit::where('society_id',session()->get('society_id'))->count();
       $visitors = Visitors::where('society_id',session()->get('society_id'))->count();
       $tenent = Tenant::where('society_id',session()->get('society_id'))->count();
       $employee = Employee::where('society_id',session()->get('society_id'))->count();
       $rent = Rent::where('society_id',session()->get('society_id'))->get();
       $owner_utility = Owner_Utility::where('society_id',session()->get('society_id'))->get();
       $fund = Fund::where('society_id',session()->get('society_id'))->get();
       $maintenance_cost = MaintenanceCost::where('society_id',session()->get('society_id'))->get();
       $society = Society::where('id',session()->get('society_id'))->first();
       $service = Service::where('society_id',session()->get('society_id'))->count();
       $owner = Owner::where('society_id',session()->get('society_id'))->count();


        // echo session()->get('society_id');
        // exit;
        // echo"<pre>";print_r($society);exit;

        return view('admin.welcome',compact('unit','service','owner','visitors','tenent','employee','rent','owner_utility','fund','maintenance_cost','society'));
    }

    public function cities(Request $request){
       $cities = cities($request->state_id);
       $html = '';
       if($cities->count() > 0){
            foreach($cities as $key=>$vals){
                $html.='<option value="'.$vals->id.'">'.$vals->name.'</option>';
            }
       }
       else{
        $html.='<option value="">No Cities Found</option>';
       }
        return response()->json($html);
    }
}
