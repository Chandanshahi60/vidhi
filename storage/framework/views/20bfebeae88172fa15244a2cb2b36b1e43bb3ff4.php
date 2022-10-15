
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Title: <?php echo e($banner->title); ?></label>
            </div>

            <div class="form-group">
                <label class="form-label">Image: <img style="height:100px;width:100px" src="<?php echo e(url(''.$banner->image)); ?>"></label>
            </div>

            <div class="form-group">
                <label class="form-label">Status : <?php echo ($banner->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>'; ?></label>
            </div>


        </div>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\society\resources\views/admin/banner/banner-show.blade.php ENDPATH**/ ?>