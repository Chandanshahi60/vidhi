

<?php $__env->startSection('title'); ?>
    <title>LMS | Login</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('inlinecss'); ?>
<style>
.table td {
    color: #ffffff;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <div class="login-card" style="display: grid;">

            <form method="POST" action="<?php echo e(route('admin.post.login')); ?>" class="theme-form login-form">
                <?php echo csrf_field(); ?>
              <h4>Login</h4>
              <h6>Welcome back! Log in to your account.</h6>
              <div class="form-group">
                <label>Email Address</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                  <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" id="email" name="email" required="required" placeholder="admin@gmail.com">
                </div>
              </div>


              <div class="form-group">
                <label class="col-form-label pt-0" for="role">Roles</label>
                    <select class="form-select" id="role" name="role" required>
                            <option value="">Select</option >
                            <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(isset($post)): ?>  <?php if($post->role == $item->id): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
              </div>

               
                <div class="form-group">
                    <label class="col-form-label pt-0" for="society">Community List</label>
                    <select class="form-select" id="society_id" name="society_id" required>
                            <option value="">Select</option>
                            <?php $__currentLoopData = $society; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if(isset($post)): ?>  <?php if($post->society == $item->id): ?> selected <?php endif; ?> <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->society_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>


              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                  <input class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" id="password" name="password" required="required" placeholder="*********">
                  <div class="show-hide"><span class="show"> </span></div>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
              </div>


              <center>
                <a href="">Forgot Password</a>
              </center>



            </form>



            <table class="table" style="width: 450px;">
              <tbody>
                <tr>
                <td style="color:green; background:#fff;">User Type</td>
                <td style="color:green; background:#fff;">Username</td>
                <td style="color:green; background:#fff;">Password</td>
                <td style="color:green; background:#fff;" align="center">Click Here</td>
              </tr>
              <tr style="background:#00a65a;color:#fff;">
                <td>Super Admin</td>
                <td>admin@gmail.com</td>
                <td>admin@123</td>
                <td align="center"><input class="btn btn-warning" type="button" value="Click" style="background:#000;" onclick="setInfoToBoxSA('admin@gmail.com','admin@123','5');"></td>
              </tr>
              <tr style="background:#00a65a;color:#fff;">
                <td>Community Owner</td>
                <td>community123@gmail.com</td>
                <td>12345678</td>
                <td align="center"><input class="btn btn-warning"  type="button" value="Click" style="background:#000;" onclick="setInfoToBox('society123@gmail.com','12345678','1');"></td>
              </tr>

            </tbody>
          </table>

          </div>


        </div>
      </div>
    </div>



  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
<script>
  $(".login-form").submit(function(){

    $(".submitbtn").attr("disabled","disabled");

  });






  function validationForm(){
	if($("#email").val() == ''){
		alert("Email Required !!!");
		$("#email").focus();
		return false;
	}
	else if($("#password").val() == ''){
		alert("Password Required !!!");
		$("#password").focus();
		return false;
	}
	else if($("#ddlLoginType").val() == ''){
		alert("Select User Type !!!");
		return false;
	}
	else if(!validateEmail($("#email").val())){
		alert("Valid Email Required !!!");
		$("#email").focus();
		return false;
	}
	else{
		return true;
	}
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function mewhat(val){
	if(val != ''){
		if(val == '5'){
			$("#x_branch").show();
		}
		else{
			$("#x_branch").hide();
		}
	}
	else{
		$("#x_branch").hide();
	}
}



        $("#role").change(function(){

            if($("#role option:selected").val()==1){
                 $(".society").show();
                 $("#society_id").attr('required','required');
            }
            else{
                    $(".society").hide();
                     $("#society_id").removeAttr('required');
                }

        });


function setInfoToBox(username,password,type){
	$("#email").val(username);
	$("#password").val(password);
	$("#ddlLoginType").val(type);
	$("#x_branch").hide();
}
function setInfoToBoxSA(username,password,type){
	$("#email").val(username);
	$("#password").val(password);
	$("#ddlLoginType").val(type);
	$("#x_branch").show();
	$("#ddlBranch").val(8);
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vidhi\resources\views/auth/login.blade.php ENDPATH**/ ?>