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
                              <th scope="col" width="200">Floor No</th>
                              <th scope="col"  width="500">{{$owner_utility->floor_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Unit No</th>
                              <th scope="col"  width="500">{{$owner_utility->unit_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Owner Name</th>
                              <th scope="col"  width="500">{{$owner_utility->owner_name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Utility Month</th>
                              <th scope="col"  width="500">{{$owner_utility->month}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Utility Year</th>
                              <th scope="col"  width="500">{{$owner_utility->year}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Water Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->water_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Electric Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->electric_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Gas Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->gas_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Security Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->security_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Utility Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->utility_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Other Bill</th>
                              <th scope="col"  width="500">{{$owner_utility->other_bill}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Total Rent</th>
                              <th scope="col"  width="500">{{$owner_utility->total_rent}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Issue Date</th>
                              <th scope="col"  width="500">{{$owner_utility->issue_date}}</th>
                            </tr>

                             <tr>
                              <th scope="col" width="200">Status</th>
                              <th scope="col"  width="500">{!! ($owner_utility->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
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
