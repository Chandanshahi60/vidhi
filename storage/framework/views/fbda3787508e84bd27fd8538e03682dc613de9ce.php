<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left" style="height: 83px;">
    <div class="logo-wrapper"><a href=""><img class="img-fluid" src="<?php echo e(asset('admin/assets/images/logo/vidhi.jpeg')); ?>" style="height:80px;width:100px" alt=""></a></div>

      <!-- <div class="logo-wrapper"><a href=""><b><?php echo e(auth()->guard('admin')->user()->name); ?></b></a></div> -->
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
    </div>
    <div class="left-menu-header col">
      <ul>
        
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">


        <!-- <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
          <ul class="notification-dropdown onhover-show-div">
            <li>
              <p class="f-w-700 mb-0">You have 3 Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
            </li>
            <li class="noti-primary">
              <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                <div class="media-body">
                  <p>Delivery processing </p><span>10 minutes ago</span>
                </div>
              </div>
            </li>
            <li class="noti-secondary">
              <div class="media"><span class="notification-bg bg-light-secondary"><i data-feather="check-circle"> </i></span>
                <div class="media-body">
                  <p>Order Complete</p><span>1 hour ago</span>
                </div>
              </div>
            </li>
            <li class="noti-success">
              <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                <div class="media-body">
                  <p>Tickets Generated</p><span>3 hour ago</span>
                </div>
              </div>
            </li>
            <li class="noti-danger">
              <div class="media"><span class="notification-bg bg-light-danger"><i data-feather="user-check"> </i></span>
                <div class="media-body">
                  <p>Delivery Complete</p><span>6 hour ago</span>
                </div>
              </div>
            </li>
          </ul>
        </li> -->

        
        <li class="onhover-dropdown p-0">
          <form action="<?php echo e(route('admin.logout')); ?>" id="adminLogoutForm" method="POST">
            <?php echo csrf_field(); ?>
          </form>

          <a href="#" onclick="event.preventDefault();document.getElementById('adminLogoutForm').submit();">
            <button class="btn btn-primary-light" type="button">
              <i data-feather="log-out"></i>Log out
            </button>
          </a>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>

<?php /**PATH C:\xampp\htdocs\vidhi\resources\views/admin/layout/header.blade.php ENDPATH**/ ?>