@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop
@section('inlinecss')

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



                <div class="card-header pb-0">

                    <h5>{{ $data['title'] }}</h5>

                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true">Basic Details</a></li>

                  </ul>
                  <div class="tab-content" id="info-tabContent">

                    <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">

                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col" width="200">Name</th>
                              <th scope="col"  width="500">{{$employee->name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Email</th>
                              <th scope="col"  width="500">{{$employee->email}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Contact No</th>
                              <th scope="col"  width="500">{{$employee->contact_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Present Address</th>
                              <th scope="col"  width="500">{{$employee->present_address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Permanent Address</th>
                              <th scope="col"  width="500">{{$employee->permanent_address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Aadhar</th>
                              <th scope="col"  width="500">{{$employee->aadhar}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Pan</th>
                              <th scope="col"  width="500">{{$employee->pan}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Designation</th>
                              <th scope="col"  width="500">{{$employee->designation}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Joining Date</th>
                              <th scope="col"  width="500">{{$employee->joining_date}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Ending Date</th>
                              <th scope="col"  width="500">{{$employee->ending_date}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200"style="padding-bottom:50px">Employee Photo</th>
                              <th><img style="width:100px;height:100px" src="{{url('',$employee->photo)}}"></th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Status</th>
                              <th scope="col"  width="500">{!! ($employee->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
                            </tr>


                          </thead>

                        </table>
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
@stop
@section('pagejs')


<script>



</script>
@stop
