<header class="main-nav">
          {{-- <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('admin/assets/images/dashboard/1.png')}}" alt="">
            <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="{{route('admin.login')}}">
              <h6 class="mt-3 f-14 f-w-600">{{Auth::guard("admin")->user()->name}}</h6></a>
            <p class="mb-0 font-roboto">{{Auth::guard("admin")->user()->name}}</p>
              @php
                $roles = Auth::guard('admin')->user()->roles->pluck('name');

              @endphp
            {!! $roles !!} --}}
            {{-- <ul>
              <li><span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
              </li>
              <li><span>2 year</span>
                <p>Experince</p>
              </li>
              <li><span><span class="counter">95.2</span>k</span>
                <p>Follower </p>
              </li>
            </ul> --}}
          {{-- </div> --}}
          <style>
          .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu {
            border-radius: 0;
            height: calc(144vh - 441px);
            left: -300px;
            z-index: 99;
            -webkit-transition: color 1s ease;
            transition: color 1s ease;
            overflow: hidden;
            overflow-y: auto;
            color: rgba(0, 0, 0, 0);
            padding-bottom: 15px;
            }
          </style>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">

                <ul class="nav-menu custom-scrollbar">

                  <li class="sidebar-main-title"></li>


                  <li class="dropdown"><a class="nav-link menu-title active" href="{{route('admin.dashboard')}}"><i data-feather="box"></i><span>Dashboard</span></a>
                  </li>


                  @can('User Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="user"></i><span>User</span></a>
                      <ul class="nav-submenu menu-content">
                          @can('User Create')
                            <li><a href="{{route('user-create')}}" class="  ">Create User</a></li>
                          @endcan

                          @can('User List')
                          <li><a href="{{route('user-list')}}">List User</a></li>
                          @endcan
                      </ul>
                  </li>
                @endcan

                  <!-- @can('Role Master')
                    <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="box"></i><span>Role & Permission</span></a>
                        <ul class="nav-submenu menu-content">

                            @can('Role Create')
                              <li><a href="{{route('role-create')}}" class="  ">Create Role</a></li>
                            @endcan

                            @can('Role List')
                            <li><a href="{{route('role-list')}}">List Role</a></li>
                            @endcan

                        </ul>
                    </li>
                  @endcan -->

                  <!-- @can('Service Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Service</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Service Create')
                        <li><a href="{{route('service-create')}}" class="  ">Create Service</a></li>
                      @endcan

                      @can('Service List')
                      <li><a href="{{route('service-list')}}">List Service</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan -->

                  <!-- @can('Vendor Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Vendor</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Vendor Create')
                        <li><a href="{{route('vendor-create')}}" class="  ">Create Vendor</a></li>
                      @endcan

                      @can('Vendor List')
                      <li><a href="{{route('vendor-list')}}">List Vendor</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan -->


                  <!-- @can('Service Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Expenses Record</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Expenses Record List')
                        <li><a href="{{route('expenses_record-create')}}" class="  ">Create Expenses Record</a></li>
                      @endcan

                      @can('Expenses Record List')
                      <li><a href="{{route('expenses_record-list')}}">List Expenses Record</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan -->

                   <!-- @can('Social Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Social Connects</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Social Create')
                        <li><a href="{{route('social-create')}}" class="  ">Create Social</a></li>
                      @endcan

                      @can('Social List')
                      <li><a href="{{route('social-list')}}">List Social</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan -->


                  <!-- @can('Floor Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Floor Informaition</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Floor Create')
                        <li><a href="{{route('floor-create')}}" class="  ">Create Floor</a></li>
                      @endcan

                      @can('Floor List')
                      <li><a href="{{route('floor-list')}}">List Floor</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan -->


                <!-- @can('Unit Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Unit Information</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Unit Create')
                        <li><a href="{{route('unit-create')}}" class="  ">Create Unit</a></li>
                      @endcan

                      @can('Unit List')
                      <li><a href="{{route('unit-list')}}">List Unit</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                @can('Owner Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Member Information</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Owner Create')
                        <li><a href="{{route('owner-create')}}" class="  ">Create Member  </a></li>
                      @endcan

                      @can('Owner List')
                      <li><a href="{{route('owner-list')}}">List Member </a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan


                <!-- @can('Tenant Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Tenant Information</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Tenant Create')
                        <li><a href="{{route('tenantinfo-create')}}" class="  ">Create Tenant</a></li>
                      @endcan

                      @can('Tenant List')
                      <li><a href="{{route('tenantinfo-list')}}">List Tenant</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->

                 {{-- @can('Tenant Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Tenant Information</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Tenant Create')
                        <li><a href="{{route('tenant-create')}}" class="  ">Create Tenant</a></li>
                      @endcan

                      @can('Tenant List')
                      <li><a href="{{route('tenant-list')}}">List Tenant</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan --}}


                <!-- @can('Settings Master')
                  <li class="mega-menu">
                    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Employee Information</span></a>
                    <div class="mega-menu-container menu-content">
                      <div class="container">
                        <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Employee</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('employee-create')}}">Create Employee</a></li>
                                  <li><a href="{{route('employee-list')}}">List Employee</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Employee Salary</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('employee_salary-create')}}">Create Employee Salary</a></li>
                                  <li><a href="{{route('employee_salary-list')}}">List Employee Salary</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Employee Leave Request</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('employee_leave-list')}}">List Employee Leave</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                @endcan -->





                <!-- @can('Rent Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Rent Collection</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Rent Create')
                        <li><a href="{{route('rent-create')}}" class="  ">Create Rent</a></li>
                      @endcan

                      @can('Rent List')
                      <li><a href="{{route('rent-list')}}">List Rent</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->

                 <!-- @can('Utility Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Owner Utility</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Utility Create')
                        <li><a href="{{route('owner_utility-create')}}" class="  ">Create Owner Utility</a></li>
                      @endcan

                      @can('Utility List')
                      <li><a href="{{route('owner_utility-list')}}">List Owner Utility</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                 <!-- @can('Utility Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Maintenance Cost</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Utility Create')
                        <li><a href="{{route('maintenanceCost-create')}}" class="  ">Create Maintenance Cost</a></li>
                      @endcan

                      @can('Utility List')
                      <li><a href="{{route('maintenanceCost-list')}}">List Maintenance Cost</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                <!-- @can('ManagementCommittee Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Management Committee</span></a>
                    <ul class="nav-submenu menu-content">
                      @can('ManagementCommittee Create')
                        <li><a href="{{route('management_committee-create')}}" class=" ">Create Management Committee</a></li>
                      @endcan

                      @can('ManagementCommittee List')
                      <li><a href="{{route('management_committee-list')}}">List Management Committee</a></li>
                      @endcan

                      @can('ManagementCommittee Group Create')
                        <li><a href="{{route('management_committee-group_create')}}" class=" ">Create Committee Group</a></li>
                      @endcan
                    </ul>
                  </li>
                @endcan -->


                 <!-- @can('Fund Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Apartment Fund</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Fund Create')
                        <li><a href="{{route('fund-create')}}" class="  ">Create Fund</a></li>
                      @endcan

                      @can('Fund List')
                      <li><a href="{{route('fund-list')}}">List Fund</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                   <!-- @can('Bill Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Bill Deposite</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Bill Create')
                        <li><a href="{{route('bill-create')}}" class="  ">Create Bill</a></li>
                      @endcan

                      @can('Bill List')
                      <li><a href="{{route('bill-list')}}">List Bill</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->



                <!-- @can('Complain Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Complain</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Complain Create')
                        <li><a href="{{route('complain-create')}}" class="  ">Create Complain</a></li>
                      @endcan

                      @can('Complain List')
                      <li><a href="{{route('complain-list')}}">List Complain</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                <!-- @can('Visitors Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Visitors</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Visitors Create')
                        <li><a href="{{route('visitors-create')}}" class="  ">Create Visitors</a></li>
                      @endcan

                      @can('Visitors List')
                      <li><a href="{{route('visitors-list')}}">List Visitors</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->


                 <!-- @can('Meeting Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Meeting</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Meeting Create')
                        <li><a href="{{route('meeting-create')}}" class="  ">Create Meeting</a></li>
                      @endcan

                      @can('Meeting List')
                      <li><a href="{{route('meeting-list')}}">List Meeting</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan -->

                <!-- @can('Notifications Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Notifications</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Notifications Create')
                        <li><a href="{{route('notification-create')}}" class="  ">Create Notifications</a></li>
                      @endcan

                      {{-- @can('Notifications List')
                      <li><a href="{{route('notifications-list')}}">List Notifications</a></li>
                      @endcan --}}

                    </ul>
                  </li>
                @endcan -->

                @can('Event Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Events</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Event Create')
                        <li><a href="{{route('event-create')}}" class="  ">Create Events</a></li>
                      @endcan

                      @can('Event List')
                      <li><a href="{{route('event-list')}}">List Events</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan


                @can('Event Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Subscription Plans </span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Event Create')
                        <li><a href="{{route('plan-create')}}" class="  ">Create Subscription</a></li>
                      @endcan

                      @can('Event List')
                      <li><a href="{{route('plan-list')}}">Subscription List </a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan


                @can('Banner Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Banner</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Event Create')
                        <li><a href="{{route('banner-create')}}" class="  ">Banner Creates</a></li>
                      @endcan

                      @can('Event List')
                      <li><a href="{{route('banner-list')}}">List Banner</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan


                @can('Currency Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Country Setup</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Event Create')
                        <li><a href="{{route('country-create')}}" class="  ">Add Country Setup</a></li>
                      @endcan

                      @can('Event List')
                      <li><a href="{{route('country-list')}}">List Country Setup</a></li>
                      @endcan

                    </ul>
                  </li>
                @endcan


                {{-- @can('Currency Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Country Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('currency-create')}}">Add Country Setup</a></li>
                                    <li><a href="{{route('currency-list')}}">List Country Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan --}}


                <!-- @can('Banner Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Banner</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('banner-create')}}">Banner Create</a></li>
                                    <li><a href="{{route('banner-list')}}">List Banner</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                <!-- @can('Settings Master')
                  <li class="mega-menu">
                    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Notice Board</span></a>
                    <div class="mega-menu-container menu-content">
                      <div class="container">
                        <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Notice</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('owner_notice-create')}}">Create Notice</a></li>
                                  <li><a href="{{route('owner_notice-list')}}">List Notice</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Employee Notice</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('employee_notice-create')}}">Create Employee Notice</a></li>
                                  <li><a href="{{route('employee_notice-list')}}">List Employee Notice</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col mega-box">
                            <div class="link-section">
                              <div class="submenu-title">
                                <h5>Owner Notice</h5>
                              </div>
                              <div class="submenu-content opensubmegamenu">
                                <ul>
                                  <li><a href="{{route('owner_notice-create')}}">Create Owner Notice</a></li>
                                  <li><a href="{{route('owner_notice-list')}}">List Owner Notice</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </li>
                @endcan -->



                  {{-- @can('Society Master')
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Society</span></a>

                    <ul class="nav-submenu menu-content">
                      @can('Society Create')
                        <li><a href="{{route('society-create')}}" class="  ">Create Society</a></li>
                      @endcan

                      @can('Society List')
                      <li><a href="{{route('society-list')}}">List Society</a></li>
                      @endcan

                    </ul>
                  </li>
                  @endcan  --}}



@can('Settings Master')
                  <li class="mega-menu">
                    <!-- <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Settings</span></a> -->
                    <div class="mega-menu-container menu-content">
                      <div class="container">
                        <!-- @can('Settings Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Society</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('society-create')}}">Add Society</a></li>
                                    <li><a href="{{route('society-list')}}">List Society</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        

                        <!-- @can('Admin Setup Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Admin Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('admin_setup-create')}}">Add Admin Setup</a></li>
                                    <li><a href="{{route('admin_setup-list')}}">List Admin Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        <!-- @can('Building Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Building</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('building-create')}}">Add Building</a></li>
                                    <li><a href="{{route('building-list')}}">List Building</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        <!-- @can('Bill Type Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Bill Type</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('bill_type-create')}}">Add Bill Type</a></li>
                                    <li><a href="{{route('bill_type-list')}}">List Bill Type</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        <!-- @can('Utility Bill Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Utility Bill</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('utility_bill-create')}}">Add Utility Bill</a></li>
                                    <li><a href="{{route('utility_bill-list')}}">List Utility Bill</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        <!-- @can('Management Member Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Management Member Type</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('management_member-create')}}">Add Management Member</a></li>
                                    <li><a href="{{route('management_member-list')}}">List Management Member</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan  -->

                        <!-- @can('Month Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Month Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('month-create')}}">Add Month Setup</a></li>
                                    <li><a href="{{route('month-list')}}">List Month Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                        <!-- @can('Year Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Year Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('year-create')}}">Add Year Setup</a></li>
                                    <li><a href="{{route('year-list')}}">List Year Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->

                      {{--   <!-- @can('Currency Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Currency Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('currency-create')}}">Add Currency Setup</a></li>
                                    <li><a href="{{route('currency-list')}}">List Currency Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan --> --}}

                       

                        <!-- @can('Service Admin Master')
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Service Admin</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="{{route('service_admin-create')}}">Service Admin Create</a></li>
                                    <li><a href="{{route('service_admin-list')}}">List Service Admin</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        @endcan -->


                      </div>
                    </div>
                  </li>

@endcan



            </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
