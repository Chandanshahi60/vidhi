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
                              <th scope="col" width="200">Entry Date</th>
                              <th scope="col"  width="500">{{$visitors->entry_date}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Name</th>
                              <th scope="col"  width="500">{{$visitors->name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Mobile</th>
                              <th scope="col"  width="500">{{$visitors->mobile}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Mobile</th>
                              <th scope="col"  width="500">{{$visitors->mobile}}</th>
                            </tr>


                            <tr>
                              <th scope="col" width="200">Address</th>
                              <th scope="col"  width="500">{{$visitors->address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Floor No</th>
                              <th scope="col"  width="500">{{$visitors->floor_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Unit No</th>
                              <th scope="col"  width="500">{{$visitors->unit_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">In Time</th>
                              <th scope="col"  width="500">{{$visitors->in_time}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Out Time</th>
                              <th scope="col"  width="500">{{$visitors->out_time}}</th>
                            </tr>

                             <tr>
                              <th scope="col" width="200">Status</th>
                              <th scope="col"  width="500">{!! ($visitors->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
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
