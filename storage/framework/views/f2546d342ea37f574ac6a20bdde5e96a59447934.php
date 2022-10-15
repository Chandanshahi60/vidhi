<?php $__env->startSection('title'); ?>
    <title>Dashboard</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('inlinecss'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="page-body dashboard-2-main">


   

   <div class="card-body">
      <div class="app-content">
         <div class="side-app">
            <!-- ROW-2 OPEN -->
            <div class="row">

               <div class=" col-md-12 col-lg-12 col-xl-12">
                  <div class="row">

                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('unit-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Unit</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/room.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($unit); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('tenant-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Tenent</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/tenant.jpg')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($tenent); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('owner-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Owner</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/owner.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($owner); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('service-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Service</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/service.jpg')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($service); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('employee-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Total Employee</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/employee.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($employee); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                     <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('visitors-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Visitors</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/visitors.jpg')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px"><?php echo e($visitors); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                        <?php
                           $total_rent = 0;
                            foreach ($rent as $val){
                                $total_rent+=$val->total_rent;
                            }
                        ?>
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('rent-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">My Total Rent</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/rent.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹<?php echo e($total_rent); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                        <?php
                           $total_utility = 0;
                            foreach ($owner_utility as $val){
                                $total_utility+=$val->total_rent;
                            }
                        ?>

                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('owner_utility-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Owner Utility</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/cash.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹<?php echo e($total_utility); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                        <?php
                           $maintainance = 0;
                            foreach ($maintenance_cost as $val){
                                $maintainance+=$val->amount;
                            }
                        ?>
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('maintenanceCost-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Total Maintainance Cost</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/maintenance.png')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹<?php echo e($maintainance); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>

                        <?php
                           $total_fund = 0;
                            foreach ($fund as $val){
                                $total_fund+=$val->total_amt;
                            }
                        ?>
                      <div class="col-sm-12 col-lg-4 col-md-4 ">
                        <a href="<?php echo e(route('fund-list')); ?>"> <div class="card">
                           <div class="card-body" >
                              <h4 class="mb-1" style="font-weight: 600;font-size: 16px;">Total Fund</h4>
                              <div style="display:flex;align-items:center">
                                 <img style="height:50px;width:50px" src="<?php echo e(asset('admin/assets/images/fund.jpg')); ?>">
                                 <h2 class="mb-1 number-font" style="padding-left: 15px">₹<?php echo e($total_fund); ?></h2>
                              </div>
                           </div>
                        </div></a>
                     </div>


                      
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



<?php $__env->startSection('pagejs'); ?>

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
<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\society\resources\views/admin/welcome.blade.php ENDPATH**/ ?>