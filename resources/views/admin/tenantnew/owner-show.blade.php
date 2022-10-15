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
                            @if(isset($owner)?($owner->society_members_details):'')
                                <li class="nav-item"><a class="nav-link" id="info-member-tab" data-bs-toggle="tab" href="#info-member" role="tab" aria-controls="info-member" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Details</a></li>
                            @endif
                            @if(isset($owner)?($owner->society_members_details):'')
                                @if($owner->society_members_details->family_details->count() > 0)
                                    <li class="nav-item"><a class="nav-link" id="info-family-tab" data-bs-toggle="tab" href="#info-family" role="tab" aria-controls="info-family" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Family Details</a></li>
                                @endif
                            @endif
                            @if(isset($owner)?($owner->committe_details):'')
                                <li class="nav-item"><a class="nav-link" id="info-committee-tab" data-bs-toggle="tab" href="#info-committee" role="tab" aria-controls="info-committee" aria-selected="true"><i class="icofont icofont-ui-user"></i>Committee Details</a></li>
                            @endif

                            @if($owner->nominee_details->count() > 0)
                                    <li class="nav-item"><a class="nav-link" id="info-nominee-tab" data-bs-toggle="tab" href="#info-nominee" role="tab" aria-controls="info-nominee" aria-selected="true"><i class="icofont icofont-ui-user"></i>Nominee Details</a></li>
                            @endif
                        </ul>
                        <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th scope="col" width="200">Owner Name</th>
                                            <td scope="col"  width="500">{{$owner->owner_name}}</td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Email</th>
                                            <td scope="col"  width="500">{{$owner->email}}</td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Contact No</th>
                                            <td scope="col"  width="500">{{$owner->contact_no}}</td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Present Address</th>
                                            <td scope="col"  width="500">{{$owner->present_address}}</td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Permanent Address</th>
                                            <td scope="col"  width="500">{{$owner->permanent_address}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Pan Card</th>
                                                <td scope="col"  width="500">{{$owner->pan}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Aadhar Card</th>
                                                <td scope="col"  width="500">{{$owner->aadhar}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Owner Unit</th>
                                                <td scope="col"  width="500">{{$owner->owner_unit}}</td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200"style="padding-bottom:50px">Owner Photo</th>
                                            <th><img style="width:100px;height:100px" src="{{url(''.$owner->owner_photo)}}"></th>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Status</th>
                                            <th scope="col"  width="500">{!! ($owner->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            @if(isset($owner)?($owner->society_members_details):'')
                                <div class="tab-pane fade show" id="info-member" role="tabpanel" aria-labelledby="info-member-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th scope="col" width="200">Full Name</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->flat_no:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Full Name</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->full_name:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Contact No</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->contact_no:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Type of Property</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->property_type:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Address</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->address:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Father Name</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_father_name:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Mother Name</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_mother_name:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Gender</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_gender:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">DOB</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_dob:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Date of Marriage</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_date_of_marrige:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Occupation</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->member_occupation:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Pan Card</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->pan:''}}</td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Aadhar Number</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->aadhar:''}}</td>
                                                </tr>

                                                {{-- <tr>
                                                <th scope="col" width="200">Property Owned</th>
                                                <td scope="col"  width="500">{{ isset($owner->society_members_details)?$owner->society_members_details->property_owned:''}}</td>
                                                </tr> --}}

                                                <tr>
                                                <th scope="col" width="200">Property Owned</th>
                                                <td scope="col"  width="500">{!! ($owner->society_members_details->property_owned =='1')?'<span class="badge badge-success"> Yes </span>':'<span class="badge badge-danger"> No </span>' !!}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if(isset($owner)?($owner->society_members_details):'')
                                @if($owner->society_members_details->family_details->count() > 0)
                                <div class="tab-pane fade show" id="info-family" role="tabpanel" aria-labelledby="info-family-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                        @foreach($owner->society_members_details->family_details as $key=>$vals)
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


                            @if(isset($owner)?($owner->committe_details):'')
                                <div class="tab-pane fade show" id="info-committee" role="tabpanel" aria-labelledby="info-committee-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="200">Committee Name</th>
                                                    <td scope="col"  width="500">{{ (isset($owner->committe_details)?$owner->committe_details->name:'')}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Designation</th>
                                                    <td scope="col"  width="500">{{ (isset($owner->committe_details)?$owner->committe_details->designation:'')}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Contact No</th>
                                                    <td scope="col"  width="500">{{ (isset($owner->committe_details)?$owner->committe_details->phone:'')}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Joining date</th>
                                                    <td scope="col"  width="500">{{ (isset($owner->committe_details)?$owner->committe_details->joining_date:'')}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Ending date</th>
                                                    <td scope="col"  width="500">{{ (isset($owner->committe_details)?$owner->committe_details->ending_date:'')}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Committee Photo</th>
                                                    <td><img style="width:100px;height:100px" src="{{url(''.$owner->committe_details->photo)}}"></td>

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            @endif


                            @if($owner->nominee_details->count() > 0)
                                <div class="tab-pane fade show" id="info-nominee" role="tabpanel" aria-labelledby="info-nominee-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                        @foreach($owner->nominee_details as $key=>$vals)
                                            <thead class="family">
                                                 <tr>
                                                    <th scope="col" width="300">Nominating Person Name</th>
                                                    <td scope="col"  width="400">{{$vals->nominator_name}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="300">Nominated Person Name</th>
                                                    <td scope="col"  width="400">{{$vals->nominated_name}}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="300">Percentage</th>
                                                    <td scope="col"  width="400">{{ $vals->percentage}}</td>
                                                </tr>

                                            </thead>
                                        @endforeach
                                        </table>
                                    </div>
                                </div>
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
