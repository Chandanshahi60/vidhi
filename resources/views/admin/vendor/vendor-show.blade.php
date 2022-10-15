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
                    <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-vendor"></i>Basic Details</a></li>

                  </ul>
                  <div class="tab-content" id="info-tabContent">

                    <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">

                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col" width="200">Vendor Name</th>
                              <th scope="col"  width="500">{{$vendor->name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Vendor Contact Name</th>
                              <th scope="col"  width="500">{{$vendor->contact_name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Vendor Mobile</th>
                              <th scope="col"  width="500">{{$vendor->mobile}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Vendor Email</th>
                              <th scope="col"  width="500">{{$vendor->email}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Notes</th>
                              <th scope="col"  width="500">{{$vendor->notes}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Vendor Mobile</th>
                              <th scope="col"  width="500">{{$vendor->mobile}}</th>
                            </tr>


                            <tr>
                              <th scope="col" width="200">Account Head</th>
                              <th scope="col"  width="500">{{$vendor->account_head}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Start Date</th>
                              <th scope="col"  width="500">{{$vendor->start_date}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">End Date</th>
                              <th scope="col"  width="500">{{$vendor->end_date}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">TDS Rate</th>
                              <th scope="col"  width="500">{{$vendor->tds_rate}}</th>
                            </tr>


                            <tr>
                              <th scope="col" width="200">Service Tax Rate</th>
                              <th scope="col"  width="500">{{$vendor->service_tax_rate}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Service Tax Rate</th>
                              <th scope="col"  width="500">{{$vendor->service_tax_rate}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Service Tax Registration</th>
                              <th scope="col"  width="500">{{$vendor->service_tax_registration}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">GSTIN</th>
                              <th scope="col"  width="500">{{$vendor->gstin}}</th>
                            </tr>

                             <tr>
                              <th scope="col" width="200">GST Rate</th>
                              <th scope="col"  width="250">{{$vendor->cgst_rate}}</th>
                              <th scope="col"  width="250">{{$vendor->gst_rate}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Pan No</th>
                              <th scope="col"  width="500">{{$vendor->pan_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Section Code</th>
                              <th scope="col"  width="500">{{$vendor->section_code}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Vendor Legal Type</th>
                              <th scope="col"  width="500">{{$vendor->legal_type}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Payee Name</th>
                              <th scope="col"  width="500">{{$vendor->payee_name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Billing Address</th>
                              <th scope="col"  width="500">{{$vendor->billing_address}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Bank Account No</th>
                              <th scope="col"  width="500">{{$vendor->account_no}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Bank Branch Name</th>
                              <th scope="col"  width="500">{{$vendor->branch_name}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Bank NEFT/IFSC Code</th>
                              <th scope="col"  width="500">{{$vendor->bank_code}}</th>
                            </tr>

                            <tr>
                              <th scope="col" width="200">Status</th>
                              <th scope="col"  width="500">{!! ($vendor->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
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
