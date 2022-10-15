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
                      <label class="col-form-label pt-0" for="bill_type">Bill Type</label>
                        <select class="form-select" id="bill_type" name="bill_type" >
                              <option value="">Select Bill Type</option>
                              @foreach ($bill_type as $item)
                              <option @if(isset($post))  @if($post->bill_type == $item->bill_type) selected @endif @endif value="{{$item->bill_type}}">{{$item->bill_type}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>
                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Bill Date</label>
                      <input class="form-control" id="bill_date" value="{{ (isset($post)?$post->bill_date:'')}}" name="bill_date" type="date" aria-describedby="" placeholder="Enter Bill Month">
                    </div>



                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="bill_month">Bill Month</label>
                        <select class="form-select" id="bill_month" name="bill_month" >
                              <option value="">Select Month</option>
                              @foreach ($month as $item)
                              <option @if(isset($post))  @if($post->bill_month == $item->month_name) selected @endif @endif value="{{$item->month_name}}">{{$item->month_name}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="year">Bill Year</label>
                        <select class="form-select" id="year" name="year" >
                              <option value="">Select Year</option>
                              @foreach ($year as $item)
                              <option @if(isset($post))  @if($post->year == $item->year_name) selected @endif @endif value="{{$item->year_name}}">{{$item->year_name}}</option>
                              @endforeach
                        </select>
                      {{-- <input class="form-control" id="year" value="{{ (isset($post)?$post->year:'')}}" name="year" type="text" aria-describedby="" placeholder="Enter Floor No"> --}}
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Total Amount</label>
                      <input class="form-control" id="total_amt" value="{{ (isset($post)?$post->total_amt:'')}}" name="total_amt" type="text" aria-describedby="" placeholder="Enter Total amount">
                    </div>

                     <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Deposite Bank Name</label>
                      <input class="form-control" id="deposite_bank_name" value="{{ (isset($post)?$post->deposite_bank_name:'')}}" name="deposite_bank_name" type="text" aria-describedby="" placeholder="Enter deposite bank name">
                    </div>

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Details</label>
                      <input class="form-control" id="details" value="{{ (isset($post)?$post->details:'')}}" name="details" type="text" aria-describedby="" placeholder="Enter details">
                    </div>



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
