<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Employee_Salary;
use App\Models\Year;
use App\Models\Month;
use App\Models\Management_member_type;
use App\Models\Employee_Leave;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Validator;
use File;
use URL;

class EmployeeInfoController extends Controller
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

            $data = Employee::where(function($query){
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

                        $btn = '<a href="'.route("employee-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("employee-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('employee-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

                    ->addColumn('photo',function($row){
                        if(File::exists( public_path( $row->photo ) ) && $row->photo!=null){
                            $profile = url($row->photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Employee";
        $data['url'] = route('employee-list');

        return view('admin.employee_info.employee_info',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $management_member = Management_member_type::get();
        $data = array();
        $data['title'] = "Create Employee";
        $data['url'] = route('employee-save');
        return view('admin.employee_info.employee_info-create',compact('data','management_member'));
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
            'password' => 'required',
            'contact_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'aadhar' => 'required',
            'designation' => 'required',
            'joining_date' => 'required',
            'ending_date' => 'required',
            'photo' => 'required',
           // 'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Employee();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->password =  Hash::make($request->password);
        $service->contact_no = $request->contact_no;
        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->designation = $request->designation;
        $service->joining_date = $request->joining_date;
        $service->ending_date = $request->ending_date;
        if($request->hasFile('photo'))
        {
            $image = 'employee_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/employee'), $image);
            $image = "/uploads/employee/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Employee created successfully'
			]);

    }


    public function show($id){

        $employee = Employee::find($id);
        $data = array();
        $data['title'] = "View Employee";
        return view('admin.employee_info.employee_info-show',compact('employee','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $management_member = Management_member_type::get();

        $post = Employee::find($id);
        $data['title'] = "Edit Employee";
        $data['url'] = route('employee-update',$id);


        return view('admin.employee_info.employee_info-create',compact('post','data','management_member'));
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
            'password' => 'required',
            'contact_no' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'aadhar' => 'required',
            'designation' => 'required',
            'joining_date' => 'required',
            'ending_date' => 'required',
            'photo' => 'required',
           // 'status' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Employee::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->email = $request->email;
        $service->password =  Hash::make($request->password);
        $service->contact_no = $request->contact_no;
        $service->present_address = $request->present_address;
        $service->permanent_address = $request->permanent_address;
        $service->aadhar = $request->aadhar;
        $service->pan = $request->pan;
        $service->designation = $request->designation;
        $service->joining_date = $request->joining_date;
        $service->ending_date = $request->ending_date;
        if($request->hasFile('photo'))
        {
            $image = 'employee_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/employee'), $image);
            $image = "/uploads/employee/".$image;
            $service->photo = $image;
        }
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Employee updated successfully'
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
        Employee::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Employee deleted successfully'
			]);
    }






    ///employee salary



    public function salary_index(Request $request)
    {

        if ($request->ajax()) {

            $data = Employee_Salary::with('employee')->where(function($query){
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

                        $btn = '<a href="'.route("employee_salary-edit", $row->id).'" class="edit btn btn-primary   " style="margin-right: 15px;"><i class="fa fa-pencil"></i> </a>
                        <a href="'.route("employee_salary-view", $row->id).'" class="edit btn btn-primary viewDetail  " style="margin-right: 15px;"><i class="fa fa-eye"></i> </a>
                        <button  style="margin-right: 15px;" type="button" id="deleteButton" data-url="'.route('employee_salary-delete', $row->id).'" class="edit btn btn-primary ml-2 btn-sm deleteButton" data-loading-text="Deleted...." data-rest-text="Delete"><i class="fa fa-trash"></i> </button>';

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

                    ->addColumn('photo',function($row){
                        if(File::exists( public_path( $row->photo ) ) && $row->photo!=null){
                            $profile = url($row->photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['action','status','photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Employee Salary";
        $data['url'] = route('employee_salary-list');

        return view('admin.employee_info.employee_salary.employee_salary',compact('data'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function salary_create()
    {
        $management_member = Management_member_type::get();

        $year = Year::get();
        $month = Month::get();
        $employee = Employee::get();
        $data = array();
        $data['title'] = "Create Employee Salary";
        $data['url'] = route('employee_salary-save');
        return view('admin.employee_info.employee_salary.employee_salary-create',compact('data','month','year','employee','management_member'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     */
    public function salary_store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'month' => 'required',
            'year' => 'required',
            'per_month' => 'required',
            'issue_date' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        // echo session()->get('society_id');
        // exit;

        $service = new Employee_Salary();
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->designation = $request->designation;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->per_month = $request->per_month;
        $service->issue_date = $request->issue_date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();

        return response()->json([
            'status' => true,
            'msg' => 'Employee Salary created successfully'
			]);

    }


    public function salary_show($id){

        $employee = Employee_Salary::find($id);
        $data = array();
        $data['title'] = "View Employee Salary";
        return view('admin.employee_info.employee_salary.employee_salary-show',compact('employee','data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salary_edit($id){
        $management_member = Management_member_type::get();
        $year = Year::get();
        $month = Month::get();
        $employee = Employee::get();
        $post = Employee_Salary::find($id);
        $data['title'] = "Edit Employee Salary";
        $data['url'] = route('employee_salary-update',$id);


        return view('admin.employee_info.employee_salary.employee_salary-create',compact('post','month','year','data','employee','management_member'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salary_update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'month' => 'required',
            'year' => 'required',
            'per_month' => 'required',
            'issue_date' => 'required',
        ]);

        if ($validator->fails()){

		   return response()->json([
			'status' => false,
			'errors' => $validator->errors()
			]);
		}

        $service = Employee_Salary::find($id);
        $service->user_id = auth()->guard('admin')->user()->id;
        $service->society_id = session()->get('society_id');
        $service->name = $request->name;
        $service->designation = $request->designation;
        $service->month = $request->month;
        $service->year = $request->year;
        $service->per_month = $request->per_month;
        $service->issue_date = $request->issue_date;
        $service->status = $request->status;
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        return response()->json([
            'status' => true,
            'msg' => 'Employee Salary updated successfully'
			]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salary_destroy($id)
    {
        Employee_Salary::find($id)->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Employee Salary deleted successfully'
			]);
    }



    /////Employee Leave


    public function leave_index(Request $request)
    {

        if ($request->ajax()) {

            $data = Employee_leave::where(function($query){
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

                    ->addColumn('photo',function($row){
                        if(File::exists( public_path( $row->photo ) ) && $row->photo!=null){
                            $profile = url($row->photo);
                            return "<img src='$profile'  style='height:100px;width:100px;' />";
                        }
                        else{
                            return "N/A";
                        }

                    })

                    ->rawColumns(['status','photo'])
                    ->make(true);
        }
        $data = array();

        $data['title'] = "List Employee Leave";
        $data['url'] = route('employee_leave-list');

        return view('admin.employee_info.employee_leave.employee_leave',compact('data'));
    }




}
