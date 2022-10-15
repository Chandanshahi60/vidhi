@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop
@section('pagecss')

<style>
thead.family{
    border: solid 2px#ccc;
}
</style>
@stop
@section('breadcrum')

@stop
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">

                        <h5>{{ $data['title'] }}</h5>

                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-user"></i>Basic Details</a></li>
                            @if(isset($tenant)?($tenant->tenent_members_details):'')
                                <li class="nav-item"><a class="nav-link" id="info-member-tab" data-bs-toggle="tab" href="#info-member" role="tab" aria-controls="info-member" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Details</a></li>
                            @endif
                            @if(isset($tenant)?($tenant->tenent_members_details):'')
                            @if($tenant->tenent_members_details->family_details->count() > 0)
                                <li class="nav-item"><a class="nav-link" id="info-family-tab" data-bs-toggle="tab" href="#info-family" role="tab" aria-controls="info-family" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Family Details</a></li>
                            @endif
                            @endif
                        </ul>
                        <div class="tab-content" id="info-tabContent">

                                <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th scope="col" width="200">Tenant Name</th>
                                                <th scope="col"  width="500">{{$tenant->tenant_name}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">E-mail</th>
                                                <th scope="col"  width="500">{{$tenant->email}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Contact No</th>
                                                <th scope="col"  width="500">{{$tenant->contact_no}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Address</th>
                                                <th scope="col"  width="500">{{$tenant->address}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Pan Card</th>
                                                <th scope="col"  width="500">{{$tenant->pan}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Aadhar Card</th>
                                                <th scope="col"  width="500">{{$tenant->aadhar}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Floor No</th>
                                                <th scope="col"  width="500">{{$tenant->floor_no}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Unit No</th>
                                                <th scope="col"  width="500">{{$tenant->unit_no}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Advance Rent</th>
                                                <th scope="col"  width="500">{{$tenant->adv_rent}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Start Date</th>
                                                <th scope="col"  width="500">{{$tenant->start_date}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">End Date</th>
                                                <th scope="col"  width="500">{{$tenant->end_date}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Rent Year</th>
                                                <th scope="col"  width="500">{{$tenant->year}}</th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200"style="padding-bottom:50px">Tenant Photo</th>
                                                <th><img style="width:100px;height:100px" src="{{url(''.$tenant->tenant_photo)}}"></th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200"style="padding-bottom:50px">Upload Agreement</th>
                                                <th><img style="width:100px;height:100px" src="{{url(''.$tenant->agreement)}}"></th>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Status</th>
                                                <th scope="col"  width="500">{!! ($tenant->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
                                                </tr>

                                            </thead>
                                        </table>
                                    </div>
                                </div>

                                @if(isset($tenant)?($tenant->tenent_members_details):'')
                                    <div class="tab-pane fade show" id="info-member" role="tabpanel" aria-labelledby="info-member-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                    <th scope="col" width="200">Full Name</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->full_name:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Contact No</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->contact_no:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Address</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->address:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Father Name</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_father_name:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Mother Name</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_mother_name:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Gender</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_gender:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">DOB</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_dob:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Date of Marriage</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_date_of_marrige:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Occupation</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->member_occupation:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Pan Card</th>
                                                    <td scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->pan:''}}</td>
                                                    </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Aadhar Number</th>
                                                    <th scope="col"  width="500">{{ isset($tenant->tenent_members_details)?$tenant->tenent_members_details->aadhar:''}}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                            @if(isset($tenant)?($tenant->tenent_members_details):'')
                                 @if($tenant->tenent_members_details->family_details->count() > 0)
                                    <div class="tab-pane fade show" id="info-family" role="tabpanel" aria-labelledby="info-family-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                            @foreach($tenant->tenent_members_details->family_details as $key=>$vals)
                                                <thead class="family">
                                                    <tr>
                                                    <th scope="col" width="200">Name</th>
                                                    <td scope="col"  width="200">{{$vals->family_name}}</td>

                                                    <th scope="col" width="200">Father Name</th>
                                                    <td scope="col"  width="200">{{$vals->family_father_name}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="col" width="200">Mother Name</th>
                                                        <td scope="col"  width="200">{{$vals->family_mother_name}}</td>

                                                        <th scope="col" width="200">Gender</th>
                                                        <td scope="col"  width="200">{{$vals->family_gender}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="col" width="200">Contact No</th>
                                                        <td scope="col"  width="200">{{$vals->family_contact_no}}</td>

                                                        <th scope="col" width="200">DOB</th>
                                                        <td scope="col"  width="200">{{$vals->family_dob}}</td>
                                                    </tr>

                                                     <tr>
                                                        <th scope="col" width="200">Date of Marriage</th>
                                                        <td scope="col"  width="200">{{$vals->family_marriage}}</td>

                                                        <th scope="col" width="200">Occupation</th>
                                                        <td scope="col"  width="200">{{$vals->family_occupation}}</td>
                                                    </tr>

                                                     <tr>
                                                        <th scope="col" width="200">Pan Card</th>
                                                        <td scope="col"  width="200">{{$vals->pan}}</td>

                                                        <th scope="col" width="200">Aadhar Card</th>
                                                        <td scope="col"  width="200">{{$vals->aadhar}}</td>
                                                    </tr>
                                                </thead>
                                            @endforeach
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                @endif
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
