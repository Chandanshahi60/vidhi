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
                    <h4>Owner Detail</h4>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="owner_name">Owner Name</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->owner_name:'')}}" name="owner_name" type="text" aria-describedby="" placeholder="Enter Owner Name">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="email">Email</label>
                      <input class="form-control" id="email" value="{{ (isset($post)?$post->email:'')}}" name="email" type="text" aria-describedby="" placeholder="Enter Email">
                    </div>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="contact_no">Contact No (With Country Code)</label>
                      <input class="form-control" value="{{ (isset($post)?$post->contact_no:'')}}" id="contact_no" name="contact_no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"type="number" aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="password">Password</label>
                      <input class="form-control" value="{{ (isset($post)?$post->password:'')}}" id="password" name="password" type="password" aria-describedby="" placeholder="Enter password">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="present_address">Present Address</label>
                      <input class="form-control" value="{{ (isset($post)?$post->present_address:'')}}" id="present_address" name="present_address" type="text" aria-describedby="" placeholder="Enter Present Address">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="permanent_address">Permanent Address</label>
                      <input class="form-control" value="{{ (isset($post)?$post->permanent_address:'')}}" id="permanent_address" name="permanent_address" type="text" aria-describedby="" placeholder="Enter Permanent Address">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="aadhar">Aadhar Card</label>
                      <input class="form-control" value="{{ (isset($post)?$post->aadhar:'')}}" id="aadhar" name="aadhar" type="number" aria-describedby="" placeholder="Enter Aadhar Card">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="pan">Pan Card</label>
                      <input class="form-control" value="{{ (isset($post)?$post->pan:'')}}" id="pan" name="pan" type="text" aria-describedby="" placeholder="Enter Pan Card">
                    </div>

                    {{-- <div class="mb-3">
                      <label class="col-form-label pt-0" for="owner_unit">Owner Unit</label>
                      <input class="form-control" value="{{ (isset($post)?$post->owner_unit:'')}}" id="owner_unit" name="owner_unit" type="text" aria-describedby="" placeholder="Enter Owner Unit">
                    </div> --}}

                    <div class="row">
                    <label class="col-form-label pt-0" for="owner_unit0">Owner Unit</label>
                        @foreach ($owner_unit as $item)
                            <div class="mb-12 col-md-3" >
                                <label class="form-label" style="font-weight:800;font-size:12px" for="owner_unit{{$item->id}}">
                                <input type="checkbox" @if(isset($post))  @if(in_array($item->id,explode(',',$post->owner_unit))) checked @endif @endif value="{{$item->id}}" name="owner_unit[]" id="owner_unit{{$item->id}}" style="margin-right:8px">{{$item->floor->title}} {{$item->unit_no}}</label>
                            </div>
                        @endforeach
                    </div>

{{--
                    <div class="mb-3">
                       <label class="col-form-label pt-0" for="floor_no">Floor No</label>
                        <select class="js-example-basic-single form-control" multiple data-live-search="true" onchange="getunit()"  id="floor_no[]" name="floor_no[]" >
                              @foreach ($floor as $item)
                              <option @if(isset($post))  @if($post->floor_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->title}}</option>
                              @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                       <label class="col-form-label pt-0" for="unit_no">Unit No</label>
                        <select class="js-example-basic-single form-control" multiple data-live-search="true" id="unit_no[]" name="unit_no[]" >
                              @foreach ($unit as $item)
                              <option @if(isset($post))  @if($post->unit_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->unit_no}}</option>
                              @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-3">
                      <label  class="col-form-label pt-0"> Owner Photo </label>

                      <div class="row">
                          <div class="col-md-10 ">
                              <input id="image" type="file" class="form-control align-middle custom-file-input" name="owner_photo" onchange="readURL(this, 'FileImg');">

                            </div>
                          <div class="col-md-2 ">
                          <img id="FileImg" value="{{ (isset($post)?$post->owner_photo:'')}}" @if(isset($post))  @if($post->owner_photo)  src="{{asset($post->owner_photo)}}" @endif @else src="{{url('/uploads/profile/default.png')}}" @endif  style="width: 71px;height: 71px">
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

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Status</label>
                      <select class="form-select" id="status" name="status" >
                          <option value="">Select</option>
                          <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                          <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Inactive</option>
                        </select>
                    </div>


                    <div class="form-control">
                        <label for="is_family" class="form-label"><b>Is Member ?</b></label>
                        <input type='checkbox' name='is_family' id='is_family' value='1' >
                    </div>
                    <div class="family" style="display:none">
                    <br><br>
                        <h4>Member Details</h4>
                        <div class="row">
                            <div class="col-md-12" style="padding: 15px;">
                                <div class="row">
                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="title">Full Name</label>
                                        <input   class="form-control"  value="{{isset ($post->society_members_details)?$post->society_members_details->full_name:''}}"  id="full_name" name="full_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                        <input class="form-control" type="number"  value="{{isset ($post->society_members_details)?$post->society_members_details->flat_no:''}}"    id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="member_contact_no">Contact No</label>
                                        <input class="form-control"  value="{{isset($post->society_members_details)?$post->society_members_details->contact_no:''}}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="member_contact_no" name="member_contact_no"  placeholder="Enter Contact Number">
                                    </div>


                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="property_type">Type of Property</label>
                                        <input class="form-control" value="{{isset($post->society_members_details)?$post->society_members_details->property_type:''}}" type="text"  id="property_type" name="property_type"  placeholder="Enter Type of Property">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_father_name">Father Name</label>
                                        <input class="form-control" value="{{isset($post->society_members_details)?$post->society_members_details->member_father_name:''}}" id="member_father_name" name="member_father_name" type="text" aria-describedby="" placeholder="Enter member_father_name">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_mother_name">Mother Name</label>
                                        <input class="form-control" value="{{isset($post->society_members_details)?$post->society_members_details->member_mother_name:''}}" id="member_mother_name" name="member_mother_name" type="text" aria-describedby="" placeholder="Enter member_mother_name">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_gender">Gender</label>
                                        {{-- <input class="form-control" value="{{ (isset($post)?$post->member_gender:'')}}" id="member_gender" name="member_gender" type="text" aria-describedby="" placeholder="Enter member_gender"> --}}

                                        <select class="form-select" id="member_gender" name="member_gender" >
                                            <option value="">Select</option>
                                            <option @if(isset($post)) @if($post->member_gender=='female') selected @endif  @endif value="female">FeMale</option>
                                            <option  @if(isset($post)) @if($post->member_gender=='male') selected @endif  @endif value="male">Male</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_dob">DOB</label>
                                        <input class="form-control" value="{{ (isset($post)?$post->member_dob:'')}}" id="member_dob" name="member_dob" type="date" aria-describedby="" placeholder="Enter member_dob">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_date_of_marrige">Date of Marriage</label>
                                        <input class="form-control" value="{{ (isset($post)?$post->member_date_of_marrige:'')}}" id="member_date_of_marrige" name="member_date_of_marrige" type="date" aria-describedby="" placeholder="Enter date_of_marrige">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="member_pan">Pan Card</label>
                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="member_pan" name="member_pan"  placeholder="Enter Pan Number">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="aadhar">Aadhar Card</label>
                                        <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="member_aadhar" name="member_aadhar"  placeholder="Enter Aadhar Number">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="col-form-label pt-0" for="member_occupation">Occupation</label>
                                        <input class="form-control" value="{{ (isset($post)?$post->member_occupation:'')}}" id="member_occupation" name="member_occupation" type="text" aria-describedby="" placeholder="Enter Occupation">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="property_owned">Property Owned</label>
                                        <select class="form-select " id="property_owned" name="property_owned" >
                                            <option  @if(isset($post)?($post->society_members_details):'') @if($post->society_members_details->property_owned==1) @endif  @endif value="1">Yes</option>
                                            <option  @if(isset($post)?($post->society_members_details):'') @if($post->society_members_details->property_owned==0) @endif  @endif value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 text-align-left col-md-3">
                                        <label class="col-form-label  text-align-left pt-0" for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Society Address">{{isset($post->society_members_details)?$post->society_members_details->address:''}}</textarea>
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
                    <div id="is_kids_data" style="display: none">
                        <h4>Family Details</h4>
                        @if(isset($post)?($post->society_members_details):'')
                            @if($post->society_members_details->family_details->count() > 0)
                                    <div class="card-body row">
                                        <div class="kids-data">
                                            <div class="row">
                                                @foreach($post->society_members_details->family_details as $key=>$vals)
                                                    <div class="col-md-11" style="padding: 15px;">
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
                                                                <label class="col-form-label  text-align-left pt-0" for="pan0">Pan Card</label>
                                                                <input class="form-control"  value="{{ isset($post->society_members_details)?$post->society_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                                <label class="col-form-label  text-align-left pt-0" for="aadhar0">Aadhar Card</label>
                                                                <input class="form-control"  value="{{ isset($post->society_members_details)?$post->society_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
                                                            </div>
                                                        </div>
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
                                                            <label class="col-form-label  text-align-left pt-0" for="pan0">Pan Card</label>
                                                            <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                            <label class="col-form-label  text-align-left pt-0" for="aadhar0">Aadhar Card</label>
                                                            <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_member_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
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
                                                    <label class="col-form-label  text-align-left pt-0" for="pan0">Pan Card</label>
                                                    <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="family_pan0" name="family_pan[]"  placeholder="Enter Pan Number">
                                                </div>

                                                <div class="mb-3 text-align-left col-md-3">
                                                    <label class="col-form-label  text-align-left pt-0" for="aadhar0">Aadhar Card</label>
                                                    <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="family_member_aadhar0" name="family_aadhar[]"  placeholder="Enter Aadhar Number">
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
                     <label for="is_committe" class="form-label"><b>Is Committe ?</b></label>
                     <input type='checkbox' name='is_committe' id='is_committe' value='1' >
                    </div>

                    <div class="committe" style="display:none">
                        <br><br><br>
                        <h6><u>Committee Detail</u></h6>
                        <div class="mb-3">
                            <label class="col-form-label  text-align-left pt-0" for="title">Committe Name</label>
                            <input class="form-control" value="{{ (isset($post->committe_details)?$post->committe_details->name:'')}}" id="committe_name" name="committe_name" type="text" aria-describedby="" placeholder="Enter Committe Name">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label  text-align-left pt-0" for="mobile"> Designation</label>
                            <select class="form-select" id="designation" name="designation" >
                                @foreach ($management_member as $key=>$val)
                                <option @if(isset($post)) @if($post->committe_details->designation==$val->member_type) selected @endif  @endif value="{{ (isset($post->committe_details)?$post->committe_details->designation:'')}}">{{$val->member_type}}</option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" value="{{ (isset($post->committe_details)?$post->committe_details->designation:'')}}"  type="text"  id="designation" name="designation" placeholder="Enter Designation"> --}}
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label  text-align-left pt-0" for="committee_contact_no">Contact No</label>
                            <input class="form-control" value="{{ (isset($post->committe_details)?$post->committe_details->phone:'')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="committee_contact_no" name="committee_contact_no"  placeholder="Enter Contact Number">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label  text-align-left pt-0" for="mobile">Joining date</label>
                            <input class="form-control" value="{{ (isset($post->committe_details)?$post->committe_details->joining_date:'')}}" type="date"  id="joining_date" name="joining_date"  placeholder="Enter From Date">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label  text-align-left pt-0" for="mobile">Ending date</label>
                            <input class="form-control"  value="{{ (isset($post->committe_details)?$post->committe_details->ending_date:'')}}"  type="date"  id="ending_date" name="ending_date"  placeholder="Enter Till date">
                        </div>

                        <div class="mb-3">
                            <label  class="col-form-label pt-0"> Committee Photo </label>

                            <div class="row">
                                <div class="col-md-10 ">
                                    <input id="committee_photo" type="file" class="form-control align-middle custom-file-input" name="committee_photo" onchange="readURL(this, 'FileImg');">
                                    </div>
                                <div class="col-md-2 ">
                                {{-- <img id="FileImg" value="{{ (isset($post)?$post->photo:'')}}" src="{{url('/uploads/profile/default.png')}}"  style="width: 71px;height: 71px"> --}}
                                <img id="FileImg" value="{{ (isset($post)?$post->photo:'')}}" @if(isset($post))  @if($post->photo)  src="{{asset($post->photo)}}" @else src="{{url('/uploads/profile/default.png')}}" @endif @endif  style="width: 71px;height: 71px">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-control">
                     <label for="is_nominee" class="form-label"><b>Is Nominee ?</b></label>
                     <input type='checkbox' name='is_nominee' id='is_nominee' value='1' >
                    </div>

                    <div class="nominie" style="display:none">
                            @if(isset($post)?($post->nominee_details):'')
                                @if($post->nominee_details->count() > 0)
                                    <h4>Nomination Detail</h4>
                                    @foreach($post->nominee_details as $key=>$vals)
                                        <div class="card-body row">
                                            <div class="copies-data">

                                                <div class="row">
                                                    <div class="col-md-11" style="padding: 15px;">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <label class="col-form-label pt-0" for="nominator_name0">Nominating Person Name</label>
                                                                <input class="form-control" id="name0" value="{{$vals->nominator_name}}" name="nominator_name[]" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label class="col-form-label pt-0" for="nominated_name0">Nominated Person Name</label>
                                                                <input class="form-control" id="name0" value="{{$vals->nominated_name}}" name="nominated_name[]" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                                                            </div>

                                                            <div class="col-md-5 pt-3">
                                                                <label class="col-form-label pt-0" for="percentage0">Percentage</label>
                                                                <input class="form-control" id="name0" value="{{ $vals->percentage}}" name="percentage[]" type="text" aria-describedby="" placeholder="Enter Percentage">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1" style="padding: 15px;">
                                                        <br />
                                                        <button class="btn mt-2 btn-primary "
                                                        type="button" onclick="addMoreData()"> <i
                                                        class="fa fa-plus"></i> </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @else
                            <h4>Nomination Detail</h4>

                            <div class="card-body row">
                                <div class="copies-data">

                                    <div class="row">
                                        <div class="col-md-11" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="nominator_name0">Nominating Person Name</label>
                                                    <input class="form-control" id="name0" value="{{ (isset($post)?$post->nominator_name:'')}}" name="nominator_name[]" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                                                </div>

                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="nominated_name0">Nominated Person Name</label>
                                                    <input class="form-control" id="name0" value="{{ (isset($post)?$post->nominated_name:'')}}" name="nominated_name[]" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                                                </div>

                                                <div class="col-md-5 pt-3">
                                                    <label class="col-form-label pt-0" for="percentage0">Percentage</label>
                                                    <input class="form-control" id="name0" value="{{ (isset($post)?$post->percentage:'')}}" name="percentage[]" type="text" aria-describedby="" placeholder="Enter Percentage">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="padding: 15px;">
                                            <br />
                                            <button class="btn mt-2 btn-primary "
                                            type="button" onclick="addMoreData()"> <i
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
                                     @foreach($post->parking_details as $key=>$vals)
                                        <div class="card-body row">
                                            <div class="parking-data">

                                                <div class="row">
                                                    <div class="col-md-11" style="padding: 15px;">
                                                        <div class="row">

                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="flat_no0"> Flat No</label>
                                                                <input class="form-control" type="number"  value="{{$vals->flat_no}}"   id="vehicleflat_no" name="vehicleflat_no[]" placeholder="Enter Flat No">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="vehicle_type0">Vehicle Type</label>
                                                                <input class="form-control" value="{{$vals->vehicle_type}}" type="text"  id="vehicle_type" name="vehicle_type[]"  placeholder="Enter Vehicle Type">
                                                            </div>


                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="rc_number0">RC No</label>
                                                                <input class="form-control" value="{{$vals->rc_number}}" type="text"  id="rc_number" name="rc_number[]"  placeholder="Enter RC Number">
                                                            </div>


                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="is_insured0">Is Insured</label>
                                                                <select class="form-select " id="is_insured" name="is_insured[]" >
                                                                    <option   @if($vals->is_insured=='Yes') selected @endif value="Yes">Yes</option>
                                                                    <option  @if($vals->is_insured=='No') selected @endif  value="No">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-4">
                                                                <label class="col-form-label  text-align-left pt-0" for="parking_no0">Parking No</label>
                                                                <input class="form-control" value="{{$vals->parking_no}}" type="text"  id="parking_no" name="parking_no[]"  placeholder="Enter Parking No">
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
                                    @endforeach
                                @else
                                <h4>Vehicle Detail</h4>

                            <div class="card-body row">
                                <div class="parking-data">

                                    <div class="row">
                                        <div class="col-md-11" style="padding: 15px;">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="flat_no0">Flat No</label>
                                                    <input class="form-control" id="vehicleflat_no0" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                                                </div>

                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="vehicle_type0">Vehicle Type</label>
                                                    <input class="form-control" id="vehicle_type0" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type">

                                                </div>


                                                <div class="col-md-5">
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

                                                <div class="mb-3 text-align-left col-md-4">
                                                <label class="col-form-label  text-align-left pt-0" for="parking_no0">Parking No</label>
                                                <input class="form-control" value="{{isset($post)?$post->parking_no:''}}" type="text"  id="parking_no0" name="parking_no[]"  placeholder="Enter Parking No">
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
                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="flat_no0">Flat No</label>
                                                    <input class="form-control" id="vehicleflat_no0" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                                                </div>

                                                <div class="col-md-5">
                                                    <label class="col-form-label pt-0" for="vehicle_type0">Vehicle Type</label>
                                                    <input class="form-control" id="vehicle_type0" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type">

                                                </div>


                                                <div class="col-md-5">
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

                                                <div class="mb-3 text-align-left col-md-4">
                                                <label class="col-form-label  text-align-left pt-0" for="parking_no0">Parking No</label>
                                                <input class="form-control" value="{{isset($post)?$post->parking_no:''}}" type="text"  id="parking_no0" name="parking_no[]"  placeholder="Enter Parking No">
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



         var cloneCount = 1;

      function addMore(){


          var clone = $('#klon').clone();


              clone.find(".col-md-2").html();
              //clone.find(".col-md-2").html("")
              clone.find(".col-md-2").html(`<a type="button"  onclick="removeMore(${cloneCount})" class="mt-4">remove   <i class="fa fa-minus"></i> </a>`)
              // console.log(clone.find(".col-md-2").html(`<a  type="button" onclick="removeMore(${cloneCount})" class=" mt-4">remove   <i class="fa fa-minus"></i> </a>`));
              clone.attr('id', 'klon'+ cloneCount++).insertAfter('[id^=klon]:last');
      }

      function removeMore(id){

        $("#klon"+id).remove();

      }
      </script>

    <script type="text/javascript">
        var counter = 1;

        function addMoreData() {

            $(".copies-data").append(`

            <div class="row copiesrow${counter}">
                <div class="col-md-11" style="padding: 15px;">
                    <div class="row">

                        <div class="col-md-5">
                            <label class="col-form-label pt-0" for="nominator_name${counter}">Nominating Person Name</label>
                            <input class="form-control" id="name${counter}" value="{{ (isset($post)?$post->nominator_name:'')}}" name="nominator_name[]" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                        </div>

                        <div class="col-md-5">
                            <label class="col-form-label pt-0" for="nominated_name${counter}">Nominated Person Name</label>
                            <input class="form-control" id="name${counter}" value="{{ (isset($post)?$post->nominated_name:'')}}" name="nominated_name[]" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                        </div>


                        <div class="col-md-5 pt-3">
                            <label class="col-form-label pt-0" for="percentage${counter}">Percentage</label>
                            <input class="form-control" id="name${counter}" value="{{ (isset($post)?$post->percentage:'')}}" name="percentage[]" type="text" aria-describedby="" placeholder="Enter Percentage">
                        </div>

                        {{-- <div class="col-md-5 pt-3">
                            <label class="form-label" for="owner_unit${counter}">Owner Unit</label>
                            <select class="form-select" id="owner_unit${counter}" name="owner_unit[]" >
                                @foreach ($owner_unit as $item)
                                <option value="{{ $item->id }}">{{ $item->unit_no }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>

                <div class="col-md-1" style="padding: 15px;">
                    <br />
                    <button class="btn mt-2 btn-danger " type="button" onclick="removeData(${counter})"> <i class="fa fa-trash"></i> </button>
                </div>

            </div>

            `);

            $(".tagsmulti" + counter).select2();

            counter++;

        }

        function removeData(counter) {

            $(".copies-data .copiesrow" + counter).remove();
        }
    </script>


    <script type="text/javascript">
        var counter = 1;

        function addParkingData() {

            $(".parking-data").append(`

            <div class="row parkingrow${counter}">
                <div class="col-md-11" style="padding: 15px;">
                    <div class="row">

                      <div class="col-md-5">
                            <label class="col-form-label pt-0" for="vehicleflat_no${counter}">Flat No</label>
                            <input class="form-control" id="name${counter}" value="{{ (isset($post)?$post->flat_no:'')}}" name="vehicleflat_no[]" type="text" aria-describedby="" placeholder="Enter Flat No">
                        </div>

                        <div class="col-md-5 pt-3">
                            <label class="col-form-label pt-0" for="vehicle_type${counter}">Vehicle Type</label>
                            {{-- <input class="form-control" id="vehicle_type${counter}" value="{{ (isset($post)?$post->vehicle_type:'')}}" name="vehicle_type[]" type="text" aria-describedby="" placeholder="Enter Vehicle Type"> --}}
                            <select class="form-select " id="vehicle_type${counter}" name="vehicle_type[]" >
                                <option value="2 Wheeler">2 Wheeler</option>
                                <option  value="4 Wheeler">4 Wheeler</option>
                            </select>
                        </div>


                        <div class="col-md-5 pt-3">
                            <label class="col-form-label pt-0" for="rc_number${counter}">RC No</label>
                            <input class="form-control" id="rc_number${counter}" value="{{ (isset($post)?$post->rc_number:'')}}" name="rc_number[]" type="text" aria-describedby="" placeholder="Enter RC No">
                        </div>

                        <div class="col-md-5 pt-3">
                            <label class="col-form-label  text-align-left pt-0" for="is_insured${counter}"> Is Insured</label>
                           <select class="form-select " id="is_insured${counter}" name="is_insured[]" >
                                <option  @if (isset($post)) @if($post->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                <option @if (isset($post))  @if($post->is_insured=='No') selected @endif @endif value="No">No</option>
                            </select>
                        </div>

                         <div class="col-md-5 pt-3">
                            <label class="col-form-label  text-align-left pt-0" for="parking_no${counter}"> Parking No</label>
                            <input class="form-control" type="number"  value="{{ (isset($post)?$post->parking_no:'')}}"   id="parking_no${counter}" name="parking_no[]" placeholder="Enter Parking No">
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
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    </script>

    <script type="text/javascript">

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
            $(document).on('click','#is_nominee',function(){
                var this_div=$(this);
                var is_check=this_div.prop('checked');
                if(is_check){
                   // $('#min_quantity').attr('required','required');
                  //  $('#min_price').attr('required','required');
                    $('.nominie').show();
                }else{
                  //  $('#min_quantity').removeAttr('required');
                  //  $('#min_price').removeAttr('required');
                    $('.nominie').hide();
                }

            });
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

     <script>
            $(document).on('click','#is_committe',function(){
                var this_div=$(this);
                var is_check=this_div.prop('checked');
                if(is_check){
                   // $('#min_quantity').attr('required','required');
                  //  $('#min_price').attr('required','required');
                    $('.committe').show();
                }else{
                  //  $('#min_quantity').removeAttr('required');
                  //  $('#min_price').removeAttr('required');
                    $('.committe').hide();
                }

            });
    </script>

     <script>
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
                            <label class="col-form-label  text-align-left pt-0" for="pan${counter}">Pan Card</label>
                            <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->pan:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" maxlength="14" id="pan${counter}" name="pan[]"  placeholder="Enter Pan Number">
                        </div>

                        <div class="mb-3 text-align-left col-md-3">
                            <label class="col-form-label  text-align-left pt-0" for="aadhar${counter}">Aadhar Card</label>
                            <input class="form-control"  value="{{ isset($post->tenent_members_details)?$post->tenent_members_details->aadhar:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="14" id="member_aadhar${counter}" name="aadhar[]"  placeholder="Enter Aadhar Number">
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
