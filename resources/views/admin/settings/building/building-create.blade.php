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
                <div class="card-body">

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="name">Name</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->name:'')}}" name="name" type="text" aria-describedby="" placeholder="Enter Owner Name">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="email">Email</label>
                      <input class="form-control" id="email" value="{{ (isset($post)?$post->email:'')}}" name="email" type="text" aria-describedby="" placeholder="Enter Email">
                    </div>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="contact_no">Contact No</label>
                      <input class="form-control" value="{{ (isset($post)?$post->contact_no:'')}}" id="contact_no" name="contact_no" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="security_guard_mobile">Security Guard Mobile No</label>
                      <input class="form-control" value="{{ (isset($post)?$post->security_guard_mobile:'')}}" id="security_guard_mobile" name="security_guard_mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="secretary_mobile">Secretary Mobile No</label>
                      <input class="form-control" value="{{ (isset($post)?$post->secretary_mobile:'')}}" id="secretary_mobile" name="secretary_mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="moderator_mobile">Moderator Mobile No</label>
                      <input class="form-control" value="{{ (isset($post)?$post->moderator_mobile:'')}}" id="moderator_mobile" name="moderator_mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10"  aria-describedby="" placeholder="Enter contact no">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="building_construction_year">Building Construction Year</label>
                      {{-- <input class="form-control" value="{{ (isset($post)?$post->building_construction_year:'')}}" id="building_construction_year" name="building_construction_year" type="text" aria-describedby="" placeholder="Enter contact no"> --}}
                        <select class="form-select " id="building_construction_year" name="building_construction_year" >
                            <option value="">Select</option>
                            @for($i=2000;$i<=date('Y');$i++)
                            <option @if(isset($post)) @if($post->building_construction_year==$i) selected  @endif @endif value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="address">Address</label>
                      <input class="form-control" value="{{ (isset($post)?$post->address:'')}}" id="address" name="address" type="text" aria-describedby="" placeholder="Enter Present Address">
                    </div>

                    <div class="mb-3">
                      <label  class="col-form-label pt-0">Building Image</label>

                      <div class="row">
                          <div class="col-md-10 ">
                              <input id="image" type="file" class="form-control align-middle custom-file-input" name="photo" onchange="readURL(this, 'FileImg');">

                            </div>
                          <div class="col-md-2 ">
                          <img id="FileImg" value="{{ (isset($post)?$post->photo:'')}}" src="{{url('/uploads/profile/default.png')}}"  style="width: 71px;height: 71px">
                          </div>
                      </div>
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Status</label>
                      <select class="form-select" id="status" name="status" >
                          <option value="">Select</option>
                          <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Enable</option>
                          <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Disable</option>
                        </select>
                    </div>

                    <h4>Builder Information</h4><br>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="company_name">Company Name</label>
                      <input class="form-control" id="company_name" value="{{ (isset($post)?$post->company_name:'')}}" name="company_name" type="text" aria-describedby="" placeholder="Enter Owner Name">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="company_mobile">Company Phone No</label>
                      <input class="form-control" value="{{ (isset($post)?$post->company_mobile:'')}}" id="company_mobile" name="company_mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact no">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="company_address">Company Address</label>
                      <input class="form-control" value="{{ (isset($post)?$post->company_address:'')}}" id="company_address" name="company_address" type="text" aria-describedby="" placeholder="Enter Present Address">
                    </div>

                    <h4>Building Rules</h4><br>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="apartment_rules">Apartment Rules</label>
                      <textarea class="form-control" id="apartment_rules" name="apartment_rules" type="text" aria-describedby="" placeholder="Enter Present Address">{!! (isset($post)?$post->apartment_rules:'')!!}</textarea>
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
  $('#apartment_rules').summernote({tabsize: 1,
        height: 250});
});
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
@stop
