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
                        <label class="col-form-label pt-0" for="title">Notice Title</label>
                        <input class="form-control" id="title" value="<?php echo e((isset($post)?$post->title:'')); ?>" name="title" type="text" aria-describedby="" placeholder="Enter Title">
                        </div>

                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="date">Notice Date</label>
                            <input class="form-control" id="date" value="<?php echo e((isset($post)?$post->date:'')); ?>" name="date" type="date" aria-describedby="" placeholder="Enter date">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="meeting_desc">Notice Description</label>
                        <textarea class="form-control" id="meeting_desc" value="<?php echo e((isset($post)?$post->meeting_desc:'')); ?>" name="meeting_desc" type="text" max-length="10" aria-describedby="" placeholder="Enter meeting_desc"></textarea>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="title">Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="">Select</option>
                            <option <?php if(isset($post)): ?> <?php if($post->status==1): ?> selected <?php endif; ?>  <?php endif; ?> value="1">Publish Now</option>
                            <option  <?php if(isset($post)): ?> <?php if($post->status==0): ?> selected <?php endif; ?>  <?php endif; ?> value="0">Disable</option>
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
						errorMsg('Create User', 'Input Error');
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/aamoditsolutions/public_html/projects/society/resources/views/admin/notice/employee/employee_notice-create.blade.php ENDPATH**/ ?>