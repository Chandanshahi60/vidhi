@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
.btn-group{
        width: 100%;
}
.multiselect-container{
        width: 100%!important;
        overflow: scroll!important;
        height: 500px!important;
        margin-top: 43%!important;
}
    .multiselect{
        width: 100%;
        text-align: left;
    }
</style>
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
                    {{csrf_field()}}

                    <div class="col-sm-12 col-xl-12">
                    <div class="row">
                      <div class="col-sm-12">

                        <div class="card">
                          <div class="card-body row">

                           	    <div class="form-group">
                                    <label class="form-label">User Type *</label>
                                    <select name="user_type"  id="user_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">User</option>
                                        <option value="2">Vendor</option>
                                    </select>
                                </div>


                               <div class="form-group" id="user_div" style="display:none">
                                   <input type="checkbox" id="select1" name="select1"  placeholder="" />
                                <label class="form-label">Select All</label><br>
                                    <label class="form-label">User Name *</label>
                                    <select name="user_id[]"  multiple data-live-search="true" id="user_id" class="form-control selectbox">
                                        @foreach ($user as $keys=>$item)
                                            <option  value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>



                                 <div class="form-group" id="vendor_div" style="display:none">
                                     <input type="checkbox"  id="select" name="select"  placeholder="" />
                                <label class="form-label">Select All</label><br>
                                    <label class="form-label">Vendor Name *</label>
                                    <select name="vendor_id[]"  multiple data-live-search="true" id="vendor_id" class="form-control selectbox" >
                                        @foreach ($vendor as $keys=>$item)
                                            <option  value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>



                                 <div class="form-group">
                                    <label class="form-label">Title *</label>
                                    <textarea class="form-control" name="title"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description *</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="image">Notification Image</label>
                                    <input class="form-control" id="image" name="image" type="file" placeholder="image">
                                </div>
                            <div class="card-footer"></div>
                                <button type="submit" id="submitButton" class="btn btn-primary float-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending..." data-rest-text="Create">Create</button>
							</div>
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
    <!-- Container-fluid Ends-->
  </div>

@endsection

@section('pagejs')




<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $('.selectbox').selectpicker();
</script>


<script type="text/javascript">


        $(function () {

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
                        successMsg('Create ', data.msg, btn);
                        $('#submitForm')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create ', 'Input Error');
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create Business_category', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>
    <script>

$("#user_type").on('change',function(){


   if( $("#user_type option:selected").val()==1){
     $("#user_div").show();
     $("#vendor_div").hide();
   }
   else{
     $("#user_div").hide();
     $("#vendor_div").show();

   }

});



$("#select1").click(function(){
    if($("#select1").is(':checked') ){
        $("#user_id > option").prop("selected", true);
        $("#user_id").trigger("change");
    }else{
        $("#user_id > option").prop("selected", false);
        $("#user_id").trigger("change")
     }
});

$("#select").click(function(){
    if($("#select").is(':checked') ){
        $("#vendor_id > option").prop("selected", true);
        $("#vendor_id").trigger("change");
    }else{
        $("#vendor_id > option").prop("selected", false);
        $("#vendor_id").trigger("change")
     }
});


    </script>
@stop
