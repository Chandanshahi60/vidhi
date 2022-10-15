
<?php $__env->startSection('title'); ?>
<title><?php echo e($data['title']); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecss'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3><?php echo e($data['title']); ?></h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
              <li class="breadcrumb-item"><?php echo e($data['title']); ?> </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-xl-6">
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="<?php echo e($data['url']); ?>">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="type">Visitors Type</label>
                            <select class="form-select" id="type" name="type" >
                                <option value="">Select</option>
                                <option <?php if(isset($post)): ?> <?php if($post->type=='Guest'): ?> selected <?php endif; ?>  <?php endif; ?> value="Guest">Guest</option>
                                <option  <?php if(isset($post)): ?> <?php if($post->type=='Workers'): ?> selected <?php endif; ?>  <?php endif; ?> value="Workers">Workers</option>
                                <option  <?php if(isset($post)): ?> <?php if($post->type=='Visitors'): ?> selected <?php endif; ?>  <?php endif; ?> value="Visitors">Visitors</option>
                                <option  <?php if(isset($post)): ?> <?php if($post->type=='Society Worker'): ?> selected <?php endif; ?>  <?php endif; ?> value="Society Worker">Society Worker</option>
                                <option  <?php if(isset($post)): ?> <?php if($post->type=='Members'): ?> selected <?php endif; ?>  <?php endif; ?> value="Members">Members</option>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="society_owner">Society Owner</label>
                            <select class="form-select" id="society_owner" name="society_owner" >
                                <option value="">Select</option>
                                <?php $__currentLoopData = $owner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(isset($post)): ?>  <?php if($post->society_owner == $item->id): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="entry_date">Entry Date</label>
                        <input class="form-control" id="entry_date" value="<?php echo e((isset($post)?$post->entry_date:'')); ?>" name="entry_date" type="date" aria-describedby="" placeholder="Enter Entry Date">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="name">Name</label>
                        <input class="form-control" id="name" value="<?php echo e((isset($post)?$post->name:'')); ?>" name="name" type="text" aria-describedby="" placeholder="Enter Name">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="mobile">Mobile</label>
                        <input class="form-control" id="mobile" value="<?php echo e((isset($post)?$post->mobile:'')); ?>" name="mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter Mobile">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="address">Address</label>
                        <input class="form-control" id="address" value="<?php echo e((isset($post)?$post->address:'')); ?>" name="address" type="text" aria-describedby="" placeholder="Enter Address">
                        </div>


                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="floor_no">Floor No</label>
                            <select class="form-select" onchange="getunit()"  id="floor_no" name="floor_no" >
                                <option value="">Select</option>
                                <?php $__currentLoopData = $floor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(isset($post)): ?>  <?php if($post->floor_no == $item->id): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="unit_no">Unit No</label>
                            <select class="form-select" id="unit_no" name="unit_no" >
                                <option value="">Select</option>
                                <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(isset($post)): ?>  <?php if($post->unit_no == $item->id): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->unit_no); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="in_time">In Time</label>
                        <input class="form-control" id="in_time" value="<?php echo e((isset($post)?$post->in_time:'')); ?>" name="in_time" type="time" aria-describedby="" placeholder="Enter in_time">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="out_time">Out Time</label>
                        <input class="form-control" id="out_time" value="<?php echo e((isset($post)?$post->out_time:'')); ?>" name="out_time" type="time" aria-describedby="" placeholder="Enter out_time">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="title">Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="">Select</option>
                            <option <?php if(isset($post)): ?> <?php if($post->status==1): ?> selected <?php endif; ?>  <?php endif; ?> value="1">Active</option>
                            <option  <?php if(isset($post)): ?> <?php if($post->status==0): ?> selected <?php endif; ?>  <?php endif; ?> value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                    <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
        $(function () {

          $('.roles').select2();


           $('#submitForm').submit(function(){
            var $this = $('#submitButton');
            buttonLoading('loading', $this);
            $('.is-invalid').removeClass('is-invalid state-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                url: $('#submitForm').attr('action'),
                type: "POST",
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: new FormData($('#submitForm')[0]),
                success: function(data) {
                    if(data.status){
                        var btn = '<a href="<?php echo e(route('user-list')); ?>" class="btn btn-info btn-sm">GoTo List</a>';
                        successMsg('Create User', data.msg, btn);
                        $('#submitForm')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create User', data.msg);
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create User', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>



    <script>
    function getunit(){

       var floor_no = $("#floor_no option:selected").val();

       $.ajax({
            url: '<?php echo e(route('getunit')); ?>',
            type: "GET",
            processData: true,  // Important!
            data: {floor_no:floor_no},
            success: function(data) {
                        $("#unit_no").empty();
                    $("#unit_no").append(" <option value=''> Select </option>  ");



                    if(data.data.length > 0){
                        $.each(data.data,function(key,value){
                                $("#unit_no").append(`<option value='${value.id}' >${value.unit_no} </option> `)
                        });
                    }

            }

        });


    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/aamoditsolutions/public_html/projects/society/resources/views/admin/visitors/visitors-create.blade.php ENDPATH**/ ?>