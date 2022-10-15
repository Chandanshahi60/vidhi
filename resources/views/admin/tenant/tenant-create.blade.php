@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('breadcrum')

@stop

@section('content')


<div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>{{ $data['title'] }}</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item">{{ $data['title'] }} </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-xl-12">
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                @csrf
              <div class="card">
                <div class="card-body">
                    <div class="row">

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="tenant_name">Tenant Name</label>
                      <input class="form-control" id="name" value="{{ (isset($post->user)?$post->user->name:'')}}" name="tenant_name" type="text" aria-describedby="" placeholder="Enter Tenant Name">
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="email">Email</label>
                      <input class="form-control" id="email" value="{{ (isset($post->user)?$post->user->email:'')}}" name="email" type="text" aria-describedby="" placeholder="Enter Email">
                    </div>

                     <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="username">Username</label>
                      <input class="form-control" id="username" value="{{ (isset($post->user)?$post->user->username:'')}}" name="username" type="text" aria-describedby="" placeholder="Enter Username">
                    </div>

                     <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="contact_no">Contact No</label>
                      <input class="form-control" value="{{ (isset($post->user)?$post->user->mobile:'')}}" id="contact_no" name="contact_no"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="password">Password</label>
                      <input class="form-control" value="{{ (isset($post->user)?$post->user->password:'')}}" id="password" name="password" type="password" aria-describedby="" placeholder="Enter password">
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="address">Address</label>
                      <input class="form-control" value="{{ (isset($post)?$post->address:'')}}" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Address">
                    </div>

                    {{-- <div class="mb-3">
                      <label class="col-form-label pt-0" for="nid">NID (National ID Card)</label>
                      <input class="form-control" value="{{ (isset($post)?$post->nid:'')}}" id="nid" name="nid" type="text" aria-describedby="" placeholder="Enter National ID Card">
                    </div> --}}

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="pan">Pan Card</label>
                      <input class="form-control" value="{{ (isset($post)?$post->pan:'')}}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="14" id="pan" name="pan" type="text" aria-describedby="" placeholder="Enter Pan Card">
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="aadhar">Aadhar Card</label>
                      <input class="form-control" value="{{ (isset($post)?$post->aadhar:'')}}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="aadhar" name="aadhar" aria-describedby="" placeholder="Enter AAdhar Card">
                    </div>

                    <div class="mb-3 col-md-3">
                       <label class="col-form-label pt-0" for="floor_no">Floor No</label>
                        <select class="form-select" onchange="getunit()"  id="floor_no" name="floor_no" >
                              <option value="">Select</option>
                              @foreach ($floor as $item)
                              <option @if(isset($post))  @if($post->floor_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->title}}</option>
                              @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                       <label class="col-form-label pt-0" for="unit_no">Available Unit No</label>
                        <select class="form-select" id="unit_no" name="unit_no" >
                              <option value="">Select</option>
                              @foreach ($unit as $item)
                              <option @if(isset($post))  @if($post->unit_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->unit_no}}</option>
                              @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="adv_rent">Advance Rent</label>
                      <input class="form-control" value="{{ (isset($post)?$post->adv_rent:'')}}" id="adv_rent" name="adv_rent" type="number" aria-describedby="" placeholder="Enter Advance Rent">
                    </div>

                    <div class="col-md-3">
                        <label class="col-form-label pt-0" for="start_date"> Start Date</label>
                        <input class="form-control" value="{{ (isset($post)?$post->start_date:'')}}" id="start_date" name="start_date" type="date" aria-describedby="" placeholder="Enter start_date">
                    </div>
                    <div class="col-md-3">
                            <label class="col-form-label pt-0" for="end_date"> End Date</label>
                        <input class="form-control" value="{{ (isset($post)?$post->end_date:'')}}" id="end_date" name="end_date" type="date" aria-describedby="" placeholder="Enter end_date">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="father_name">Father Name</label>
                        <input class="form-control" value="{{ (isset($post)?$post->father_name:'')}}" id="father_name" name="father_name" type="text" aria-describedby="" placeholder="Enter father_name">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="mother_name">Mother Name</label>
                        <input class="form-control" value="{{ (isset($post)?$post->mother_name:'')}}" id="mother_name" name="mother_name" type="text" aria-describedby="" placeholder="Enter mother_name">
                    </div>

                    <div class="mb-3 col-md-3">
                         <label class="col-form-label pt-0" for="gender">Gender</label>
                        <select class="form-select" id="gender" name="gender" >
                            <option value="">Select</option>
                            <option @if(isset($post)) @if($post->gender=='female') selected @endif  @endif value="female">FeMale</option>
                            <option  @if(isset($post)) @if($post->gender=='male') selected @endif  @endif value="male">Male</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="dob">DOB</label>
                        <input class="form-control" value="{{ (isset($post)?$post->dob:'')}}" id="dob" name="dob" type="date" aria-describedby="" placeholder="Enter dob">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="date_of_marrige">Date of Marriage</label>
                        <input class="form-control" value="{{ (isset($post)?$post->date_of_marrige:'')}}" id="date_of_marrige" name="date_of_marrige" type="date" aria-describedby="" placeholder="Enter date_of_marrige">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="occupation">Occupation</label>
                        <input class="form-control" value="{{ (isset($post)?$post->occupation:'')}}" id="occupation" name="occupation" type="text" aria-describedby="" placeholder="Enter Occupation">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="col-form-label pt-0" for="office_address">Office Address</label>
                        <input class="form-control" value="{{ (isset($post)?$post->office_address:'')}}" id="office_address" name="office_address" type="text" aria-describedby="" placeholder="Enter Office Address">
                    </div>

                    <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="year">Rent Year</label>
                        <select class="form-select" id="year" name="year" >
                              <option value="">Select Year</option>
                              @foreach ($year as $item)
                              <option @if(isset($post))  @if($post->year == $item->year_name) selected @endif @endif value="{{$item->year_name}}">{{$item->year_name}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>

                     <div class="mb-3 col-md-3">
                      <label class="col-form-label pt-0" for="title">Status</label>
                      <select class="form-select" id="status" name="status" >
                          <option value="">Select</option>
                          <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                          <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                      <label  class="col-form-label pt-0"> Tenant Photo </label>

                      <div class="row">
                          <div class="col-md-10 ">
                              <input id="image" type="file" class="form-control align-middle custom-file-input" name="tenant_photo" onchange="readURL(this, 'FileImg');">

                            </div>
                          <div class="col-md-2 ">
                          <img id="FileImg" value="{{ (isset($post)?$post->tenant_photo:'')}}" @if(isset($post))  @if($post->tenant_photo)  src="{{asset($post->tenant_photo)}}" @endif @else src="{{url('/uploads/profile/default.png')}}" @endif  style="width: 71px;height: 71px">

                          </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label  class="col-form-label pt-0">Upload Agreement</label>

                      <div class="row">
                          <div class="col-md-10 ">
                              <input id="agreement" type="file" class="form-control align-middle custom-file-input" name="agreement" onchange="readURL(this, 'FileImg');">

                            </div>
                          <div class="col-md-2 ">
                          <img id="FileImg" value="{{ (isset($post)?$post->agreement:'')}}" src="{{url('/uploads/profile/default.png')}}"  style="width: 71px;height: 71px">
                          </div>
                      </div>
                    </div>
                    {{-- <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Roles</label>
                      <select class="form-select roles" id="roles" multiple name="roles[]" >

                            @foreach($roles as $key=>$vals)
                              <option value="{{$vals->id}}">{{$vals->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}


                    <div class="form-control">
                        <label for="is_family" class="form-label"><b>Is Family ?</b></label>
                        <input type='checkbox' name='is_family' id='is_family' value='1' >
                    </div>
                    {{-- <div class="family" style="display:none">
                        <br><br>
                        <h4>Member Details</h4>
                        <div class="row">
                            <div class="col-md-12" style="padding: 15px;">
                                <div class="row">
                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="title">Full Name</label>
                                        <input   class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->full_name:''}}" id="full_name" name="full_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="member_contact_no">Contact No</label>
                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->contact_no:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="member_contact_no" name="member_contact_no"  placeholder="Enter Contact Number">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="member_address">Address</label>
                                        <textarea class="form-control" id="member_address" name="member_address" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->address:''}}" type="text" aria-describedby="" placeholder="Enter Society Address"></textarea>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_father_name">Father Name</label>
                                    <input class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->member_father_name:''}}" id="member_father_name" name="member_father_name" type="text" aria-describedby="" placeholder="Enter member_father_name">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_mother_name">Mother Name</label>
                                    <input class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->member_mother_name:''}}" id="member_mother_name" name="member_mother_name" type="text" aria-describedby="" placeholder="Enter member_mother_name">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_gender">Gender</label>
                                        <select class="form-select" id="member_gender" name="member_gender" >
                                            <option value="">Select</option>
                                            <option @if(isset($post)) @if($post->member_gender=='female') selected @endif  @endif value="1">FeMale</option>
                                            <option  @if(isset($post)) @if($post->member_gender=='male') selected @endif  @endif value="0">Male</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_dob">DOB</label>
                                    <input class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->member_dob:''}}" id="member_dob" name="member_dob" type="date" aria-describedby="" placeholder="Enter member_dob">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_date_of_marrige">Date of Marriage</label>
                                    <input class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->member_date_of_marrige:''}}" id="member_date_of_marrige" name="member_date_of_marrige" type="date" aria-describedby="" placeholder="Enter date_of_marrige">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                    <label class="col-form-label pt-0" for="member_occupation">Occupation</label>
                                    <input class="form-control" value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->member_occupation:''}}" id="member_occupation" name="member_occupation" type="text" aria-describedby="" placeholder="Enter Occupation">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="members_pan">Pan Card</label>
                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="members_pan" name="members_pan"  placeholder="Enter Pan Number">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="members_aadhar">Aadhar Number</label>
                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="member_aadhar" name="members_aadhar"  placeholder="Enter Aadhar Number">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="property_owned">Is Family</label>
                                        <select class="form-select " onchange="toggleFunctionality('is_kids','is_kids_data')" id="is_kids" name="is_kids" >
                                            <option value="">Select</option>
                                            <option @if(isset($post)) @if($post->is_kids==1) selected @endif  @endif value="1">Yes</option>
                                            <option @if(isset($post)) @if($post->is_kids==0) selected @endif  @endif value="0">No</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="family" style="display: none">
                        <h4>Family Details</h4>
                                @if(isset($post))
                                @if($post->family_details->count() > 0)
                                    <div class="card-body row">
                                        <div class="kids-data">
                                            <div class="row">
                                                @foreach($post->family_details as $key=>$vals)
                                                    <div class="col-md-10" style="padding: 15px;">
                                                        <div class="row">

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_name0">Name</label>
                                                                <input class="form-control" id="family_name0" value="{{$vals->family_name}}" name="family_name[]" type="text" aria-describedby="" placeholder="Enter Name">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_father_name0">Father Name</label>
                                                                <input class="form-control" id="family_father_name0" value="{{$vals->family_father_name}}" name="family_father_name[]" type="text" aria-describedby="" placeholder="Enter Father Name">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_mother_name0">Mother Name</label>
                                                                <input class="form-control" id="family_mother_name0" value="{{$vals->family_mother_name}}"  name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_gender0">Gender</label>
                                                                <select class="form-select " id="family_gender0" name="family_gender[]" >
                                                                    <option {{ ($vals->family_gender=='Male')?'selected':'' }} value="Male">Male</option>
                                                                    <option {{ ($vals->family_gender=='Female')?'selected':'' }} value="Female">Female</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_contact_no0">Contact No</label>
                                                                <input  value="{{$vals->family_contact_no}}" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no0" name="family_contact_no[]"  placeholder="Enter Contact Number">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_password0">Password</label>
                                                                <input  class="form-control"  type="password" id="family_password0" name="family_password[]"  placeholder="Enter Password">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_dob0">DOB</label>
                                                                <input value="{{$vals->family_dob}}"  class="form-control" type="date"  id="family_dob0" name="family_dob[]"  placeholder="Enter DOB">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_marriage0">Date of Marriage</label>
                                                                <input value="{{$vals->family_marriage}}" class="form-control" type="date"  id="family_marriage0" name="family_marriage[]"  placeholder="Enter Marraige">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_occupation0">Occupation</label>
                                                                <input value="{{$vals->family_occupation}}" class="form-control" id="family_occupation0"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_pan0">Pan Card</label>
                                                                <input class="form-control"  value="{{$vals->pan}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="family_aadhar0">Aadhar Card</label>
                                                                <input class="form-control"  value="{{$vals->aadhar}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="padding: 15px;">
                                                        <br />
                                                        <button class="btn mt-2 btn-danger " type="button" onclick="deleteFamilyData({{$vals->id}})"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-1" style="padding: 15px;">
                                                    <br />
                                                    <button class="btn mt-2 btn-primary "
                                                    type="button" onclick="addMorekids()"> <i
                                                    class="fa fa-plus"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            @else
                                <div class="card-body row">
                                    <div class="kids-data">
                                        <div class="row">
                                            <div class="col-md-11" style="padding: 15px;">
                                                <div class="row">

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_name0">Name</label>
                                                        <input class="form-control" id="family_name0" name="family_name[]" type="text" aria-describedby="" placeholder="Enter Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_father_name0">Father Name</label>
                                                        <input class="form-control" id="family_father_name0" name="family_father_name[]" type="text" aria-describedby="" placeholder="Enter Father Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_mother_name0">Mother Name</label>
                                                        <input class="form-control" id="family_mother_name0"   name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_gender0">Gender</label>
                                                        <select class="form-select " id="family_gender0" name="family_gender[]" >
                                                            <option value="Male">Male</option>
                                                            <option  value="Female">Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_contact_no0">Contact No</label>
                                                        <input  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no0" name="family_contact_no[]"  placeholder="Enter Contact Number">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_password0">Password</label>
                                                        <input  class="form-control"  type="password" id="family_password0" name="family_password[]"  placeholder="Enter Password">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_dob0">DOB</label>
                                                        <input  class="form-control" type="date"  id="family_dob0" name="family_dob[]"  placeholder="Enter DOB">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_marriage0">Date of Marriage</label>
                                                        <input class="form-control" type="date"  id="family_marriage0" name="family_marriage[]"  placeholder="Enter Marraige">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_occupation0">Occupation</label>
                                                        <input class="form-control" id="family_occupation0"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_pan0">Pan Card</label>
                                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_aadhar0">Aadhar Card</label>
                                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding: 15px;">
                                                <br />
                                                <button class="btn mt-2 btn-primary "
                                                type="button" onclick="addMorekids()"> <i
                                                class="fa fa-plus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @else
                                <div class="card-body row">
                                    <div class="kids-data">
                                        <div class="row">
                                            <div class="col-md-11" style="padding: 15px;">
                                                <div class="row">

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_name0">Name</label>
                                                        <input class="form-control" id="family_name0" name="family_name[]" type="text" aria-describedby="" placeholder="Enter Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_father_name0">Father Name</label>
                                                        <input class="form-control" id="family_father_name0" name="family_father_name[]" type="text" aria-describedby="" placeholder="Enter Father Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_mother_name0">Mother Name</label>
                                                        <input class="form-control" id="family_mother_name0"   name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_gender0">Gender</label>
                                                        <select class="form-select " id="family_gender0" name="family_gender[]" >
                                                            <option value="Male">Male</option>
                                                            <option  value="Female">Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_contact_no0">Contact No</label>
                                                        <input  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no0" name="family_contact_no[]"  placeholder="Enter Contact Number">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_password0">Password</label>
                                                        <input  class="form-control"  type="password" id="family_password0" name="family_password[]"  placeholder="Enter Password">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_dob0">DOB</label>
                                                        <input  class="form-control" type="date"  id="family_dob0" name="family_dob[]"  placeholder="Enter DOB">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_marriage0">Date of Marriage</label>
                                                        <input class="form-control" type="date"  id="family_marriage0" name="family_marriage[]"  placeholder="Enter Marraige">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_occupation0">Occupation</label>
                                                        <input class="form-control" id="family_occupation0"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_pan0">Pan Card</label>
                                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                    </div>

                                                    <div class="mb-3 text-align-left col-md-3">
                                                        <label class="col-form-label  text-align-left pt-0" for="family_aadhar0">Aadhar Card</label>
                                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding: 15px;">
                                                <br />
                                                <button class="btn mt-2 btn-primary "
                                                type="button" onclick="addMorekids()"> <i
                                                class="fa fa-plus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                    </div>


                     <div class="form-control">
                     <label for="is_vehicle" class="form-label"><b>Is Vehicle ?</b></label>
                     <input type='checkbox' name='is_vehicle' id='is_vehicle' value='1' >
                    </div>


                    <div class="vehicle" style="display:none">
                            @if(isset($post)?($post->parking_details):'')
                                @if($post->parking_details->count() > 0)
                                    <h4>Vehicle Detail</h4>
                                    <div class="card-body row">
                                        <div class="parking-data">
                                            <div class="row">
                                                @foreach($post->parking_details as $key=>$vals)
                                                    <div class="col-md-10" style="padding: 15px;">
                                                        <div class="row">

                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="flat_no0"> Flat No</label>
                                                                <input class="form-control" type="number"  value="{{$vals->flat_no}}"   id="vehicleflat_no" name="vehicleflat_no[]" placeholder="Enter Flat No">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="vehicle_type0">Vehicle Type</label>
                                                                {{-- <input class="form-control" value="{{$vals->vehicle_type}}" type="text"  id="vehicle_type" name="vehicle_type[]"  placeholder="Enter Vehicle Type"> --}}
                                                                <select class="form-select " id="vehicle_type0" name="vehicle_type[]" >
                                                                    <option @if(isset($post)) @if($post->vehicle_type=='2 Wheeler') selected @endif @endif value="2 Wheeler">2 Wheeler</option>
                                                                    <option @if(isset($post)) @if($post->vehicle_type=='4 Wheeler') selected @endif @endif value="4 Wheeler">4 Wheeler</option>
                                                                </select>
                                                            </div>


                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="rc_number0">RC No</label>
                                                                <input class="form-control" value="{{$vals->rc_number}}" type="text"  id="rc_number" name="rc_number[]"  placeholder="Enter RC Number">
                                                            </div>


                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="is_insured0">Is Insured</label>
                                                                <select class="form-select " id="is_insured" name="is_insured[]" >
                                                                    <option value="">Select</option>
                                                                    <option   @if($vals->is_insured=='Yes') selected @endif value="Yes">Yes</option>
                                                                    <option  @if($vals->is_insured=='No') selected @endif  value="No">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="vehicle_no0"> Vehicle No</label>
                                                                <input class="form-control" type="text"  value="{{$vals->vehicle_no}}"   id="vehicle_no" name="vehicle_no[]" placeholder="Enter Vehicle No">
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="parking_no0"> Parking No</label>
                                                                <input class="form-control" type="text"  value="{{$vals->parking_no}}"   id="parking_no" name="parking_no[]" placeholder="Enter Parking No">
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="padding: 15px;">
                                                        <br />
                                                        <button class="btn mt-2 btn-danger " type="button" onclick="deleteParkingData({{$vals->id}})"> <i class="fa fa-trash"></i> </button>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-1" style="padding: 15px;">
                                                <br/>
                                                    <button class="btn mt-2 btn-primary "
                                                    type="button" onclick="addParkingData()"> <i
                                                    class="fa fa-plus"></i> </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                <h4>Vehicle Detail</h4>

                            <div class="card-body row">
                                <div class="parking-data">

                                    <div class="row">
                                        <div class="col-md-11" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="flat_no0">Flat No</label>
                                                    <input class="form-control" id="vehicleflat_no0" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="vehicle_type0">Vehicle Type</label>
                                                    {{-- <input class="form-control" id="vehicle_type0" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type"> --}}
                                                    <select class="form-select " id="vehicle_type0" name="vehicle_type[]" >
                                                        <option @if(isset($post)) @if($post->vehicle_type=='2 Wheeler') selected @endif @endif value="2 Wheeler">2 Wheeler</option>
                                                        <option @if(isset($post)) @if($post->vehicle_type=='4 Wheeler') selected @endif @endif value="4 Wheeler">4 Wheeler</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="rc_number0">RC No</label>
                                                    <input class="form-control" id="rc_number0" value="{{ (isset($post)?$post->rc_number:'')}}" name="rc_number[]" type="text" aria-describedby="" placeholder="Enter Rc No">

                                                </div>


                                                <div class="mb-3 text-align-left col-md-4">
                                                <label class="col-form-label  text-align-left pt-0" for="is_insured0">Is Insured</label>
                                                <select class="form-select " id="is_insured0" name="is_insured[]" >
                                                    <option value="">Select</option>
                                                    <option  @if(isset($post)) @if($post->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                                    <option  @if(isset($post)) @if($post->is_insured=='No') selected @endif @endif  value="No">No</option>
                                                </select>
                                                </div>

                                                <div class="col-md-4 pt-3">
                                                    <label class="col-form-label  text-align-left pt-0" for="vehicle_no0"> Vehicle No</label>
                                                    <input class="form-control" type="text"  value="{{ (isset($post)?$post->vehicle_no:'')}}"   id="vehicle_no" name="vehicle_no[]" placeholder="Enter Vehicle No">
                                                </div>

                                                <div class="col-md-4 pt-3">
                                                    <label class="col-form-label  text-align-left pt-0" for="parking_no0"> Parking No</label>
                                                    <input class="form-control" type="text"  value="{{ (isset($post)?$post->parking_no:'')}}"   id="parking_no" name="parking_no[]" placeholder="Enter Parking No">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding: 15px;">
                                            <br />
                                            <button class="btn mt-2 btn-primary "
                                            type="button" onclick="addParkingData()"> <i
                                            class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                            @else
                            <h4>Vehicle Detail</h4>

                            <div class="card-body row">
                                <div class="parking-data">

                                    <div class="row">
                                        <div class="col-md-11" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="flat_no0">Flat No</label>
                                                    <input class="form-control" id="vehicleflat_no0" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="vehicle_type0">Vehicle Type</label>
                                                    {{-- <input class="form-control" id="vehicle_type0" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type"> --}}
                                                    <select class="form-select " id="vehicle_type0" name="vehicle_type[]" >
                                                        <option @if(isset($post)) @if($post->vehicle_type=='2 Wheeler') selected @endif @endif value="2 Wheeler">2 Wheeler</option>
                                                        <option @if(isset($post)) @if($post->vehicle_type=='4 Wheeler') selected @endif @endif value="4 Wheeler">4 Wheeler</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="col-form-label pt-0" for="rc_number0">RC No</label>
                                                    <input class="form-control" id="rc_number0" value="{{ (isset($post)?$post->rc_number:'')}}" name="rc_number[]" type="text" aria-describedby="" placeholder="Enter Rc No">

                                                </div>


                                                <div class="mb-3 text-align-left col-md-4">
                                                <label class="col-form-label  text-align-left pt-0" for="is_insured0">Is Insured</label>
                                                <select class="form-select " id="is_insured0" name="is_insured[]" >
                                                    <option  @if(isset($post)) @if($post->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                                    <option  @if(isset($post)) @if($post->is_insured=='No') selected @endif @endif  value="No">No</option>
                                                </select>
                                                </div>

                                                <div class="col-md-4 pt-3">
                                                    <label class="col-form-label  text-align-left pt-0" for="vehicle_no0"> Vehicle No</label>
                                                    <input class="form-control" type="text"  value="{{ (isset($post)?$post->vehicle_no:'')}}"   id="vehicle_no" name="vehicle_no[]" placeholder="Enter Vehicle No">
                                                </div>

                                                <div class="col-md-4 pt-3">
                                                    <label class="col-form-label  text-align-left pt-0" for="parking_no0"> Parking No</label>
                                                    <input class="form-control" type="text"  value="{{ (isset($post)?$post->parking_no:'')}}"   id="parking_no" name="parking_no[]" placeholder="Enter Parking No">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn mt-2 btn-primary "
                                            type="button" onclick="addParkingData()"> <i
                                            class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                    </div>
                </div>
                <div class="card-footer">
                  <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                </div>
              </div>
            </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>

@endsection

@section('pagejs')


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script type="text/javascript">
        $(function () {

          $('.roles').select2();


           $('#submitForm').submit(function(){
            var $this = $('#submitButton');
            buttonLoading('loading', $this);
            $('.is-invalid').removeClass('is-invalid state-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                url: $('#submitForm').attr('action'),
                type: "POST",
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: new FormData($('#submitForm')[0]),
                success: function(data) {
                    if(data.status){
                        var btn = '<a href="{{route('user-list')}}" class="btn btn-info btn-sm">GoTo List</a>';
                        successMsg('Create User', data.msg, btn);
                        $('#submitForm')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create User', 'Input Error');
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create User', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>



    <script>
    function getunit(){

       var floor_no = $("#floor_no option:selected").val();

       $.ajax({
            url: '{{route('getunit')}}',
            type: "GET",
            processData: true,  // Important!
            data: {floor_no:floor_no},
            success: function(data) {
                        $("#unit_no").empty();
                    $("#unit_no").append(" <option value=''> Select </option>  ");



                    if(data.data.length > 0){
                        $.each(data.data,function(key,value){
                                $("#unit_no").append(`<option value='${value.id}' >${value.unit_no} </option> `)
                        });
                    }

            }

        });


    }
</script>

<script>

 function toggleFunctionality(changeKey,hideKey){

        var changeVal = $("#"+changeKey+' option:selected').val();
            if(changeVal==1){
              $("#"+hideKey).show();
            }
            else{
              $("#"+hideKey).hide();
            }
      }



        $(document).on('click','#is_family',function(){
            var this_div=$(this);
            var is_check=this_div.prop('checked');
            if(is_check){
                // $('#min_quantity').attr('required','required');
                //  $('#min_price').attr('required','required');
                $('.family').show();
            }else{
                //  $('#min_quantity').removeAttr('required');
                //  $('#min_price').removeAttr('required');
                $('.family').hide();
            }

        });
</script>

<script>

function deleteParkingData(id){

     var con = confirm("Are You Sure Want to Delete This");

        if(con)
        {

            $.ajax({
                dataType:'json',
                url:"{{route('tenant_parking-delete')}}",
                type:'POST',
                data:{'_token':"{{csrf_token()}}",'parking_id':id},
                success:function(d){
                    if(d.status){
                        successMsg('Message', d.msg, '');
                        setTimeout(function(){
                                location.reload();
                            },1000);
                    }else{
                        errorMsg('Message', d.msg, '');
                    }
                }
            });
        }
}

function deleteFamilyData(id){

     var con = confirm("Are You Sure Want to Delete This");

        if(con)
        {

            $.ajax({
                dataType:'json',
                url:"{{route('tenant_family-delete')}}",
                type:'POST',
                data:{'_token':"{{csrf_token()}}",'family_id':id},
                success:function(d){
                    if(d.status){
                        successMsg('Message', d.msg, '');
                        setTimeout(function(){
                                location.reload();
                            },1000);
                    }else{
                        errorMsg('Message', d.msg, '');
                    }
                }
            });
        }
}
</script>


    <script>
            $(document).on('click','#is_vehicle',function(){
                var this_div=$(this);
                var is_check=this_div.prop('checked');
                if(is_check){
                    // $('#min_quantity').attr('required','required');
                    //  $('#min_price').attr('required','required');
                    $('.vehicle').show();
                }else{
                    //  $('#min_quantity').removeAttr('required');
                    //  $('#min_price').removeAttr('required');
                    $('.vehicle').hide();
                }

            });
    </script>


<script type="text/javascript">
        var counter = 1;

        function addParkingData() {

            $(".parking-data").append(`

            <div class="row parkingrow${counter}">
                <div class="col-md-11" style="padding: 15px;">
                    <div class="row">

                      <div class="col-md-4">
                            <label class="col-form-label pt-0" for="vehicleflat_no${counter}">Flat No</label>
                            <input class="form-control" id="name${counter}" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                        </div>

                        <div class="col-md-4 pt-3">
                            <label class="col-form-label pt-0" for="vehicle_type${counter}">Vehicle Type</label>
                            {{-- <input class="form-control" id="vehicle_type${counter}" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type"> --}}
                            <select class="form-select " id="vehicle_type${counter}" name="vehicle_type[]" >
                                <option value="2 Wheeler">2 Wheeler</option>
                                <option  value="4 Wheeler">4 Wheeler</option>
                            </select>
                        </div>


                        <div class="col-md-4 pt-3">
                            <label class="col-form-label pt-0" for="rc_number${counter}">RC No</label>
                            <input class="form-control" id="rc_number${counter}" value="{{ (isset($post)?$post->rc_number:'')}}" name="rc_number[]" type="text" aria-describedby="" placeholder="Enter RC No">
                        </div>

                        <div class="col-md-4 pt-3">
                            <label class="col-form-label  text-align-left pt-0" for="is_insured${counter}"> Is Insured</label>
                           <select class="form-select " id="is_insured${counter}" name="is_insured[]" >
                                <option  @if (isset($post)) @if($post->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                <option @if (isset($post))  @if($post->is_insured=='No') selected @endif @endif value="No">No</option>
                            </select>
                        </div>

                        <div class="col-md-4 pt-3">
                            <label class="col-form-label  text-align-left pt-0" for="vehicle_no${counter}"> Vehicle No</label>
                            <input class="form-control" type="text"  value="{{ (isset($post)?$post->vehicle_no:'')}}"   id="vehicle_no${counter}" name="vehicle_no[]" placeholder="Enter Vehicle No">
                        </div>

                        <div class="col-md-4 pt-3">
                            <label class="col-form-label  text-align-left pt-0" for="parking_no${counter}"> Parking No</label>
                            <input class="form-control" type="text"  value="{{ (isset($post)?$post->parking_no:'')}}"   id="parking_no${counter}" name="parking_no[]" placeholder="Enter Parking No">
                        </div>



                    </div>
                </div>

                <div class="col-md-1" style="padding: 15px;">
                    <br />
                    <button class="btn mt-2 btn-danger " type="button" onclick="removeParkingData(${counter})"> <i class="fa fa-trash"></i> </button>
                </div>

            </div>

            `);

            $(".tagsmulti" + counter).select2();

            counter++;

        }

        function removeParkingData(counter) {

            $(".parking-data .parkingrow" + counter).remove();
        }
    </script>

<script type="text/javascript">
        var counter = 1;

        function addMorekids() {

            $(".kids-data").append(`

            <div class="row copiesrow${counter}">
                <div class="col-md-11" style="padding: 15px;">
                    <div class="row">

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_name${counter}">Name</label>
                            <input class="form-control" id="family_name${counter}" name="family_name[]" type="text" aria-describedby="" placeholder="Enter Name">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_father_name${counter}">Father Name</label>
                            <input class="form-control" id="family_father_name${counter}" name="family_father_name[]" type="text" aria-describedby="" placeholder="Enter Father Name">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_mother_name${counter}">Mother Name</label>
                            <input class="form-control" id="family_mother_name${counter}"   name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_gender${counter}">Gender</label>
                            <select class="form-select " id="family_gender${counter}" name="family_gender[]" >
                                <option value="Male">Male</option>
                                <option  value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_contact_no${counter}">Contact No</label>
                            <input  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no${counter}" name="family_contact_no[]"  placeholder="Enter Contact Number">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_password${counter}">Password</label>
                            <input  class="form-control"  type="password" id="family_password${counter}" name="family_password[]"  placeholder="Enter Password">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_dob${counter}">DOB</label>
                            <input  class="form-control" type="date"  id="family_dob${counter}" name="family_dob[]"  placeholder="Enter DOB">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_dob${counter}">Date of Marriage</label>
                            <input class="form-control" type="date"  id="family_marriage${counter}" name="family_marriage[]"  placeholder="Enter Marraige">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_occupation${counter}">Occupation</label>
                            <input class="form-control" id="family_occupation${counter}"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_pan${counter}">Pan Card</label>
                            <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->family_pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_pan${counter}" name="family_pan[]"  placeholder="Enter Pan Number">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="family_aadhar${counter}">Aadhar Card</label>
                            <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_aadhar${counter}" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
                        </div>

                    </div>
                </div>

                <div class="col-md-1" style="padding: 15px;">
                    <br />
                    <button class="btn mt-2 btn-danger " type="button" onclick="removekids(${counter})"> <i class="fa fa-trash"></i> </button>
                </div>

            </div>

            `);

            $(".tagsmulti" + counter).select2();

            counter++;

        }

        function removekids(counter) {

            $(".kids-data .copiesrow" + counter).remove();
        }
    </script>
@stop

