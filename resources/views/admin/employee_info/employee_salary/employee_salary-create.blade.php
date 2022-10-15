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
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="name">Employee Name</label>
                                <select class="form-select" id="name" name="name" >
                                    <option value="">Select</option>
                                    @foreach ($employee as $item)
                                    <option @if(isset($post))  @if($post->name == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="designation">Designation</label>
                                <select class="form-select" id="designation" name="designation" >
                                    @foreach ($management_member as $key=>$val)
                                    <option @if(isset($post)) @if($post->designation==$val->member_type) selected @endif  @endif value="{{$val->member_type}}">{{$val->member_type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">Salary Month</label>
                                <select class="form-select" id="month" name="month" >
                                    @foreach ($month as $key=>$val)
                                    <option @if(isset($post)) @if($post->month==$val->month_name) selected @endif  @endif value="{{$val->month_name}}">{{$val->month_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="year">Salary Year</label>
                                <select class="form-select" id="year" name="year" >
                                    @foreach ($year as $key=>$val)
                                    <option @if(isset($post)) @if($post->year==$val->year_name) selected @endif  @endif value="{{$val->year_name}}">{{$val->year_name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="per_month">Salary Per Month</label>
                                <input class="form-control" value="{{ (isset($post)?$post->per_month:'')}}" id="per_month" name="per_month" type="text" aria-describedby="" placeholder="Enter Salary Per Month">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="issue_date">Issue Date</label>
                                <input class="form-control" value="{{ (isset($post)?$post->issue_date:'')}}" id="issue_date" name="issue_date" type="date" aria-describedby="" placeholder="Enter Issue Date">
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="status">Status</label>
                                <select class="form-select" id="status" name="status" >
                                    <option value="">Select</option>
                                    <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                                    <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Leave</option>
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
                        var btn = '';
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
