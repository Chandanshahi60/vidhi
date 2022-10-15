<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Rent;
use App\Models\Unit;
use App\Models\Year;
use App\Models\Month;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class RentController extends Controller
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

            $data = Rent::with('unit','floor')->where(function($query){
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

                        $btn = '<a href="'.route("rent-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("rent-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('rent-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Rent";
        $data['url'] = route('rent-list');

        return view('admin.rent.rent',compact('data'));
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
        $data['title'] = "Create Rent";
        $data['url'] = route('rent-save');

        return view('admin.rent.rent-create',compact('data','floor','unit','year','month'));
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
            'month' => 'required',
            'year' => 'required',
            'renter_name' => 'required',
            'rent' => 'required',
            'water_bill' => 'required',
            'electric_bill' => 'required',
            'gas_bill' => 'required',
            'security_bill' => 'required',
            'total_rent' => 'required',
            'utility_bill' => 'required',
            'issue_date' => 'required',
            'bill_paid_date' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Rent();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->floor_no = $request->floor_no;
        $service->unit_no = $request->unit_no;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->renter_name = $request->renter_name;
        $service->rent = $request->rent;
        $service->water_bill = $request->water_bill;
        $service->electric_bill = $request->electric_bill;
        $service->gas_bill = $request->gas_bill;
        $service->security_bill = $request->security_bill;
        $service->utility_bill = $request->utility_bill;
        $service->other_bill = $request->other_bill;
        $service->total_rent = $request->total_rent;
        $service->issue_date = $request->issue_date;
        $service->bill_paid_date = $request->bill_paid_date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Rent created successfully'
			]);

    }


    public function show($id){

        $rent = Rent::find($id);
        $data = array();
        $data['title'] = "View Rent";
        return view('admin.rent.rent-show',compact('rent','data'));
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
        $post = Rent::find($id);
        $data['title'] = "Edit Rent";
        $data['url'] = route('rent-update',$id);

        $floor= Floor::get();
        $unit= Unit::get();
        return view('admin.rent.rent-create',compact('post','data','floor','unit','year','month'));
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
            'month' => 'required',
            'year' => 'required',
            'renter_name' => 'required',
            'rent' => 'required',
            'water_bill' => 'required',
            'electric_bill' => 'required',
            'gas_bill' => 'required',
            'security_bill' => 'required',
            'total_rent' => 'required',
            'utility_bill' => 'required',
            'issue_date' => 'required',
            'bill_paid_date' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Rent::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->floor_no = $request->floor_no;
        $service->unit_no = $request->unit_no;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->renter_name = $request->renter_name;
        $service->rent = $request->rent;
        $service->water_bill = $request->water_bill;
        $service->electric_bill = $request->electric_bill;
        $service->gas_bill = $request->gas_bill;
        $service->security_bill = $request->security_bill;
        $service->utility_bill = $request->utility_bill;
        $service->other_bill = $request->other_bill;
        $service->total_rent = $request->total_rent;
        $service->issue_date = $request->issue_date;
        $service->bill_paid_date = $request->bill_paid_date;
        $service->status = $request->status;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Rent updated successfully'
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
        Rent::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Rent deleted successfully'
			]);
    }
}
