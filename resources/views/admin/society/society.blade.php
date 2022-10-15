@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/datatables.css')}}">


<style>
.aaction{
    display: flex;
    background-color: white;

}
</style>
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
                            <li class="breadcrumb-item">{{ $data['title'] }}</li>
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
                            <th>Society Name</th>
                            <th>Societyc Unique ID</th>
                            <th>Total Flats</th>
                            <th>Phone No</th>
                            <th>E-mail</th>
                            <th>RWA Registration</th>
                            <th>Total Family</th>
                            <th style="display:revert !important">Action</th>
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


@stop
@section('pagejs')
<script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/datatable/datatables/datatable.custom.js')}}"></script>


    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                columnDefs: [
                    {
                  @if(Auth()->guard('admin')->user()->hasRole('Super Admin'))
                    targets: 8,
                    className: 'aaction'
                  @else
                  targets: 7,
                  className: 'aaction'
                  @endif
                },

                ],
                ajax: "{{ $data['url'] }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'society_name', name: 'society_name'},
                    {data: 'society_unique_id', name: 'society_unique_id'},
                    {data: 'total_flats', name: 'total_flats'},
                    {data: 'emergency_contact_no', name: 'emergency_contact_no'},
                    {data: 'email', name: 'email'},
                    {data: 'rwa_registration', name: 'rwa_registration'},
                    {data: 'no_of_families', name: 'no_of_families'},
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
