<header class="main-nav">
          
            
          
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


                  <li class="dropdown"><a class="nav-link menu-title active" href="<?php echo e(route('admin.dashboard')); ?>"><i data-feather="box"></i><span>Dashboard</span></a>
                  </li>


                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="user"></i><span>User</span></a>
                      <ul class="nav-submenu menu-content">
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User Create')): ?>
                            <li><a href="<?php echo e(route('user-create')); ?>" class="  ">Create User</a></li>
                          <?php endif; ?>

                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User List')): ?>
                          <li><a href="<?php echo e(route('user-list')); ?>">List User</a></li>
                          <?php endif; ?>
                      </ul>
                  </li>
                <?php endif; ?>

                  <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role Master')): ?>
                    <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="box"></i><span>Role & Permission</span></a>
                        <ul class="nav-submenu menu-content">

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role Create')): ?>
                              <li><a href="<?php echo e(route('role-create')); ?>" class="  ">Create Role</a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role List')): ?>
                            <li><a href="<?php echo e(route('role-list')); ?>">List Role</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                  <?php endif; ?> -->

                  <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Service Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Service</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Service Create')): ?>
                        <li><a href="<?php echo e(route('service-create')); ?>" class="  ">Create Service</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Service List')): ?>
                      <li><a href="<?php echo e(route('service-list')); ?>">List Service</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                  <?php endif; ?> -->

                  <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vendor Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Vendor</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vendor Create')): ?>
                        <li><a href="<?php echo e(route('vendor-create')); ?>" class="  ">Create Vendor</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vendor List')): ?>
                      <li><a href="<?php echo e(route('vendor-list')); ?>">List Vendor</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                  <?php endif; ?> -->


                  <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Service Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Expenses Record</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Expenses Record List')): ?>
                        <li><a href="<?php echo e(route('expenses_record-create')); ?>" class="  ">Create Expenses Record</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Expenses Record List')): ?>
                      <li><a href="<?php echo e(route('expenses_record-list')); ?>">List Expenses Record</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                  <?php endif; ?> -->

                   <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Social Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Social Connects</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Social Create')): ?>
                        <li><a href="<?php echo e(route('social-create')); ?>" class="  ">Create Social</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Social List')): ?>
                      <li><a href="<?php echo e(route('social-list')); ?>">List Social</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                  <?php endif; ?> -->


                  <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Floor Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Floor Informaition</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Floor Create')): ?>
                        <li><a href="<?php echo e(route('floor-create')); ?>" class="  ">Create Floor</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Floor List')): ?>
                      <li><a href="<?php echo e(route('floor-list')); ?>">List Floor</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                  <?php endif; ?> -->


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Unit Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Unit Information</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Unit Create')): ?>
                        <li><a href="<?php echo e(route('unit-create')); ?>" class="  ">Create Unit</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Unit List')): ?>
                      <li><a href="<?php echo e(route('unit-list')); ?>">List Unit</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Owner Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Member Information</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Owner Create')): ?>
                        <li><a href="<?php echo e(route('owner-create')); ?>" class="  ">Create Member  </a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Owner List')): ?>
                      <li><a href="<?php echo e(route('owner-list')); ?>">List Member </a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?>


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tenant Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Tenant Information</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tenant Create')): ?>
                        <li><a href="<?php echo e(route('tenantinfo-create')); ?>" class="  ">Create Tenant</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Tenant List')): ?>
                      <li><a href="<?php echo e(route('tenantinfo-list')); ?>">List Tenant</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->

                 


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Settings Master')): ?>
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
                                  <li><a href="<?php echo e(route('employee-create')); ?>">Create Employee</a></li>
                                  <li><a href="<?php echo e(route('employee-list')); ?>">List Employee</a></li>
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
                                  <li><a href="<?php echo e(route('employee_salary-create')); ?>">Create Employee Salary</a></li>
                                  <li><a href="<?php echo e(route('employee_salary-list')); ?>">List Employee Salary</a></li>
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
                                  <li><a href="<?php echo e(route('employee_leave-list')); ?>">List Employee Leave</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endif; ?> -->





                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Rent Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Rent Collection</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Rent Create')): ?>
                        <li><a href="<?php echo e(route('rent-create')); ?>" class="  ">Create Rent</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Rent List')): ?>
                      <li><a href="<?php echo e(route('rent-list')); ?>">List Rent</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->

                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Owner Utility</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility Create')): ?>
                        <li><a href="<?php echo e(route('owner_utility-create')); ?>" class="  ">Create Owner Utility</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility List')): ?>
                      <li><a href="<?php echo e(route('owner_utility-list')); ?>">List Owner Utility</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Maintenance Cost</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility Create')): ?>
                        <li><a href="<?php echo e(route('maintenanceCost-create')); ?>" class="  ">Create Maintenance Cost</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility List')): ?>
                      <li><a href="<?php echo e(route('maintenanceCost-list')); ?>">List Maintenance Cost</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ManagementCommittee Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Management Committee</span></a>
                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ManagementCommittee Create')): ?>
                        <li><a href="<?php echo e(route('management_committee-create')); ?>" class=" ">Create Management Committee</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ManagementCommittee List')): ?>
                      <li><a href="<?php echo e(route('management_committee-list')); ?>">List Management Committee</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ManagementCommittee Group Create')): ?>
                        <li><a href="<?php echo e(route('management_committee-group_create')); ?>" class=" ">Create Committee Group</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?> -->


                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Apartment Fund</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund Create')): ?>
                        <li><a href="<?php echo e(route('fund-create')); ?>" class="  ">Create Fund</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund List')): ?>
                      <li><a href="<?php echo e(route('fund-list')); ?>">List Fund</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                   <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bill Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Bill Deposite</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bill Create')): ?>
                        <li><a href="<?php echo e(route('bill-create')); ?>" class="  ">Create Bill</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bill List')): ?>
                      <li><a href="<?php echo e(route('bill-list')); ?>">List Bill</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->



                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Complain Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Complain</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Complain Create')): ?>
                        <li><a href="<?php echo e(route('complain-create')); ?>" class="  ">Create Complain</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Complain List')): ?>
                      <li><a href="<?php echo e(route('complain-list')); ?>">List Complain</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Visitors Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Visitors</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Visitors Create')): ?>
                        <li><a href="<?php echo e(route('visitors-create')); ?>" class="  ">Create Visitors</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Visitors List')): ?>
                      <li><a href="<?php echo e(route('visitors-list')); ?>">List Visitors</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->


                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Meeting Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Meeting</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Meeting Create')): ?>
                        <li><a href="<?php echo e(route('meeting-create')); ?>" class="  ">Create Meeting</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Meeting List')): ?>
                      <li><a href="<?php echo e(route('meeting-list')); ?>">List Meeting</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?> -->

                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notifications Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Notifications</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notifications Create')): ?>
                        <li><a href="<?php echo e(route('notification-create')); ?>" class="  ">Create Notifications</a></li>
                      <?php endif; ?>

                      

                    </ul>
                  </li>
                <?php endif; ?> -->

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Events</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Create')): ?>
                        <li><a href="<?php echo e(route('event-create')); ?>" class="  ">Create Events</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event List')): ?>
                      <li><a href="<?php echo e(route('event-list')); ?>">List Events</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Subscription Plans </span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Create')): ?>
                        <li><a href="<?php echo e(route('plan-create')); ?>" class="  ">Create Subscription</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event List')): ?>
                      <li><a href="<?php echo e(route('plan-list')); ?>">Subscription List </a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Banner Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Banner</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Create')): ?>
                        <li><a href="<?php echo e(route('banner-create')); ?>" class="  ">Banner Creates</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event List')): ?>
                      <li><a href="<?php echo e(route('banner-list')); ?>">List Banner</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Currency Master')): ?>
                  <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                    <span>Country Setup</span></a>

                    <ul class="nav-submenu menu-content">
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event Create')): ?>
                        <li><a href="<?php echo e(route('country-create')); ?>" class="  ">Add Country Setup</a></li>
                      <?php endif; ?>

                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Event List')): ?>
                      <li><a href="<?php echo e(route('country-list')); ?>">List Country Setup</a></li>
                      <?php endif; ?>

                    </ul>
                  </li>
                <?php endif; ?>


                


                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Banner Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Banner</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('banner-create')); ?>">Banner Create</a></li>
                                    <li><a href="<?php echo e(route('banner-list')); ?>">List Banner</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Settings Master')): ?>
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
                                  <li><a href="<?php echo e(route('owner_notice-create')); ?>">Create Notice</a></li>
                                  <li><a href="<?php echo e(route('owner_notice-list')); ?>">List Notice</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </li>
                <?php endif; ?> -->



                  



<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Settings Master')): ?>
                  <li class="mega-menu">
                    <!-- <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Settings</span></a> -->
                    <div class="mega-menu-container menu-content">
                      <div class="container">
                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Settings Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Society</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('society-create')); ?>">Add Society</a></li>
                                    <li><a href="<?php echo e(route('society-list')); ?>">List Society</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Admin Setup Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Admin Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('admin_setup-create')); ?>">Add Admin Setup</a></li>
                                    <li><a href="<?php echo e(route('admin_setup-list')); ?>">List Admin Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Building Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Building</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('building-create')); ?>">Add Building</a></li>
                                    <li><a href="<?php echo e(route('building-list')); ?>">List Building</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bill Type Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Bill Type</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('bill_type-create')); ?>">Add Bill Type</a></li>
                                    <li><a href="<?php echo e(route('bill_type-list')); ?>">List Bill Type</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Utility Bill Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Utility Bill</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('utility_bill-create')); ?>">Add Utility Bill</a></li>
                                    <li><a href="<?php echo e(route('utility_bill-list')); ?>">List Utility Bill</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Management Member Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Management Member Type</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('management_member-create')); ?>">Add Management Member</a></li>
                                    <li><a href="<?php echo e(route('management_member-list')); ?>">List Management Member</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?>  -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Month Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Month Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('month-create')); ?>">Add Month Setup</a></li>
                                    <li><a href="<?php echo e(route('month-list')); ?>">List Month Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Year Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Year Setup</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('year-create')); ?>">Add Year Setup</a></li>
                                    <li><a href="<?php echo e(route('year-list')); ?>">List Year Setup</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->

                      

                       

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Service Admin Master')): ?>
                            <div class="row">
                            <div class="col mega-box">
                                <div class="link-section">
                                <div class="submenu-title">
                                    <h5>Service Admin</h5>
                                </div>
                                <div class="submenu-content opensubmegamenu">
                                    <ul>
                                    <li><a href="<?php echo e(route('service_admin-create')); ?>">Service Admin Create</a></li>
                                    <li><a href="<?php echo e(route('service_admin-list')); ?>">List Service Admin</a></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endif; ?> -->


                      </div>
                    </div>
                  </li>

<?php endif; ?>



            </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
<?php /**PATH C:\xampp\htdocs\vidhi\resources\views/admin/layout/sidebar.blade.php ENDPATH**/ ?>