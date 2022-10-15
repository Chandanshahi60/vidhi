
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label"><b>Currency Name: </b> <?php echo e($currency->currency_name); ?></label>

            </div>

            <div class="form-group">
                <label class="form-label"><b>Currency Symbol: </b> <?php echo e($currency->symbol); ?></label>

            </div>

            <div class="form-group">
                <label class="form-label"><b>Status : </b><?php echo ($currency->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>'; ?></label>
            </div>
        </div>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\society\resources\views/admin/settings/country/country-show.blade.php ENDPATH**/ ?>