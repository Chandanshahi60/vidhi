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
                        <label class="col-form-label pt-0" for="floor_no">Floor No</label>
                            <select class="form-select" onchange="getunit()"  id="floor_no" name="floor_no" >
                                <option value="">Select</option>
                                @foreach ($floor as $item)
                                <option @if(isset($post))  @if($post->floor_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="unit_no">Unit No</label>
                            <select class="form-select" id="unit_no" name="unit_no" >
                                <option value="">Select</option>
                                @foreach ($unit as $item)
                                <option @if(isset($post))  @if($post->unit_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->unit_no}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="owner_name">Owner Name</label>
                            <input class="form-control" id="owner_name" value="{{ (isset($post)?$post->owner_name:'')}}" name="owner_name" type="text" aria-describedby="" placeholder="Enter owner_name">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="title">Select Utility Month</label>
                            <select class="form-select" id="month" name="month" >
                                @foreach ($month as $key=>$val)
                                <option @if(isset($post)) @if($post->month==$val->month_name) selected @endif  @endif value="{{$val->month_name}}">{{$val->month_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="year">Select Utility Year</label>
                            <select class="form-select" id="year" name="year" >
                                @foreach ($year as $key=>$val)
                                <option @if(isset($post)) @if($post->year==$val->year_name) selected @endif  @endif value="{{$val->year_name}}">{{$val->year_name}}</option>
                                @endforeach
                            </select>
                        </div>

                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="water_bill">Water Bill</label>
                            <input class="form-control" id="water_bill" value="{{ (isset($post)?$post->water_bill:'')}}" name="water_bill" type="text" aria-describedby="" placeholder="Enter water_bill">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="electric_bill">Electric Bill</label>
                            <input class="form-control" id="electric_bill" value="{{ (isset($post)?$post->electric_bill:'')}}" name="electric_bill" type="text" aria-describedby="" placeholder="Enter electric_bill">
                        </div>


                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="gas_bill">Gas Bill</label>
                            <input class="form-control" id="gas_bill" value="{{ (isset($post)?$post->gas_bill:'')}}" name="gas_bill" type="text" aria-describedby="" placeholder="Enter gas_bill">
                        </div>


                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="security_bill">Security Bill</label>
                            <input class="form-control" id="security_bill" value="{{ (isset($post)?$post->security_bill:'')}}" name="security_bill" type="text" aria-describedby="" placeholder="Enter security_bill">
                        </div>


                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="utility_bill">Utility Bill</label>
                            <input class="form-control" id="utility_bill" value="{{ (isset($post)?$post->utility_bill:'')}}" name="utility_bill" type="text" aria-describedby="" placeholder="Enter utility_bill">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="other_bill">Other Bill</label>
                            <input class="form-control" id="other_bill" value="{{ (isset($post)?$post->other_bill:'')}}" name="other_bill" type="text" aria-describedby="" placeholder="Enter other_bill">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="total_rent">Total Rent</label>
                            <input class="form-control" id="total_rent" value="{{ (isset($post)?$post->total_rent:'')}}" name="total_rent" type="text" aria-describedby="" placeholder="Enter total_rent">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="issue_date">Issue Date</label>
                            <input class="form-control" id="issue_date" value="{{ (isset($post)?$post->issue_date:'')}}" name="issue_date" type="date" aria-describedby="" placeholder="Enter issue_date">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="title">Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="">Select</option>
                            <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                            <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">In Active</option>
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
@stop

