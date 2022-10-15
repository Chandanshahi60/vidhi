<?php $__env->startSection('title'); ?>
<title><?php echo e($data['title']); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagecss'); ?>

<style>
thead.family{
    border: solid 2px#ccc;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrum'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">

                        <h5><?php echo e($data['title']); ?></h5>

                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-user"></i>Basic Details</a></li>
                            <?php if(isset($owner)?($owner->society_members_details):''): ?>
                                <li class="nav-item"><a class="nav-link" id="info-member-tab" data-bs-toggle="tab" href="#info-member" role="tab" aria-controls="info-member" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Details</a></li>
                            <?php endif; ?>
                            <!-- <?php if(isset($owner)?($owner->society_members_details):''): ?>
                                <?php if($owner->society_members_details->family_details->count() > 0): ?>
                                    <li class="nav-item"><a class="nav-link" id="info-family-tab" data-bs-toggle="tab" href="#info-family" role="tab" aria-controls="info-family" aria-selected="true"><i class="icofont icofont-ui-user"></i>Member Family Details</a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(isset($owner)?($owner->committe_details):''): ?>
                                <li class="nav-item"><a class="nav-link" id="info-committee-tab" data-bs-toggle="tab" href="#info-committee" role="tab" aria-controls="info-committee" aria-selected="true"><i class="icofont icofont-ui-user"></i>Committee Details</a></li>
                            <?php endif; ?>

                            <?php if($owner->nominee_details->count() > 0): ?>
                                    <li class="nav-item"><a class="nav-link" id="info-nominee-tab" data-bs-toggle="tab" href="#info-nominee" role="tab" aria-controls="info-nominee" aria-selected="true"><i class="icofont icofont-ui-user"></i>Nominee Details</a></li>
                            <?php endif; ?> -->
                        </ul>
                        <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th scope="col" width="200">Owner Name</th>
                                            <td scope="col"  width="500"><?php echo e($owner->owner_name); ?></td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Email</th>
                                            <td scope="col"  width="500"><?php echo e($owner->email); ?></td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Contact No</th>
                                            <td scope="col"  width="500"><?php echo e($owner->contact_no); ?></td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Present Address</th>
                                            <td scope="col"  width="500"><?php echo e($owner->present_address); ?></td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Permanent Address</th>
                                            <td scope="col"  width="500"><?php echo e($owner->permanent_address); ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Pan Card</th>
                                                <td scope="col"  width="500"><?php echo e($owner->pan); ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Aadhar Card</th>
                                                <td scope="col"  width="500"><?php echo e($owner->aadhar); ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="col" width="200">Owner Unit</th>
                                                <td scope="col"  width="500"><?php echo e($owner->owner_unit); ?></td>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200"style="padding-bottom:50px">Owner Photo</th>
                                            <th><img style="width:100px;height:100px" src="<?php echo e(url(''.$owner->owner_photo)); ?>"></th>
                                            </tr>

                                            <tr>
                                            <th scope="col" width="200">Status</th>
                                            <th scope="col"  width="500"><?php echo ($owner->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>'; ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <!-- <?php if(isset($owner)?($owner->society_members_details):''): ?>
                                <div class="tab-pane fade show" id="info-member" role="tabpanel" aria-labelledby="info-member-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                <th scope="col" width="200">Full Name</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->flat_no:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Full Name</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->full_name:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Contact No</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->contact_no:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Type of Property</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->property_type:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Address</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->address:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Father Name</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_father_name:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Mother Name</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_mother_name:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Gender</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_gender:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">DOB</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_dob:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Date of Marriage</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_date_of_marrige:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Occupation</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->member_occupation:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Pan Card</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->pan:''); ?></td>
                                                </tr>

                                                <tr>
                                                <th scope="col" width="200">Aadhar Number</th>
                                                <td scope="col"  width="500"><?php echo e(isset($owner->society_members_details)?$owner->society_members_details->aadhar:''); ?></td>
                                                </tr>

                                                

                                                <tr>
                                                <th scope="col" width="200">Property Owned</th>
                                                <td scope="col"  width="500"><?php echo ($owner->society_members_details->property_owned =='1')?'<span class="badge badge-success"> Yes </span>':'<span class="badge badge-danger"> No </span>'; ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($owner)?($owner->society_members_details):''): ?>
                                <?php if($owner->society_members_details->family_details->count() > 0): ?>
                                <div class="tab-pane fade show" id="info-family" role="tabpanel" aria-labelledby="info-family-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                        <?php $__currentLoopData = $owner->society_members_details->family_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <thead class="family">
                                                <tr>
                                                <th scope="col" width="200">Name</th>
                                                <td scope="col"  width="200"><?php echo e($vals->family_name); ?></td>

                                                <th scope="col" width="200">Father Name</th>
                                                <td scope="col"  width="200"><?php echo e($vals->family_father_name); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Mother Name</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_mother_name); ?></td>

                                                    <th scope="col" width="200">Gender</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_gender); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Contact No</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_contact_no); ?></td>

                                                    <th scope="col" width="200">DOB</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_dob); ?></td>
                                                </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Date of Marriage</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_marriage); ?></td>

                                                    <th scope="col" width="200">Occupation</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->family_occupation); ?></td>
                                                </tr>

                                                    <tr>
                                                    <th scope="col" width="200">Pan Card</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->pan); ?></td>

                                                    <th scope="col" width="200">Aadhar Card</th>
                                                    <td scope="col"  width="200"><?php echo e($vals->aadhar); ?></td>
                                                </tr>
                                            </thead>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>


                            <?php if(isset($owner)?($owner->committe_details):''): ?>
                                <div class="tab-pane fade show" id="info-committee" role="tabpanel" aria-labelledby="info-committee-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="200">Committee Name</th>
                                                    <td scope="col"  width="500"><?php echo e((isset($owner->committe_details)?$owner->committe_details->name:'')); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Designation</th>
                                                    <td scope="col"  width="500"><?php echo e((isset($owner->committe_details)?$owner->committe_details->designation:'')); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Contact No</th>
                                                    <td scope="col"  width="500"><?php echo e((isset($owner->committe_details)?$owner->committe_details->phone:'')); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Joining date</th>
                                                    <td scope="col"  width="500"><?php echo e((isset($owner->committe_details)?$owner->committe_details->joining_date:'')); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Ending date</th>
                                                    <td scope="col"  width="500"><?php echo e((isset($owner->committe_details)?$owner->committe_details->ending_date:'')); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="200">Committee Photo</th>
                                                    <td><img style="width:100px;height:100px" src="<?php echo e(url(''.$owner->committe_details->photo)); ?>"></td>

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <?php if($owner->nominee_details->count() > 0): ?>
                                <div class="tab-pane fade show" id="info-nominee" role="tabpanel" aria-labelledby="info-nominee-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                        <?php $__currentLoopData = $owner->nominee_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <thead class="family">
                                                 <tr>
                                                    <th scope="col" width="300">Nominating Person Name</th>
                                                    <td scope="col"  width="400"><?php echo e($vals->nominator_name); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="300">Nominated Person Name</th>
                                                    <td scope="col"  width="400"><?php echo e($vals->nominated_name); ?></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col" width="300">Percentage</th>
                                                    <td scope="col"  width="400"><?php echo e($vals->percentage); ?></td>
                                                </tr>

                                            </thead>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>


<script>



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\society\resources\views/admin/owner/owner-show.blade.php ENDPATH**/ ?>