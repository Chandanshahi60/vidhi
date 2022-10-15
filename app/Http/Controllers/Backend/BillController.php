<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\Year;
use App\Models\Bill_type;
use App\Models\Month;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class BillController extends Controller
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

            $data = Bill::where(function($query){
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

                        $btn = '<a href="'.route("bill-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a  style="margin-right: 15px;" href="'.route("bill-view", $row->id).'" class="edit btn btn-primary  "><i class="fa fa-eye"></i></a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('bill-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Bill";
        $data['url'] = route('bill-list');

        return view('admin.bill.bill',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $year = Year::get();
        $bill_type = Bill_type::get();
        $month = Month::get();
        $data = array();
        $data['title'] = "Create Bill";
        $data['url'] = route('bill-save');

        return view('admin.bill.bill-create',compact('data','year','month','bill_type'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
           'bill_type' => 'required',
           'bill_date' => 'required',
           'bill_month' => 'required',
           'year' => 'required',
           'total_amt' => 'required',
           'deposite_bank_name' => 'required',
           'details' => 'required',
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

        $service = new Bill();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->bill_type = $request->bill_type;
        $service->bill_date = $request->bill_date;
        $service->bill_month = $request->bill_month;
        $service->year = $request->year;
        $service->total_amt = $request->total_amt;
        $service->deposite_bank_name = $request->deposite_bank_name;
        $service->details = $request->details;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Bill created successfully'
			]);

    }


    public function show($id){

        $bill = Bill::find($id);
        $data = array();
        $data['title'] = "View Bill";
        return view('admin.bill.bill-show',compact('bill','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $bill_type = Bill_type::get();
        $year = Year::get();
        $month = Month::get();
        $post = Bill::find($id);
        $data['title'] = "Edit Bill";
        $data['url'] = route('bill-update',$id);
        return view('admin.bill.bill-create',compact('post','data','month','year','bill_type'));
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
            'bill_type' => 'required',
            'bill_date' => 'required',
            'bill_month' => 'required',
            'year' => 'required',
            'total_amt' => 'required',
            'deposite_bank_name' => 'required',
            'details' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Bill::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->bill_type = $request->bill_type;
        $service->bill_date = $request->bill_date;
        $service->bill_month = $request->bill_month;
        $service->year = $request->year;
        $service->total_amt = $request->total_amt;
        $service->deposite_bank_name = $request->deposite_bank_name;
        $service->details = $request->details;
        $service->status = $request->status;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Bill updated successfully'
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
        Bill::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Bill deleted successfully'
			]);
    }
}
