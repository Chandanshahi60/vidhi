@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
  .activeclass{
    background-color: rgba(36, 105, 92, 0.1);
    text-decoration: none;
  }
  label{
    text-align: left!important;
  }
  .text-align-left{
    text-align: left!important;
  }
  .row-padding{
    border: 1px solid green;
    padding: 10px;
  }
</style>
@stop

@section('breadcrum')

@stop

@section('content')


   <div class="page-body">
    {{-- <div class="container-fluid">
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
                <div class="card-body row">

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="title">Society Name</label>
                      <input class="form-control" id="society_name" name="society_name" type="text" aria-describedby="" placeholder="Enter Society Name">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="title">State</label>
                        <select class="form-select select2" id="state" name="state" onchange="getCities()">
                            <option value="">Select State</option>
                            @foreach(states(101) as $key=>$vals)
                              <option value="{{$vals->id}}">{{$vals->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="title">City</label>
                        <select class="form-select select2" id="city" name="city" >
                          <option value="">Select City</option>
                        </select>
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="email">Society Address</label>
                      <textarea class="form-control" id="society_address" name="society_address" type="text" aria-describedby="" placeholder="Enter Society Address"></textarea>
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="email">Email</label>
                      <input class="form-control" id="email" name="email" type="text" aria-describedby="" placeholder="Enter Email">
                    </div>


                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Pincode</label>
                      <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" id="pincode" name="pincode"  placeholder="Enter Pincode Number">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile"> Society Unique ID</label>
                      <input class="form-control" type="text"  id="society_unique_id" name="society_unique_id" placeholder="Enter Society Unique ID">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Total Flats</label>
                      <input class="form-control" type="number"  id="total_flats" name="total_flats" placeholder="Enter Total Flats">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Emergency Contact No</label>
                      <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="emergency_contact_no" name="emergency_contact_no"  placeholder="Enter Contact Number">
                    </div>


                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">RWA Registration No</label>
                      <input class="form-control" type="text"  id="rwa_registration" name="rwa_registration"  placeholder="Enter Registration Number">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Registration date</label>
                      <input class="form-control" type="date"  id="registration_date" name="registration_date"  placeholder="Enter Registration Date">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Last Election date</label>
                      <input class="form-control" type="date"  id="last_election_held" name="last_election_held"  placeholder="Enter Last Election Date">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Last Election date</label>
                      <input class="form-control" type="date"  id="election_due_date" name="election_due_date"  placeholder="Enter Election Due Date">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">Last Audit</label>
                      <input class="form-control" type="date"  id="last_audit" name="last_audit"  placeholder="Enter Last Audit">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">No of Families</label>
                      <input class="form-control" type="number"  id="no_of_families" name="no_of_families"  placeholder="Enter No Of Families">
                    </div>

                    <div class="mb-3 text-align-left col-md-4">
                      <label class="col-form-label  text-align-left pt-0" for="mobile">No Of Gates</label>
                      <input class="form-control" type="number"  id="no_of_gates" name="no_of_gates"  placeholder="Enter No Of Families">
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
    <!-- Container-fluid Ends--> --}}


    <div class="container-fluid">
      <div class="email-wrap bookmark-wrap">
        <div class="row">

          <div class="col-xl-3 box-col-4 xl-30">
            <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">bookmark filter</a>
              <div class="email-left-aside">
                <div class="card">
                  <div class="card-body">
                    <div class="email-app-sidebar left-bookmark">
                      <div class="media">
                        <div class="media-size-email"><img class="me-3 rounded-circle" src="../assets/images/user/user.png" alt=""></div>
                        <div class="media-body">
                          <h6 class="f-w-600">{{$post->society_name}}</h6>
                          <p>{{$post->email}}</p>
                        </div>
                      </div>
                      <ul class="nav main-menu" role="tablist">

                        <br /><br />
                        <li class="mt-4"><a id="pills-created-tab" data-bs-toggle="pill" href="#pills-created" role="tab" aria-controls="pills-created" aria-selected="false">
                          <span class="title">

                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle me-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> --}}

                            <i class="fa fa-home"></i>
                              Basic

                          </span></a>
                        </li>

                        {{-- <li>
                          <a class="show " id="pills-todaytask-tab" data-bs-toggle="pill" href="#pills-todaytask" role="tab" aria-controls="pills-todaytask" aria-selected="false">
                            <span class="title">
                              <i class="fa fa-users feather feather-check-circle me-2"></i>
                              Committe
                            </span>
                          </a>
                        </li> --}}

                        <li>
                          <a class="show" id="pills-delayed-tab" data-bs-toggle="pill" href="#pills-delayed" role="tab" aria-controls="pills-delayed" aria-selected="false">

                            <span class="title">
                              <i class="fa fa-users feather feather-check-circle me-2"></i>
                              Members </span>
                          </a>
                        </li>

                        <li>
                          <a class="show" id="pills-upcoming-tab" data-bs-toggle="pill" href="#pills-upcoming" role="tab" aria-controls="pills-upcoming" aria-selected="false">
                            <span class="title">
                              <i class="fa fa-car" aria-hidden="true"></i>

                              Parking</span>

                          </a>
                        </li>

                        <li><a class="show" id="pills-weekly-tab" data-bs-toggle="pill" href="#pills-weekly" role="tab" aria-controls="pills-weekly" aria-selected="false"><span class="title">
                          <i class="fas fa-hard-hat"></i>
                          Workers</span></a></li>

                        <li><a class="show" id="pills-monthly-tab" data-bs-toggle="pill" href="#pills-monthly" role="tab" aria-controls="pills-monthly" aria-selected="false"><span class="title">
                          <i class="fa fa-shield-alt"></i>

                          Security</span></a></li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-xl-9 col-md-12 box-col-8 xl-70">
            <div class="email-right-aside bookmark-tabcontent">
              <div class="card email-body radius-left">
                <div class="ps-0">
                  <div class="tab-content">


                    <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                      <div class="card mb-0">
                        <div class="card-header">
                          <h5 class="mb-0">Basic Details</h5>
                        </div>

                        <div class="card-body p-0">
                              <form enctype="multipart/form-data" class="theme-form" id="BasicsubmitForm" action="{{$data['url']}}">
                                @csrf
                                  <div class="card">
                                    <div class="card-body row">

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="title">Society Name</label>
                                          <input class="form-control" id="society_name" value="{{$post->society_name}}" name="society_name" type="text" aria-describedby="" placeholder="Enter Society Name">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="title">State</label>
                                            <select class="form-select select2" id="state" name="state" onchange="getCities()">
                                                <option value="">Select State</option>
                                                @foreach(states(101) as $key=>$vals)
                                                  <option {{ ($post->state==$vals->id)?'selected':'' }} value="{{$vals->id}}">{{$vals->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="title">City</label>
                                            <select class="form-select select2" id="city" name="city" >
                                              <option value="">Select City</option>
                                                @foreach(cities($post->state) as $key=>$vals)
                                                  <option {{ ($post->city==$vals->id)?'selected':'' }} value="{{$vals->id}}">{{$vals->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="email">Society Address</label>
                                          <textarea class="form-control" id="society_address" name="society_address" type="text" aria-describedby="" placeholder="Enter Society Address">{{$post->society_address}}</textarea>
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="email">Email</label>
                                          <input class="form-control" id="email"  value="{{$post->email}}" name="email" type="text" aria-describedby="" placeholder="Enter Email">
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Pincode</label>
                                          <input class="form-control"  value="{{$post->pincode}}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" id="pincode" name="pincode"  placeholder="Enter Pincode Number">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile"> Society Unique ID</label>
                                          <input class="form-control"  value="{{$post->society_unique_id}}"  type="text"  id="society_unique_id" name="society_unique_id" placeholder="Enter Society Unique ID">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Total Flats</label>
                                          <input class="form-control" type="number"   value="{{$post->total_flats}}"  id="total_flats" name="total_flats" placeholder="Enter Total Flats">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Emergency Contact No</label>
                                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" value="{{$post->emergency_contact_no}}" id="emergency_contact_no" name="emergency_contact_no"  placeholder="Enter Contact Number">
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">RWA Registration No</label>
                                          <input class="form-control" type="text"  id="rwa_registration" name="rwa_registration" value="{{$post->rwa_registration}}"  placeholder="Enter Registration Number">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Registration date</label>
                                          <input class="form-control" type="date"  id="registration_date" name="registration_date"  value="{{$post->registration_date}}"   placeholder="Enter Registration Date">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Last Election date</label>
                                          <input class="form-control" type="date"  id="last_election_held" name="last_election_held"  value="{{$post->last_election_held}}"   placeholder="Enter Last Election Date">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Last Election Due date</label>
                                          <input class="form-control" type="date"  id="election_due_date" name="election_due_date"  value="{{$post->election_due_date}}"  placeholder="Enter Election Due Date">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Last Audit</label>
                                          <input class="form-control" type="date"  id="last_audit" name="last_audit"  value="{{$post->last_audit}}"  placeholder="Enter Last Audit">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">No of Families</label>
                                          <input class="form-control" type="number"  id="no_of_families" name="no_of_families"   value="{{$post->no_of_families}}"   placeholder="Enter No Of Families">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">No Of Gates</label>
                                          <input class="form-control" type="number"  id="no_of_gates" name="no_of_gates"   value="{{$post->no_of_gates}}"   placeholder="Enter No Of Gates">
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


                    {{-- <div class="fade tab-pane show" id="pills-todaytask" role="tabpanel" aria-labelledby="pills-todaytask-tab">

                      <div class="card mb-0">
                        <div class="card-header">
                          <h5 class="mb-0">Committe Details</h5>
                        </div>
                        <div class="card-body p-0">
                              <form enctype="multipart/form-data" class="theme-form" id="CommittesubmitForm" action="{{route('society-committe-member-update',$post->id)}}">
                                @csrf
                                  <div class="card">
                                    <div class="card-body row">

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="title">Name</label>
                                          <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->name:''}}" id="name" name="name" type="text" aria-describedby="" placeholder="Enter Committe Name">
                                        </div>



                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile"> Designation</label>
                                          <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->designation:''}}"  type="text"  id="designation" name="designation" placeholder="Enter Designation">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Contact No</label>
                                          <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->contact_no:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="contact_no" name="contact_no"  placeholder="Enter Contact Number">
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">From date</label>
                                          <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->from_date:''}}" type="date"  id="from_date" name="from_date"  placeholder="Enter From Date">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="mobile">Till date</label>
                                          <input class="form-control"  value="{{ ($post->committe_details)?$post->committe_details->till_date:''}}"  type="date"  id="till_date" name="till_date"  placeholder="Enter Till date">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="email">Address</label>
                                          <textarea class="form-control" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Society Address">{{($post->committe_details)?$post->committe_details->address:''}}</textarea>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                      <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                                    </div>
                                  </div>
                              </form>
                        </div>
                      </div>

                    </div> --}}



                    <div class="fade tab-pane" id="pills-delayed" role="tabpanel" aria-labelledby="pills-delayed-tab">

                      <div class="card mb-0">

                        <div class="card-header">
                          <h5 class="mb-0">Society Members Details</h5>
                        </div>

                        <div class="card-body p-0">
                              <form enctype="multipart/form-data" class="theme-form" id="SocietyForm" action="{{route('society-member-update',$post->id)}}">
                                @csrf
                                  <div class="card">
                                    <div class="card-body row">

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="title">Full Name</label>
                                          <input   class="form-control"   value="{{ ($post->society_members_details)?$post->society_members_details->full_name:''}}"  id="full_name" name="full_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                        </div>



                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                          <input class="form-control" type="number"  value="{{ ($post->society_members_details)?$post->society_members_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="contact_no">Contact No</label>
                                          <input class="form-control" value="{{ ($post->society_members_details)?$post->society_members_details->contact_no:''}}"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="contact_no" name="contact_no"  placeholder="Enter Contact Number">
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_type">Type of Property</label>
                                          <input class="form-control" value="{{($post->society_members_details)?$post->society_members_details->property_type:''}}" type="text"  id="property_type" name="property_type"  placeholder="Enter Type of Property">
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Property Owned</label>
                                          <select class="form-select " id="property_owned" name="property_owned" >
                                              <option @if($post->society_members_details) @if($post->society_members_details->property_owned==1) selected @endif @endif value="1">Yes</option>
                                              <option @if($post->society_members_details) @if($post->society_members_details->property_owned==0) selected @endif @endif  value="0">No</option>
                                          </select>
                                        </div>




                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="address">Address</label>
                                          <textarea class="form-control" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Society Address">{{($post->society_members_details)?$post->society_members_details->address:''}}</textarea>
                                        </div>

                                        <div class="property_owner_div row"  @if($post->society_members_details) @if($post->society_members_details->property_owned==1) style="display: none" @endif @endif >

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="property_owner_name">Owner Name</label>
                                              <input class="form-control"  value="{{($post->society_members_details)?$post->society_members_details->property_owner_name:''}}" id="property_owner_name" name="property_owner_name" type="text" aria-describedby="" placeholder="Enter Property Owner Name">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="contact_no">Owner Contact No</label>
                                              <input class="form-control" value="{{($post->society_members_details)?$post->society_members_details->owner_contact_no:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="owner_contact_no" name="owner_contact_no"  placeholder="Enter Contact Number">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="address">Owner Address</label>
                                              <textarea class="form-control" id="owner_address" name="owner_address" type="text" aria-describedby="" placeholder="Enter Owner Address">{{($post->society_members_details)?$post->society_members_details->owner_address:''}}</textarea>
                                            </div>

                                        </div>



                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Are You Committee Member</label>
                                          <select class="form-select " onchange="toggleFunctionality('is_committee_member','is_committee_member_data')" id="is_committee_member" name="is_committee_member" >
                                              <option value="">Select</option>
                                              <option @if(isset($post)) @if($post->is_committee_member==1) selected @endif  @endif value="1">Yes</option>
                                              <option @if(isset($post)) @if($post->is_committee_member==0) selected @endif  @endif  value="0">No</option>
                                          </select>
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Add Family Member</label>
                                          <select class="form-select " onchange="toggleFunctionality('is_add_family_members','memberdetails')" id="is_add_family_members" name="is_add_family_members" >
                                              <option value="">Select</option>
                                              <option @if(isset($post)) @if($post->is_add_family_members==1) selected @endif  @endif value="1">Yes</option>
                                              <option @if(isset($post)) @if($post->is_add_family_members==0) selected @endif  @endif value="0">No</option>
                                          </select>
                                        </div>

                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Vehicle</label>
                                          <select class="form-select " onchange="toggleFunctionality('is_vehicle','is_vehicle_data')" id="is_vehicle" name="is_vehicle" >
                                              <option value="">Select</option>
                                              <option @if(isset($post)) @if($post->is_vehicle==1) selected @endif  @endif value="1">Yes</option>
                                              <option @if(isset($post)) @if($post->is_vehicle==0) selected @endif  @endif value="0">No</option>
                                          </select>
                                        </div>


                                        <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Add Staff Members</label>
                                          <select class="form-select " onchange="toggleFunctionality('is_staff_members','is_staff_members_data')" id="is_staff_members" name="is_staff_members" >
                                              <option value="">Select</option>
                                              <option @if(isset($post)) @if($post->is_staff_members==1) selected @endif  @endif  value="1">Yes</option>
                                              <option @if(isset($post)) @if($post->is_staff_members==0) selected @endif  @endif value="0">No</option>
                                          </select>
                                        </div>

                                         <div class="mb-3 text-align-left col-md-4">
                                          <label class="col-form-label  text-align-left pt-0" for="property_owned">Add Nominee</label>
                                          <select class="form-select " onchange="toggleFunctionality('is_nominee','nomineedetails')" id="is_nominee" name="is_nominee" >
                                              <option value="">Select</option>
                                              <option @if(isset($post)) @if($post->is_nominee==1) selected @endif  @endif value="1">Yes</option>
                                              <option @if(isset($post)) @if($post->is_nominee==0) selected @endif  @endif value="0">No</option>
                                          </select>
                                        </div>


                                        <div id="is_committee_member_data" class="row" style="display: none;">
                                            <h6><u>Committee Detail</u></h6>
                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="title">Name</label>
                                              <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->name:''}}" id="name" name="name" type="text" aria-describedby="" placeholder="Enter Committe Name">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="mobile"> Designation</label>
                                              <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->designation:''}}"  type="text"  id="designation" name="designation" placeholder="Enter Designation">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="mobile">Contact No</label>
                                              <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->contact_no:''}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="contact_no" name="contact_no"  placeholder="Enter Contact Number">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="mobile">From date</label>
                                              <input class="form-control" value="{{ ($post->committe_details)?$post->committe_details->from_date:''}}" type="date"  id="from_date" name="from_date"  placeholder="Enter From Date">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="mobile">Till date</label>
                                              <input class="form-control"  value="{{ ($post->committe_details)?$post->committe_details->till_date:''}}"  type="date"  id="till_date" name="till_date"  placeholder="Enter Till date">
                                            </div>

                                            <div class="mb-3 text-align-left col-md-4">
                                              <label class="col-form-label  text-align-left pt-0" for="email">Address</label>
                                              <textarea class="form-control" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Society Address">{{($post->committe_details)?$post->committe_details->address:''}}</textarea>
                                            </div>


                                        </div>


                                         <div id="memberdetails" style="display: none">

                                            @if($post->society_members_details)
                                              @if($post->society_members_details->family_details->count() > 0)

                                                @foreach($post->society_members_details->family_details as $key=>$vals)
                                                  <div class="memberdetails">
                                                    <h5 class=" mb-5 mb-0">Family Members Details</h5>
                                                    <div class="row" id="klon">
                                                      <div  class="col-md-10">
                                                        <div class="row row-padding" >
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
                                                              <input class="form-control" id="family_mother_name0"  value="{{$vals->family_mother_name}}"  name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                              <label class="col-form-label  text-align-left pt-0" for="family_gender0">Gender</label>
                                                              <select class="form-select " id="family_gender0" name="family_gender[]" >
                                                                  <option {{ ($vals->family_gender=='Male')?'selected':'' }} value="Male">Male</option>
                                                                  <option  {{ ($vals->family_gender=='Female')?'selected':'' }}  value="Female">Female</option>
                                                              </select>
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                              <label class="col-form-label  text-align-left pt-0" for="family_contact_no0">Contact No</label>
                                                              <input value="{{$vals->family_contact_no}}"  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no0" name="family_contact_no[]"  placeholder="Enter Contact Number">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                              <label class="col-form-label  text-align-left pt-0" for="family_dob0">DOB</label>
                                                              <input value="{{$vals->family_dob}}"  class="form-control" type="date"  id="family_dob0" name="family_dob[]"  placeholder="Enter DOB">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                              <label class="col-form-label  text-align-left pt-0" for="family_dob0">Date of Marriage</label>
                                                              <input value="{{$vals->family_marriage}}" class="form-control" type="date"  id="family_marriage0" name="family_marriage[]"  placeholder="Enter Marraige">
                                                            </div>

                                                            <div class="mb-3 text-align-left col-md-3">
                                                              <label class="col-form-label  text-align-left pt-0" for="family_occupation0">Occupation</label>
                                                              <input class="form-control" value="{{$vals->family_occupation}}" id="family_occupation0"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                                                            </div>
                                                        </div>
                                                      </div>
                                                      </div>

                                                  </div>
                                                @endforeach
                                              @else

                                            <div class="memberdetails">
                                              <h5 class=" mb-3 mt-3"> Add Family Members Details</h5>
                                                <div class="row" id="klon">
                                                  <div  class="col-md-10">
                                                    <div class="row row-padding" >
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
                                                          <input class="form-control" id="family_mother_name0"  name="family_mother_name[]"  type="text" aria-describedby="" placeholder="Enter Mother Name">
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                          <label class="col-form-label  text-align-left pt-0" for="family_gender0">Gender</label>
                                                          <select class="form-select " id="family_gender0" name="family_gender[]" >
                                                              <option value="Male">Male</option>
                                                              <option value="Female">Female</option>
                                                          </select>
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                          <label class="col-form-label  text-align-left pt-0" for="family_contact_no0">Contact No</label>
                                                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" id="family_contact_no0" name="family_contact_no[]"  placeholder="Enter Contact Number">
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                          <label class="col-form-label  text-align-left pt-0" for="family_dob0">DOB</label>
                                                          <input class="form-control" type="date"  id="family_dob0" name="family_dob[]"  placeholder="Enter DOB">
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                          <label class="col-form-label  text-align-left pt-0" for="family_dob0">Date of Marriage</label>
                                                          <input class="form-control" type="date"  id="family_dob0" name="family_marriage[]"  placeholder="Enter DOB">
                                                        </div>

                                                        <div class="mb-3 text-align-left col-md-3">
                                                          <label class="col-form-label  text-align-left pt-0" for="family_occupation0">Occupation</label>
                                                          <input class="form-control" id="family_occupation0"  name="family_occupation[]"  type="text" aria-describedby="" placeholder="Enter Occupation">
                                                        </div>
                                                    </div>
                                                  </div>

                                                  <div  class="col-md-2">
                                                    <a type="button" onclick="addMore()" class=" mt-4">Add More   <i class="fa fa-plus"></i> </a>
                                                  </div>
                                                </div>

                                            </div>
                                              @endif

                                              <div  class="col-md-2">
                                                <a type="button" onclick="addMore()" class=" mt-4">Add More   <i class="fa fa-plus"></i> </a>
                                              </div>
                                             @else



                                          @endif
                                         </div>


                                         <div id="nomineedetails" style="display: none">
                                         {{-- {{$post->society_members_details->nominee_detail}} --}}
                                          @if($post->society_members_details)
                                                @foreach($post->society_members_details->nominee_detail as $key=>$vals)
                                                  <div class="nomineedetails">
                                                    <div class="row" id="nomineeklon">
                                                      <div  class="col-md-10">
                                                        <div class="row row-padding" >
                                                            <div class="col-md-12">
                                                                <label class="col-form-label pt-0" for="nominator_name0">Nominating Person Name</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($vals)?$vals->nominator_name:'')}}" name="nominator_name[]" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                                                            </div>

                                                            <div class="col-md-12  pt-3">
                                                                <label class="col-form-label pt-0" for="nominated_name0">Nominated Person Name</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($vals)?$vals->nominated_name:'')}}" name="nominated_name[]" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                                                            </div>

                                                            <div class="col-md-12 pt-3">
                                                                <label class="col-form-label pt-0" for="percentage0">Percentage</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($vals)?$vals->percentage:'')}}" name="percentage[]" type="text" aria-describedby="" placeholder="Enter Percentage">
                                                            </div>
                                                        </div>
                                                      </div>
                                                      </div>

                                                  </div>
                                                @endforeach

                                              <div  class="col-md-2">
                                                <a type="button" onclick="addnominee()" class=" mt-4">Add More   <i class="fa fa-plus"></i> </a>
                                              </div>
                                          @else

                                            <div class="nomineedetails">
                                              <h5 class=" mb-3 mt-3"> Add Nominee Details</h5>
                                                <div class="row" id="nomineeklon">
                                                  <div  class="col-md-10">
                                                    <div class="row row-padding" >

                                                            <div class="col-md-12">
                                                                <label class="col-form-label pt-0" for="nominator_name0">Nominating Person Name</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($post)?$post->nominator_name:'')}}" name="nominator_name[]" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                                                            </div>

                                                            <div class="col-md-12  pt-3">
                                                                <label class="col-form-label pt-0" for="nominated_name0">Nominated Person Name</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($post)?$post->nominated_name:'')}}" name="nominated_name[]" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                                                            </div>

                                                            <div class="col-md-12 pt-3">
                                                                <label class="col-form-label pt-0" for="percentage0">Percentage</label>
                                                                <input class="form-control" id="name0" value="{{ (isset($post)?$post->percentage:'')}}" name="percentage[]" type="text" aria-describedby="" placeholder="Enter Percentage">
                                                            </div>

                                                    </div>
                                                  </div>

                                                  <div  class="col-md-2">
                                                    <a type="button" onclick="addnominee()" class=" mt-4">Add More   <i class="fa fa-plus"></i> </a>
                                                  </div>
                                                </div>

                                            </div>

                                          @endif
                                         </div>



                                        <div id="is_vehicle_data" class="row" style="display: none;">
                                            <h6><u>Vehicle Detail</u></h6>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="owner_name">Owner Name</label>
                                            <input   class="form-control"   value="{{ ($post->parking_details)?$post->parking_details->owner_name:''}}"  id="owner_name" name="owner_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                          </div>



                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                            <input class="form-control" type="number"  value="{{ ($post->parking_details)?$post->parking_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                          </div>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="vehicle_type">Vehicle Type</label>
                                            <input class="form-control" value="{{ ($post->parking_details)?$post->parking_details->vehicle_type:''}}"  type="text"  id="vehicle_type" name="vehicle_type"  placeholder="Enter Vehicle Type">
                                          </div>


                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="rc_number">RC No</label>
                                            <input class="form-control" value="{{($post->parking_details)?$post->parking_details->rc_number:''}}" type="text"  id="rc_number" name="rc_number"  placeholder="Enter RC Number">
                                          </div>


                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="is_insured">Is Insured</label>
                                            <select class="form-select " id="is_insured" name="is_insured" >
                                                <option  @if($post->parking_details) @if($post->parking_details->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                                <option  @if($post->parking_details) @if($post->parking_details->is_insured=='No') selected @endif @endif  value="No">No</option>
                                            </select>
                                          </div>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="parking_no">Parking No</label>
                                            <input class="form-control" value="{{($post->parking_details)?$post->parking_details->parking_no:''}}" type="text"  id="parking_no" name="parking_no"  placeholder="Enter Parking No">
                                          </div>

                                        </div>


                                        <div id="is_staff_members_data" class="row" style="display: none;">
                                            <h6><u>Staff Detail</u></h6>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="owner_name">Name</label>
                                            <input   class="form-control"   value="{{ ($post->workers)?$post->workers->name:''}}"  id="name" name="name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                          </div>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="f_name"> Father Name</label>
                                            <input class="form-control" type="text"  value="{{ ($post->workers)?$post->workers->f_name:''}}"   id="f_name" name="f_name" placeholder="Enter Father Name">
                                          </div>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                            <input class="form-control" type="number"  value="{{ ($post->parking_details)?$post->parking_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                          </div>


                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address"  aria-describedby="" placeholder="Enter Address">{{($post->workers)?$post->workers->address:''}}</textarea>
                                          </div>

                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="permanent_address">Permanent Address</label>
                                            <textarea class="form-control" id="permanent_address" name="permanent_address"  aria-describedby="" placeholder="Enter Permanent Address">{{($post->workers)?$post->workers->permanent_address:''}}</textarea>
                                          </div>



                                          <div class="mb-3 text-align-left col-md-4">
                                            <label class="col-form-label  text-align-left pt-0" for="aadhar_card">Aadhar Card</label>
                                            <input class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" value="{{ ($post->workers)?$post->workers->aadhar_card:''}}"  type="text"  id="aadhar_card" name="aadhar_card"  placeholder="Enter Aadhar Card">
                                          </div>

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


                    <div class="fade tab-pane" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab">
                        <div class="card mb-0">
                          <div class="card-header d-flex">
                            <h6 class="mb-0">Parking Details</h6><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                          </div>

                          <form enctype="multipart/form-data" class="theme-form" id="SocietyParkingForm" action="{{route('society-parking-update',$post->id)}}">
                            @csrf
                            <div class="card-body">
                                  <div class=" row text-center">

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="owner_name">Owner Name</label>
                                      <input   class="form-control"   value="{{ ($post->parking_details)?$post->parking_details->owner_name:''}}"  id="owner_name" name="owner_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                    </div>



                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                      <input class="form-control" type="number"  value="{{ ($post->parking_details)?$post->parking_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="vehicle_type">Vehicle Type</label>
                                      <input class="form-control" value="{{ ($post->parking_details)?$post->parking_details->vehicle_type:''}}"  type="text"  id="vehicle_type" name="vehicle_type"  placeholder="Enter Vehicle Type">
                                    </div>


                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="rc_number">RC No</label>
                                      <input class="form-control" value="{{($post->parking_details)?$post->parking_details->rc_number:''}}" type="text"  id="rc_number" name="rc_number"  placeholder="Enter RC Number">
                                    </div>


                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="is_insured">Is Insured</label>
                                      <select class="form-select " id="is_insured" name="is_insured" >
                                          <option  @if($post->parking_details) @if($post->parking_details->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                          <option  @if($post->parking_details) @if($post->parking_details->is_insured=='No') selected @endif @endif  value="No">No</option>
                                      </select>
                                    </div>

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="parking_no">Parking No</label>
                                      <input class="form-control" value="{{($post->parking_details)?$post->parking_details->parking_no:''}}" type="text"  id="parking_no" name="parking_no"  placeholder="Enter Parking No">
                                    </div>


                                </div>

                                <div class="card-footer">
                                  <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                                </div>
                            </div>

                          </form>
                        </div>
                    </div>



                    <div class="fade tab-pane" id="pills-weekly" role="tabpanel" aria-labelledby="pills-weekly-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">Workers Details</h6>
                          {{-- <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect>
                            </svg>Print
                          </a> --}}
                        </div>

                        <form enctype="multipart/form-data" class="theme-form" id="WorkersParkingForm" action="{{route('society-workers-update',$post->id)}}">
                          @csrf
                          <div class="card-body">
                                <div class=" row text-center">

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="owner_name">Name</label>
                                    <input   class="form-control"   value="{{ ($post->workers)?$post->workers->name:''}}"  id="name" name="name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="f_name"> Father Name</label>
                                    <input class="form-control" type="text"  value="{{ ($post->workers)?$post->workers->f_name:''}}"   id="f_name" name="f_name" placeholder="Enter Father Name">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                    <input class="form-control" type="number"  value="{{ ($post->parking_details)?$post->parking_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                                  </div>


                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address"  aria-describedby="" placeholder="Enter Address">{{($post->workers)?$post->workers->address:''}}</textarea>
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="permanent_address">Permanent Address</label>
                                    <textarea class="form-control" id="permanent_address" name="permanent_address"  aria-describedby="" placeholder="Enter Permanent Address">{{($post->workers)?$post->workers->permanent_address:''}}</textarea>
                                  </div>



                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="aadhar_card">Aadhar Card</label>
                                    <input class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" value="{{ ($post->workers)?$post->workers->aadhar_card:''}}"  type="text"  id="aadhar_card" name="aadhar_card"  placeholder="Enter Aadhar Card">
                                  </div>

                              </div>

                              <div class="card-footer">
                                <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                              </div>
                          </div>

                        </form>
                      </div>
                    </div>



                    <div class="fade tab-pane" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">Security Details</h6>
                          {{-- <a href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect>
                            </svg>Print
                          </a> --}}
                        </div>

                        <form enctype="multipart/form-data" class="theme-form" id="SecurityForm" action="{{route('society-security-update',$post->id)}}">
                          @csrf
                          <div class="card-body">
                                <div class=" row text-center">
                                    <h6>Security Form</h6>
                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="owner_name">Name</label>
                                    <input   class="form-control"   value="{{ ($post->security)?$post->security->name:''}}"  id="name" name="name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="f_name"> Father Name</label>
                                    <input class="form-control" type="text"  value="{{ ($post->security)?$post->security->fathers_name:''}}"   id="fathers_name" name="fathers_name" placeholder="Enter Father Name">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="dob"> DOB </label>
                                    <input class="form-control" type="date"  value="{{ ($post->security)?$post->security->dob:''}}"   id="dob" name="dob" placeholder="Enter DOB">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="education"> Education </label>
                                    <input class="form-control" type="text"  value="{{ ($post->security)?$post->security->education:''}}"   id="education" name="education" placeholder="Enter Education">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address"  aria-describedby="" placeholder="Enter Address">{{($post->security)?$post->security->address:''}}</textarea>
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="permanent_address">Permanent Address</label>
                                    <textarea class="form-control" id="permanent_address" name="permanent_address"  aria-describedby="" placeholder="Enter Permanent Address">{{($post->security)?$post->security->permanent_address:''}}</textarea>
                                  </div>

                                  <div class="mb-3 text-align-left col-md-4">
                                    <label class="col-form-label  text-align-left pt-0" for="aadhar_card">Aadhar Card</label>
                                    <input class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="12" value="{{ ($post->security)?$post->workers->aadhar_card:''}}"  type="text"  id="aadhar_card" name="aadhar_card"  placeholder="Enter Aadhar Card">
                                  </div>

                                  <div class="mb-3 text-align-left col-md-3">
                                    <label class="col-form-label  text-align-left pt-0" for="is_security_agency">Is Insured</label>
                                    <select class="form-select " id="is_security_agency" name="is_security_agency" >
                                        <option value="">Select</option>
                                        <option @if($post->security) @if($post->security->is_security_agency==1) selected @endif @endif  value="1">Yes</option>
                                        <option @if($post->security) @if($post->security->is_security_agency==0) selected @endif @endif value="0">No</option>
                                    </select>
                                  </div>

                                  <div class="is_security_agency_div row"  @if($post->security) @if($post->security->is_security_agency==0) style="display: none"  @endif @else style="display: none"  @endif >

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="agency_name">Agency Name</label>
                                      <input class="form-control"  value="{{($post->security)?$post->security->agency_name:''}}" id="agency_name" name="agency_name" type="text" aria-describedby="" placeholder="Enter Agency Name">
                                    </div>


                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="agency_city">Agency City</label>
                                      <input class="form-control"  value="{{($post->security)?$post->security->agency_city:''}}" id="agency_city" name="agency_city" type="text" aria-describedby="" placeholder="Enter City Name">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="licence">licence</label>
                                      <input class="form-control"  value="{{($post->security)?$post->security->licence:''}}" id="licence" name="licence" type="text" aria-describedby="" placeholder="Enter Licence">
                                    </div>

                                    <div class="mb-3 text-align-left col-md-4">
                                      <label class="col-form-label  text-align-left pt-0" for="address">Agency Address</label>
                                      <textarea class="form-control" id="agency_address" name="agency_address" type="text" aria-describedby="" placeholder="Enter Agency Address">{{($post->security)?$post->security->agency_address:''}}</textarea>
                                    </div>

                                </div>

                              </div>

                              <div class="card-footer">
                                <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                              </div>
                          </div>

                        </form>
                      </div>
                    </div>




                    <div class="fade tab-pane" id="pills-assigned" role="tabpanel" aria-labelledby="pills-assigned-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">Assigned to me</h6><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                        </div>
                        <div class="card-body p-0">
                          <div class="taskadd">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody><tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                              </tbody></table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="fade tab-pane" id="pills-tasks" role="tabpanel" aria-labelledby="pills-tasks-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">My tasks</h6><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                        </div>
                        <div class="card-body p-0">
                          <div class="taskadd">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody><tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                                <tr>
                                  <td>
                                    <h6 class="task_title_0">Task name</h6>
                                    <p class="project_name_0">General</p>
                                  </td>
                                  <td>
                                    <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                  </td>
                                  <td><a class="me-2" href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a></td>
                                  <td><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
                                </tr>
                              </tbody></table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="fade tab-pane" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">Notification</h6><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                        </div>
                        <div class="card-body">
                          <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="fade tab-pane" id="pills-newsletter" role="tabpanel" aria-labelledby="pills-newsletter-tab">
                      <div class="card mb-0">
                        <div class="card-header d-flex">
                          <h6 class="mb-0">Newsletter</h6><a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                        </div>
                        <div class="card-body">
                          <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade modal-bookmark" id="createtag" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Create Tag</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">                                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-bookmark needs-validation" novalidate="">
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <label>Tag Name</label>
                                  <input class="form-control" type="text" required="" autocomplete="off">
                                </div>
                                <div class="form-group col-md-12 mb-0">
                                  <label>Tag color</label>
                                  <input class="form-control fill-color" type="color" value="#24695c">
                                </div>
                              </div>
                              <button class="btn btn-secondary" type="button">Save</button>
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



@endsection

@section('pagejs')


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://www.khiladys.com/public/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://www.khiladys.com/public/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">

toggleFunctionality('is_add_family_members','memberdetails');

      function toggleFunctionality(changeKey,hideKey){

        var changeVal = $("#"+changeKey+' option:selected').val();
            if(changeVal==1){
              $("#"+hideKey).show();
            }
            else{
              $("#"+hideKey).hide();
            }
      }

      function getCities(){

             $.ajax({
                url: '{{route('get.cities')}}',
                type: "GET",
                data: {state_id: $("#state option:selected").val()},
                success: function(data) {
                    $("#city").empty();
                    $("#city").append("<option value=''>Select</option>");
                    $("#city").append(data);
                }
            });

      }



      $("#property_owned").on('change',function(){
          if($("#property_owned option:selected").val()==0){
            $(".property_owner_div").show();
          }
          else{
            $(".property_owner_div").hide();
          }
      });

      $("#is_security_agency").on('change',function(){
          if($("#is_security_agency option:selected").val()==1){
            $(".is_security_agency_div").show();
          }
          else{
            $(".is_security_agency_div").hide();
          }
      });



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



            var cloneCount = 1;

      function addnominee(){


          var clone = $('#nomineeklon').clone();


              clone.find(".col-md-2").html();
              //clone.find(".col-md-2").html("")
              clone.find(".col-md-2").html(`<a type="button"  onclick="removeNominee(${cloneCount})" class="mt-4">remove   <i class="fa fa-minus"></i> </a>`)
              // console.log(clone.find(".col-md-2").html(`<a  type="button" onclick="removeNominee(${cloneCount})" class=" mt-4">remove   <i class="fa fa-minus"></i> </a>`));
              clone.attr('id', 'nomineeklon'+ cloneCount++).insertAfter('[id^=nomineeklon]:last');
      }

      function removeNominee(id){

        $("#nomineeklon"+id).remove();

      }


        $(function () {

          $('.select2').select2();


          //  $('#BasicsubmitForm').submit(function(){
          //   var $this = $('#submitButton');
          //   buttonLoading('loading', $this);
          //   $('.is-invalid').removeClass('is-invalid state-invalid');
          //   $('.invalid-feedback').remove();
          //   $.ajax({
          //       url: $('#BasicsubmitForm').attr('action'),
          //       type: "POST",
          //       processData: false,  // Important!
          //       contentType: false,
          //       cache: false,
          //       data: new FormData($('#BasicsubmitForm')[0]),
          //       success: function(data) {
          //           if(data.status){
          //               var btn = '<a href="{{route('user-list')}}" class="btn btn-info btn-sm">GoTo List</a>';
          //               successMsg('Create User', data.msg, btn);
          //               $('#BasicsubmitForm')[0].reset();

          //           }else{
          //               $.each(data.errors, function(fieldName, field){
          //                   $.each(field, function(index, msg){
          //                       $('#'+fieldName).addClass('is-invalid state-invalid');
          //                      errorDiv = $('#'+fieldName).parent('div');
          //                      errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
          //                   });
          //               });
					// 	errorMsg('Create User', 'Input Error');
          //           }
          //           buttonLoading('reset', $this);

          //       },
          //       error: function() {
          //           errorMsg('Create User', 'There has been an error, please alert us immediately');
          //           buttonLoading('reset', $this);
          //       }

          //   });

          //   return false;
          //  });
      });




        $('form').submit(function(e) {

                event.preventDefault();

                var id = $(this).attr('id');

                var $this = $('#'+id+' #submitButton');

                buttonLoading('loading', $this);
                $('.is-invalid').removeClass('is-invalid state-invalid');
                $('.invalid-feedback').remove();

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    processData: false,  // Important!
                    contentType: false,
                    cache: false,
                    data: new FormData($('#'+id)[0]),
                    success: function(data){
                        if(data.status){
                          successMsg('Society Update', data.msg, '');
                        }
                        else{
                            $.each(data.errors, function(fieldName, field){
                                $.each(field, function(index, msg){

                                  $('#'+id+' #'+fieldName).addClass('is-invalid state-invalid');
                                  errorDiv = $('#'+id+' #'+fieldName).parent('div');
                                  errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');

                                });
                            });

                            errorMsg('Create Property','Input error');
                        }

                        buttonLoading('reset', $this);

                    },
                    errors:function(){
                      buttonLoading('reset', $this);
                    }
                });
                return false;

        });







      $(document).ready(() => {
          let url = location.href;

          if (location.hash) {
            const hash = url.split("#");
            $('a[href="#'+hash[1]+'"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
              $(window).scrollTop(0);
            }, 400);
          }

          $('a[data-bs-toggle="pill"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("href");
            if(hash == "#home") {
              newUrl = url.split("#")[0];
            } else {
              newUrl = url.split("#")[0] + hash;
            }
            newUrl += "";
            history.replaceState(null, null, newUrl);
          });
    });

    const anchor = window.location.hash;
$(`a[href="${anchor}"]`).tab('show')
    </script>
@stop
