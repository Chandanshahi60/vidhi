
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Title: <?php echo e($event->title); ?></label>
            </div>

            <div class="form-group">
                <label class="form-label">Image: <img style="height:100px;width:100px" src="<?php echo e(url(''.$event->image)); ?>"></label>
            </div>

            <div class="form-group">
                <label class="form-label">Status : <?php echo ($event->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>'; ?></label>
            </div>


        </div>

    </div>
</div>
<?php /**PATH C:\wamp64\www\society\resources\views/admin/event/event-show.blade.php ENDPATH**/ ?>