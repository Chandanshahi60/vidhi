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
                       <label class="col-form-label pt-0" for="unit_no">Available Unit No</label>
                        <select class="form-select" id="unit_no" name="unit_no" >
                              <option value="">Select</option>
                              @foreach ($unit as $item)
                              <option @if(isset($post))  @if($post->unit_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->title}}</option>
                              @endforeach
                        </select>
                    </div>

                      <div class="mb-3">
                      <label class="col-form-label pt-0" for="month">Rent Month</label>
                        <select class="form-select" id="month" name="month" >
                              <option value="">Select Month</option>
                              @foreach ($month as $item)
                              <option @if(isset($post))  @if($post->month == $item->month_name) selected @endif @endif value="{{$item->month_name}}">{{$item->month_name}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="year">Rent Year</label>
                        <select class="form-select" id="year" name="year" >
                              <option value="">Select Year</option>
                              @foreach ($year as $item)
                              <option @if(isset($post))  @if($post->year == $item->year_name) selected @endif @endif value="{{$item->year_name}}">{{$item->year_name}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Renter Name</label>
                      <input class="form-control" id="renter_name" value="{{ (isset($post)?$post->renter_name:'')}}" name="renter_name" type="text" aria-describedby="" placeholder="Enter Renter Name">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Rent</label>
                      <input class="form-control" id="rent" value="{{ (isset($post)?$post->rent:'')}}" name="rent" type="text" aria-describedby="" placeholder="Enter Rent">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Water Bill</label>
                      <input class="form-control" id="water_bill" value="{{ (isset($post)?$post->water_bill:'')}}" name="water_bill" type="text" aria-describedby="" placeholder="Enter Water Bill">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Electric Bill</label>
                      <input class="form-control" id="electric_bill" value="{{ (isset($post)?$post->electric_bill:'')}}" name="electric_bill" type="text" aria-describedby="" placeholder="Enter Electric Bill">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Gas Bill</label>
                      <input class="form-control" id="gas_bill" value="{{ (isset($post)?$post->gas_bill:'')}}" name="gas_bill" type="text" aria-describedby="" placeholder="Enter Gas Bill">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Security Bill</label>
                      <input class="form-control" id="security_bill" value="{{ (isset($post)?$post->security_bill:'')}}" name="security_bill" type="text" aria-describedby="" placeholder="Enter Security Bill">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Utility Bill</label>
                      <input class="form-control" id="utility_bill" value="{{ (isset($post)?$post->utility_bill:'')}}" name="utility_bill" type="text" aria-describedby="" placeholder="Enter Utility Bill">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Other Bill</label>
                      <input class="form-control" id="other_bill" value="{{ (isset($post)?$post->other_bill:'')}}" name="other_bill" type="text" aria-describedby="" placeholder="Enter Other Bill">
                    </div>


                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Total Rent</label>
                      <input class="form-control" id="total_rent" value="{{ (isset($post)?$post->total_rent:'')}}" name="total_rent" type="text" aria-describedby="" placeholder="Enter Security Bill">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Issue Date</label>
                      <input class="form-control" id="issue_date" value="{{ (isset($post)?$post->issue_date:'')}}" name="issue_date" type="date" aria-describedby="" placeholder="Enter Issue Date">
                    </div>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Bill Paid Date</label>
                      <input class="form-control" id="bill_paid_date" value="{{ (isset($post)?$post->bill_paid_date:'')}}" name="bill_paid_date" type="date" aria-describedby="" placeholder="Enter Bill Paid Date">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Bill Status</label>
                      <select class="form-select" id="status" name="status" >
                          <option value="">Select</option>
                          <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Due</option>
                          <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Paid</option>
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

