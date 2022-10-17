<?php $__env->startSection('title'); ?>
<title><?php echo e($data['title']); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecss'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link
    href="https://www.jqueryscript.net/demo/Elegant-Customizable-jQuery-PHP-File-Uploader-Fileuploader/jquery.fileuploader.css"
    rel="stylesheet" />
<link
    href="https://www.jqueryscript.net/demo/Elegant-Customizable-jQuery-PHP-File-Uploader-Fileuploader/css/jquery.fileuploader-theme-dragdrop.css"
    rel="stylesheet" />
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
                 <form id="submitForm"  method="post" enctype="multipart/form-data" action="<?php echo e($data['url']); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="row">

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Title *</label>
                    <input value="<?php echo e((isset($post)?$post->title:'')); ?>" class="form-control" name="title" id="title">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Event Start Date *</label>
                    <input onblur="convertToSlug(this)" type="date"  value="<?php echo e((isset($post)?$post->start_date:'')); ?>" class="form-control" name="start_date" id="start_date">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Event End Date *</label>
                    <input onblur="convertToSlug(this)" type="date" class="form-control" name="end_date" id="end_date">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Venue </label>
                    <input value="<?php echo e((isset($post)?$post->venue:'')); ?>" class="form-control" name="venue" id="venue">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Facebook Url</label>
                    <input value="<?php echo e((isset($post)?$post->facebook_url:'')); ?>" class="form-control" name="facebook_url" id="facebook_url">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Organiser</label>
                    <input value="<?php echo e((isset($post)?$post->organiser:'')); ?>" class="form-control" name="organiser" id="organiser">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">City</label>
                    <input value="<?php echo e((isset($post)?$post->city:'')); ?>" class="form-control" name="city" id="city">
                </div>


                <div class="form-group col-12">
                    <label   class="form-label"><b>Description</b></label>
                    <input class="form-control" value="<?php echo e((isset($post)?$post->description:'')); ?>" type="text" name="description" id="description">
                </div>

                <div class="form-group col-sm-12 col-lg-12 col-md-12 col-12">
                    <label class="form-label">Main Image *</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <input type="file" name="files[]" multiple>

                <div class="form-group col-sm-6">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control custom-select">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>

            </div>
            <div class="card-footer"></div>
                <button type="submit" id="submitButton" class="btn btn-primary float-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending..." data-rest-text="Create">Create</button>

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
    <script
        src="https://www.jqueryscript.net/demo/Elegant-Customizable-jQuery-PHP-File-Uploader-Fileuploader/jquery.fileuploader.min.js">
    </script>
    <script src="https://www.jqueryscript.net/demo/Elegant-Customizable-jQuery-PHP-File-Uploader-Fileuploader/js/custom.js">
    </script>
    <script>
        // enable fileuploader plugin
        $('input[name="files[]"]').fileuploader({
            changeInput: '<div class="fileuploader-input">' +
                '<div class="fileuploader-input-inner">' +
                '<img src="https://www.jqueryscript.net/demo/Elegant-Customizable-jQuery-PHP-File-Uploader-Fileuploader/images/fileuploader-dragdrop-icon.png">' +
                '<h3 class="fileuploader-input-caption"><span>Drag and drop files here</span></h3>' +
                '<p>or</p>' +
                '<div class="fileuploader-input-button"><span>Browse Files</span></div>' +
                '</div>' +
                '</div>',
            theme: 'dragdrop',

            captions: {
                feedback: 'Drag and drop files here',
                feedback2: 'Drag and drop files here',
                drop: 'Drag and drop files here'
            },

            limit: 20,
            maxSize: 50,

            addMore: true,
            thumbnails: {
                onImageLoaded: function(item) {

                    // if (!item.html.find('.fileuploader-action-edit').length)
                    //     item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-popup fileuploader-action-edit" title="Edit"><i class="fileuploader-icon-edit"></i></button>');
                }

            }
        });
    </script>
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

<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vidhi\resources\views/admin/event/event-create.blade.php ENDPATH**/ ?>