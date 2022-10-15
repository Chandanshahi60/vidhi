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
        <div class="col-sm-12 col-xl-12">
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                @csrf
              <div class="card">
                {{-- <div class="card-header pb-0">
                  <h5>Default Form Layout</h5><span>Using the <a href="#">card</a> component, you can extend the default collapse behavior to create an accordion.</span>
                </div> --}}
                <div class="card-body">

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Name *</label>
                      <input class="form-control" id="name" name="name" type="text" aria-describedby="" placeholder="Enter Name">
                    </div>
                    {{-- <div class="mb-3">
                      <label class="col-form-label pt-0" for="title">Permission *</label>
                      <select class="form-control"  name="permission[]" id="permission" multiple="multiple">
                        @foreach($permission as $p)
                      
                          <option value="{{$p->id}}">{{$p->name}}</option>
                        @endforeach
                    </select>
                    </div> --}}


                    <table class="display table data-table" >
                      <thead>
                        <tr>
                          <th style="width:100px;">
                            <div class="checkbox checkbox-primary">
                              <input id="select-all" type="checkbox">
                              <label for="select-all"> </label>
                            </div>
                          
                          </th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        
                        @foreach ($permission as $key=>$vals)
                          <tr >
                            <th style="vertical-align: middle;width:100px;" rowspan="{{count($vals->child_permission)+1}}">
                            

                              <div class="checkbox checkbox-primary">
                                <input onclick="setAllChildren(this)"  name="permission[]"  value="{{$vals->id}}" id="Primary{{$vals->id}}" type="checkbox">
                                <label for="Primary{{$vals->id}}"> </label>
                              </div>
                            
                            </th>

                            <th style="vertical-align: middle;" rowspan="{{count($vals->child_permission)+1}}">
                              {{$vals->name}}
                            </th>
                           
                            @foreach($vals->child_permission as $key=>$valsd)
                            <tr>
                              <td >
                                
                                <div class="checkbox checkbox-primary">
                                  <input   name="permission[]"  value="{{$valsd->id}}" id="Children{{$valsd->id}}" class="childrens{{$vals->id}}" type="checkbox">
                                  <label for="Children{{$valsd->id}}"> {{$valsd->name}} </label>
                                </div>

                              </td>
                            </tr>
                            @endforeach

                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                </div>
                <div class="card-footer">
                  <button id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>

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

$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
}); 

  function setAllChildren(thisOBJ){
    
      var childrenID =  $(thisOBJ).val();
      

      $.each($(".childrens"+childrenID),function(key,val){
  
        if($(thisOBJ).prop("checked")){
            $(this).prop("checked",true);
        }
        else{
          $(this).prop("checked",false);          
        }

      })
  }
  
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
                        successMsg('Create Role', data.msg);
                        $('#submitForm')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create Role', 'Input Error');
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create Role', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>
@stop
