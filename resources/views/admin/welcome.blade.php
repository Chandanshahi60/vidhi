@extends('admin.layout.main')

@section('title')
    <title>Dashboard</title>
@stop

@section('inlinecss')

@stop

@section('breadcrumbs')

@stop

@section('content')


<div class="page-body dashboard-2-main">


   {{-- <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item">dashboard</li>
            </ol>
          </div>
        </div>
      </div>
   </div> --}}

   <div class="card-body">
      <div class="app-content">
         <div class="side-app">
            <!-- ROW-2 OPEN -->
            <div class="row">

               <div class=" col-md-12 col-lg-12 col-xl-12">
                  <div class="row">

                     <!-- <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('unit-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Unit</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/room.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$unit}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->

                      <!-- <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('tenant-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Tenent</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/tenant.jpg')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$tenent}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->


                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('owner-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Member</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/owner.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$owner}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('banner-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Banner</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/banner.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$service}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('plan-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Subscription</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/membership.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$employee}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('event-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Event</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/event.jpg')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$employee}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                     <!-- <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('visitors-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Visitors</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/visitors.jpg')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">{{$visitors}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->

                      <!--   @php
                           $total_rent = 0;
                            foreach ($rent as $val){
                                $total_rent+=$val->total_rent;
                            }
                        @endphp
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('rent-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Total Rent</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/rent.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹{{$total_rent}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->

                        <!-- @php
                           $total_utility = 0;
                            foreach ($owner_utility as $val){
                                $total_utility+=$val->total_rent;
                            }
                        @endphp

                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('owner_utility-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Owner Utility</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/cash.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹{{$total_utility}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->

                        <!-- @php
                           $maintainance = 0;
                            foreach ($maintenance_cost as $val){
                                $maintainance+=$val->amount;
                            }
                        @endphp
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('maintenanceCost-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Total Maintainance Cost</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/maintenance.png')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹{{$maintainance}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->

                        <!-- @php
                           $total_fund = 0;
                            foreach ($fund as $val){
                                $total_fund+=$val->total_amt;
                            }
                        @endphp
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="{{route('fund-list')}}"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Total Fund</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/fund.jpg')}}">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹{{$total_fund}}</h2>
                              </div>
                           </div>
                        </div></a>
                     </div> -->


                      {{-- <div class="col-sm-12 col-lg-4 col-md-4 ">
                         <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;" >Help Desk</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="{{asset('admin/assets/images/information.png')}}">
                                 <h6 class="mb-1 number-font" style="padding-left: 15px">{{$society->society_name}}</h6>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


</div>


<!-- View MODAL -->
    <div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- View CLOSED -->



@section('pagejs')

<script>

    $(".viewDetail").click(function(){
        $('#viewDetail').modal('show');
        url = $(this).attr('data-url');
        $('#viewDetail').find('.modal-body').html('<p class="ploading"><i class="fa fa-spinner fa-spin"></i></p>')
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data){
                $('#viewDetail').find('.modal-body').html(data);
            }
        });
    });

</script>
@stop


@endsection


