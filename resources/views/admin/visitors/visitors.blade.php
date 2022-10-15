@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/datatables.css')}}">
@stop
@section('breadcrum')

@stop
@section('content')


<div class="page-body">
    <div class="container-fluid">
        <div class="row">
          <!-- Zero Configuration  Starts-->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">

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

              </div>
              <div class="card-body">
                <div class="table-responsive">

                    <table class="display data-table" >
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Entry Date</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Floor No</th>
                            <th>Unit No</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
</div>


 <div class="modal fade " id="viewOuttimeDetail" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form id="updateouttime"  method="post" action="">
            @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Update</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
              </div>

              <div class="modal-body">

                   <div class="mb-3 out_time">
                    <label class="col-form-label" for="message-text">Out Time:</label>
                    <input type="time" name="out_time" id="out_time" class="form-control"/>
                  </div>

              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" id="updateouttime-button" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Updating..." data-rest-text="Update" type="submit" data-bs-original-title="" title="">Update</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title="" title="">Close</button>
              </div>
          </form>
        </div>
      </div>
    </div>


@stop
@section('pagejs')
    <script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/datatable/datatables/datatable.custom.js')}}"></script>

    <script>
        $(document).on('click','.updateouttimeButton', function(){
                $('#viewOuttimeDetail').modal('show');
                url = $(this).attr('data-url');
                $("#updateouttime").attr('action',url);
            });


            $('#updateouttime').submit(function(){
            var $this = $('#updateouttime-button');
            buttonLoading('loading', $this);
            $('.is-invalid').removeClass('is-invalid state-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                url: $('#updateouttime').attr('action'),
                type: "POST",
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: new FormData($('#updateouttime')[0]),
                success: function(data) {
                    if(data.status){

                        successMsg('Password', data.msg);

                         $('#updateouttime')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
                        errorMsg('Password',data.msg);
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Password', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });


    </script>

    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ $data['url'] }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'entry_date', name: 'entry_date'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'address', name: 'address'},
                    {data: 'floor.title', name: 'floor.title'},
                    {data: 'unit.unit_no', name: 'unit.unit_no'},
                    {data: 'in_time', name: 'in_time'},
                    {data: 'out_time', name: 'out_time'},
                    {data: 'action', name: 'action', orderable: false, searchable: false,},
                ]
            });



			$(document).on('click','.deleteButton', function(){

                 var con = confirm("Are You Sure Want to Delete This List");

                if(con)
                {
                    row = $(this).closest('tr');
                    url = $(this).attr('data-url');
                    var $this = $(this);
                    buttonLoading('loading', $this);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data){
                            row.remove();
                        }
                    });
                }
            });


        });
    </script>
@stop
