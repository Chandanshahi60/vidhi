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
        <div class="col-sm-12 col-xl-6">
        <h4>Owner Detail</h4>
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                @csrf
              <div class="card">
                <div class="card-body">

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
                      <input class="form-control" value="{{ (isset($post)?$post->password:'')}}" id="password" name="password" type="text" aria-describedby="" placeholder="Enter password">
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
                      <label class="col-form-label pt-0" for="nid">NID (National ID Card)</label>
                      <input class="form-control" value="{{ (isset($post)?$post->nid:'')}}" id="nid" name="nid" type="text" aria-describedby="" placeholder="Enter National ID Card">
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
                                <input type="checkbox" @if(isset($post))  @if(in_array($item->id,explode(',',$post->owner_unit))) checked @endif @endif value="{{$item->id}}" name="owner_unit[]" id="owner_unit{{$item->id}}" style="margin-right:8px">{{$item->unit_no}}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                      <label  class="col-form-label pt-0"> Owner Photo </label>

                      <div class="row">
                          <div class="col-md-10 ">
                              <input id="image" type="file" class="form-control align-middle custom-file-input" name="owner_photo" onchange="readURL(this, 'FileImg');">

                            </div>
                          <div class="col-md-2 ">
                          <img id="FileImg" value="{{ (isset($post)?$post->owner_photo:'')}}" src="{{url('/uploads/profile/default.png')}}"  style="width: 71px;height: 71px">
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






                </div>
                <div class="card-footer">
                  <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

                </div>
              </div>
            </form>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-xl-6">
        <h4>Nomination Detail</h4>
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                @csrf
              <div class="card">
                <div class="card-body">

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="nominator_name">Nominating Person Name</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->nominator_name:'')}}" name="nominator_name" type="text" aria-describedby="" placeholder="Enter Nominator Name">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="floor">Floor</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->floor:'')}}" name="floor" type="text" aria-describedby="" placeholder="Enter Floor">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="nominated_name">Nominated Person Name</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->nominated_name:'')}}" name="nominated_name" type="text" aria-describedby="" placeholder="Enter Nominated Person Name">
                    </div>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="percentage">Percentage</label>
                      <input class="form-control" id="name" value="{{ (isset($post)?$post->percentage:'')}}" name="percentage" type="text" aria-describedby="" placeholder="Enter Percentage">
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
@stop
