
<?php $__env->startSection('title'); ?>
<title><?php echo e($data['title']); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecss'); ?>


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
        <div class="col-sm-12 col-xl-12">
          <div class="row">
            <div class="col-sm-12">
                <form  enctype="multipart/form-data" class="theme-form" id="submitForm" action="<?php echo e($data['url']); ?>">
                <?php echo csrf_field(); ?>
              <div class="card">
                
                <div class="card-body">

                    <div class="mb-3">
                      <label class="col-form-label pt-0" for="name">Name</label>
                      <input class="form-control" id="name" name="name" type="text" aria-describedby="" value="<?php echo e($post->name); ?>" placeholder="Enter Name">
                    </div>

                     

                    <table class="display table data-table" >
                      <thead>
                        <tr>
                          <th style="width:100px;">
                            <div class="checkbox checkbox-primary">
                              <input id="select-all" type="checkbox">
                              <label for="select-all"> </label>
                            </div>
                          
                          </th>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        
                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr >
                            <th style="vertical-align: middle;width:100px;border: 1px solid gray;" rowspan="<?php echo e(count($vals->child_permission)+1); ?>">
                            

                              <div class="checkbox checkbox-primary">
                                <input onclick="setAllChildren(this)" <?php if(in_array($vals->id,$rolePermissions)): ?> checked <?php endif; ?>  name="permission[]"  value="<?php echo e($vals->id); ?>" id="Primary<?php echo e($vals->id); ?>" type="checkbox">
                                <label for="Primary<?php echo e($vals->id); ?>"> </label>
                              </div>
                            
                            </th>

                            <th style="vertical-align: middle;border: 1px solid gray;" rowspan="<?php echo e(count($vals->child_permission)+1); ?>">
                              <?php echo e($vals->name); ?>

                            </th>
                           
                            <?php $__currentLoopData = $vals->child_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$valsd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td style="vertical-align: middle;border: 1px solid gray;" >
                                
                                <div class="checkbox checkbox-primary">
                                  <input <?php if(in_array($valsd->id,$rolePermissions)): ?> checked <?php endif; ?>  name="permission[]"  value="<?php echo e($valsd->id); ?>" id="Children<?php echo e($valsd->id); ?>" class="childrens<?php echo e($vals->id); ?>" type="checkbox">
                                  <label for="Children<?php echo e($valsd->id); ?>"> <?php echo e($valsd->name); ?> </label>
                                </div>

                              </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>

                  
                </div>
                <div class="card-footer">
                  
                 

                  <button id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
                 
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

<script src="<?php echo e(asset('admin/assets/js/dropzone/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('admin/assets/js/dropzone/dropzone-script.js')); ?>"></script>

<script type="text/javascript">

$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
}); 

  function setAllChildren(thisOBJ){
    
      var childrenID =  $(thisOBJ).val();
      

      $.each($(".childrens"+childrenID),function(key,val){
  
        if($(thisOBJ).prop("checked")){
            $(this).prop("checked",true);
        }
        else{
          $(this).prop("checked",false);          
        }

      })
  }

        $(function () {

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
                        successMsg('Create Role', data.msg);
                     

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create Role', 'Input Error');
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create Role', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\society\resources\views/admin/role/role-edit.blade.php ENDPATH**/ ?>