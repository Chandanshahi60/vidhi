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
                              <th scope="col"  width="500">{{$building->name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Email</th>
                              <th scope="col"  width="500">{{$building->email}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Contact No</th>
                              <th scope="col"  width="500">{{$building->contact_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Security Guard Mobile No</th>
                              <th scope="col"  width="500">{{$building->security_guard_mobile}}</th>
                            </tr>

                             <tr>
                              <th scope="col" width="200">Secretary Mobile No</th>
                              <th scope="col"  width="500">{{$building->secretary_mobile}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Moderator Mobile No</th>
                              <th scope="col"  width="500">{{$building->moderator_mobile}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Building Construction Year</th>
                              <th scope="col"  width="500">{{$building->building_construction_year}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Address</th>
                              <th scope="col"  width="500">{{$building->address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Building Image</th>
                              <th scope="col"  width="500"><img style="width:100px;height:100px" src="{{asset($building->photo)}}"></th>
                            </tr>

                             <tr>
                              <th scope="col" width="200">Status</th>
                              <th scope="col"  width="500">{!! ($building->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Company Name</th>
                              <th scope="col"  width="500">{{$building->company_name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Company Phone No</th>
                              <th scope="col"  width="500">{{$building->company_mobile}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Company Address</th>
                              <th scope="col"  width="500">{{$building->company_address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Apartment Rules</th>
                              <th scope="col"  width="500">{{$building->apartment_rules}}</th>
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
