<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Floor;
use App\Models\Unit;
use App\Models\Year;
use App\Models\Month;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class VendorController extends Controller
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

            $data = Vendor::where(function($query){
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

                        $btn = '<a href="'.route("vendor-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("vendor-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('vendor-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

        $data['title'] = "List Vendor";
        $data['url'] = route('vendor-list');

        return view('admin.vendor.vendor',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = Service::get();
        $data = array();
        $data['title'] = "Create Vendor";
        $data['url'] = route('vendor-save');
        return view('admin.vendor.vendor-create',compact('data','service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile'=>'required|digits:10',
            'email'=>'required|email'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Vendor();
        if(isset($request->services) && count($request->services) > 0){
            $service->services = implode(',',$request->services);
        }
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->contact_name = $request->contact_name;
        $service->mobile =  $request->mobile;
        $service->email = $request->email;
        $service->notes = $request->notes;
        $service->account_head = $request->account_head;
        $service->end_date = $request->end_date;
        $service->start_date = $request->start_date;
        $service->tds_rate = $request->tds_rate;
        $service->service_tax_rate = $request->service_tax_rate;
        $service->service_tax_registration = $request->service_tax_registration;
        $service->gstin = $request->gstin;
        $service->cgst_rate = $request->cgst_rate;
        $service->gst_rate = $request->gst_rate;
        $service->pan_no = $request->pan_no;
        $service->legal_type = $request->legal_type;
        $service->payee_name = $request->payee_name;
        $service->billing_address = $request->billing_address;
        $service->section_code = $request->section_code;
        $service->account_no = $request->account_no;
        $service->branch_name = $request->branch_name;
        $service->bank_code = $request->bank_code;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Vendor created successfully'
			]);

    }


    public function show($id){

        $vendor = Vendor::find($id);
        $data = array();
        $data['title'] = "View Vendor";
        return view('admin.vendor.vendor-show',compact('vendor','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $service = Service::get();
        $year = Year::get();
        $month = Month::get();
        $post = Vendor::find($id);
        $data['title'] = "Edit Vendor";
        $data['url'] = route('vendor-update',$id);
        $floor= Floor::get();
        $unit= Unit::get();

        return view('admin.vendor.vendor-create',compact('post','data','floor','unit','month','year','service'));
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
            'mobile'=>'required|digits:10',
            'email'=>'required|email'
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Vendor::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        if(isset($request->services) && count($request->services) > 0){
            $service->services = implode(',',$request->services);
        }
        $service->contact_name = $request->contact_name;
        $service->mobile =  $request->mobile;
        $service->email = $request->email;
        $service->notes = $request->notes;
        $service->account_head = $request->account_head;
        $service->end_date = $request->end_date;
        $service->start_date = $request->start_date;
        $service->tds_rate = $request->tds_rate;
        $service->service_tax_rate = $request->service_tax_rate;
        $service->service_tax_registration = $request->service_tax_registration;
        $service->gstin = $request->gstin;
        $service->cgst_rate = $request->cgst_rate;
        $service->gst_rate = $request->gst_rate;
        $service->pan_no = $request->pan_no;
        $service->legal_type = $request->legal_type;
        $service->payee_name = $request->payee_name;
        $service->billing_address = $request->billing_address;
        $service->section_code = $request->section_code;
        $service->account_no = $request->account_no;
        $service->branch_name = $request->branch_name;
        $service->bank_code = $request->bank_code;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Vendor updated successfully'
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
        Vendor::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Vendor deleted successfully'
			]);
    }
}
