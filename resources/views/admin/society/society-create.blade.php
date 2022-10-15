@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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

                    <div class="card-header">
                      <h6>Building Information</h6>
                    </div>

                    <div class="card-body row">

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="title">Society Name <span class="text-danger">*</span> </label>
                          <input class="form-control"  value="{{(isset($post))?$post->society_name:''}}" id="society_name" name="society_name" type="text" aria-describedby="">
                        </div>

                        {{-- <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="title">State</label>
                            <select class="form-select select2" id="state" name="state" onchange="getCities()">
                                <option value="">Select State</option>
                                @foreach(states(101) as $key=>$vals)
                                  <option value="{{$vals->id}}">{{$vals->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="title">City</label>
                            <select class="form-select select2" id="city" name="city" >
                              <option value="">Select City</option>
                            </select>
                        </div>  --}}



                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="email">Email  <span class="text-danger">*</span></label>
                          <input autocomplete="off" class="form-control"   value="{{(isset($post))?$post->email:''}}"  id="email" name="email" type="text" aria-describedby="" autocomplete="off">
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Password</label>
                          <input  autocomplete="off" class="form-control" type="password"  id="password" name="password" placeholder="Enter Password" autocomplete="off">
                        </div>


                        {{-- <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Pincode</label>
                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="6" id="pincode" name="pincode"  placeholder="Enter Pincode Number">
                        </div> --}}

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile"> Security Guard Mobile No :  <span class="text-danger">*</span></label>
                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10"   value="{{(isset($post))?$post->security_guard_mobile:''}}"  id="security_guard_mobile" name="security_guard_mobile" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile"> Secretary Mobile No :  <span class="text-danger">*</span></label>
                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10"   value="{{(isset($post))?$post->secrataty_mobile:''}}"  id="secrataty_mobile" name="secrataty_mobile" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Emergency Contact No</label>
                          <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10"  value="{{(isset($post))?$post->emergency_contact_no:''}}"  id="emergency_contact_no" name="emergency_contact_no">
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile"> Society Unique ID  <span class="text-danger">*</span></label>
                          <input class="form-control" type="text"    value="{{(isset($post))?$post->society_unique_id:''}}" id="society_unique_id" name="society_unique_id" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Total Flats</label>
                          <input class="form-control" type="number"   value="{{(isset($post))?$post->total_flats:''}}"  id="total_flats" name="total_flats" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Building Construction Year</label>
                          <select class="form-select " id="building_make_year" name="building_make_year" >
                            <option value="">Select</option>
                            @for($i=2012;$i<=date('Y');$i++)
                            <option @if(isset($post)) @if($post->building_make_year==$i) selected  @endif @endif value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        </div>


                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">RWA Registration No</label>
                          <input class="form-control"  value="{{(isset($post))?$post->rwa_registration:''}}"  type="text"  id="rwa_registration" name="rwa_registration"  >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Registration date</label>
                          <input class="form-control" type="date"   value="{{(isset($post))?$post->registration_date:''}}"  id="registration_date" name="registration_date"  >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Last Election date</label>
                          <input class="form-control" type="date"    value="{{(isset($post))?$post->last_election_held:''}}"  id="last_election_held" name="last_election_held"  >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Election Due date</label>
                          <input class="form-control" type="date"  value="{{(isset($post))?$post->election_due_date:''}}" id="election_due_date" name="election_due_date"  >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">Last Audit</label>
                          <input class="form-control" type="date"   value="{{(isset($post))?$post->last_audit:''}}" id="last_audit" name="last_audit" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">No of Families</label>
                          <input class="form-control" type="number"   value="{{(isset($post))?$post->no_of_families:''}}"  id="no_of_families" name="no_of_families" >
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="mobile">No Of Gates</label>
                          <input class="form-control" type="number"    value="{{(isset($post))?$post->no_of_gates:''}}"  id="no_of_gates" name="no_of_gates">
                        </div>

                        <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="email">Society Address  <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="society_address" name="society_address" type="text" aria-describedby="" >{{(isset($post))?$post->society_address:''}}</textarea>
                        </div>

                        {{-- <div class="mb-3 col-md-4">
                          <label class="col-form-label pt-0" for="password">Password  <span class="text-danger">*</span></label>
                          <input class="form-control" type="text" value="{{(isset($post))?$post->password:''}}"  id="password" name="password">

                        </div> --}}



                    </div>

                  </div>


                  <div class="card">

                    <div class="card-header">
                      <h6>   Builder Information  </h6>
                    </div>


                    <div class="card-body row">

                      <div class="mb-3 col-md-6">
                        <label class="col-form-label pt-0" for="title">Company Name</label>
                        <input class="form-control" id="builder_company_name"  value="{{(isset($post))?$post->builder_company_name:''}}" name="builder_company_name" type="text" aria-describedby="" >
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="col-form-label pt-0" for="title">Company Phone</label>
                        <input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" id="builder_company_phone" value="{{(isset($post))?$post->builder_company_phone:''}}" name="builder_company_phone" type="number" aria-describedby="">
                      </div>

                      <div class="mb-3 col-md-12">
                        <label class="col-form-label pt-0" for="title">Company Address</label>

                        <textarea name="builder_company_address" id="builder_company_address"  class="form-control">{{(isset($post))?$post->builder_company_address:''}}</textarea>

                      </div>



                    </div>

                  </div>



                  <div class="card">

                    <div class="card-header">
                      <h6>  Building Rules </h6>
                    </div>


                    <div class="card-body row">
                      <div class="mb-3 col-md-12">
                        <label class="col-form-label pt-0" for="title">Building Rules</label>
                        <textarea name="building_rules" id="building_rules" class="form-control">{!!(isset($post))?$post->building_rules:''!!}</textarea>
                      </div>

                      <div class="mb-3 col-md-12">
                        <label class="col-form-label pt-0" for="mobile">Status</label>
                        <select class="form-select " id="status" name="status" >
                          <option value="">Select</option>
                          <option @if(isset($post)) @if($post->status==1) selected  @endif @endif  value="1">Active</option>
                          <option  @if(isset($post)) @if($post->status==0) selected  @endif @endif value="0">InActive</option>
                      </select>
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

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
  $('#building_rules').summernote({tabsize: 1,
        height: 500});
});

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

        $(function () {

          $('.select2').select2();


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
@stop
