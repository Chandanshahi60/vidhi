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
                    <div class="card-body">
                            <div class=" row text-center">

                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="owner_name">Owner Name</label>
                                <input   class="form-control"   value="{{ isset($post->parking_details)?$post->parking_details->owner_name:''}}"  id="owner_name" name="owner_name" type="text"  aria-describedby="" placeholder="Enter Full Name">
                            </div>



                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="flat_no"> Flat No</label>
                                <input class="form-control" type="number"  value="{{ isset ($post->parking_details)?$post->parking_details->flat_no:''}}"   id="flat_no" name="flat_no" placeholder="Enter Flat No">
                            </div>

                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="vehicle_type">Vehicle Type</label>
                                <input class="form-control" value="{{isset ($post->parking_details)?$post->parking_details->vehicle_type:''}}"  type="text"  id="vehicle_type" name="vehicle_type"  placeholder="Enter Vehicle Type">
                            </div>


                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="rc_number">RC No</label>
                                <input class="form-control" value="{{isset ($post->parking_details)?$post->parking_details->rc_number:''}}" type="text"  id="rc_number" name="rc_number"  placeholder="Enter RC Number">
                            </div>


                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="is_insured">Is Insured</label>
                                <select class="form-select " id="is_insured" name="is_insured" >
                                    <option  @if(isset($post->parking_details)) @if($post->parking_details->is_insured=='Yes') selected @endif @endif value="Yes">Yes</option>
                                    <option  @if(isset($post->parking_details)) @if($post->parking_details->is_insured=='No') selected @endif @endif  value="No">No</option>
                                </select>
                            </div>

                            <div class="mb-3 text-align-left col-md-4">
                                <label class="col-form-label  text-align-left pt-0" for="parking_no">Parking No</label>
                                <input class="form-control" value="{{isset($post->parking_details)?$post->parking_details->parking_no:''}}" type="text"  id="parking_no" name="parking_no"  placeholder="Enter Parking No">
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

