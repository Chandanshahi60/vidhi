@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')

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
                      <label class="col-form-label pt-0" for="title">Name</label>
                      <input class="form-control" id="name" name="name" required type="text" aria-describedby="" placeholder="Enter Name">
                    </div>

                    <div class="col">
                        <div class="form-group m-t-15 m-checkbox-inline mb-0">
                          
                          <div class="checkbox checkbox-dark">
                              <input id="permisssion-all" class="checkallcheckbox" type="checkbox">
                              <label for="permisssion-all">All</label>
                          </div>

                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]" value="Create" id="permisssion-create"  class="permissioncheckbox" type="checkbox">
                            <label for="permisssion-create">Create</label>
                          </div>

                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]" value="List" id="permisssion-list"  class="permissioncheckbox" type="checkbox">
                            <label for="permisssion-list">List</label>
                          </div>

                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]" value="View" id="permisssion-view"  class="permissioncheckbox" type="checkbox">
                            <label for="permisssion-list">View</label>
                          </div>

                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]" value="Edit" id="permisssion-edit"  class="permissioncheckbox" type="checkbox">
                            <label for="permisssion-edit">Edit</label>
                          </div>
                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]"  value="Update" id="permisssion-update"  class="permissioncheckbox" type="checkbox">
                            <label for="permisssion-update">Update</label>
                          </div>

                          <div class="checkbox checkbox-dark">
                            <input name="permissions[]" value="Delete"  id="permisssion-delete" class="permissioncheckbox"  type="checkbox">
                            <label for="permisssion-delete">Delete</label>
                          </div>

                        </div>
                    </div>
                    
                </div>

                  
                
                <div class="card-footer">
                  <button  id="submitButton" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>
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

<script type="text/javascript">

  $(".checkallcheckbox").click(function(){
    
      var is_checked = $(this).prop("checked");
      
      //console.log(is_checked);

      $.each($(".permissioncheckbox"),function(){
          if(is_checked){
            $(this).prop("checked",true);
          }
          else{
            $(this).prop("checked",false);
          }
      });

  });

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
                        successMsg('Create Permission', data.msg);
                      

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create Permission', 'Input Error');
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create Permission', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>
@stop
