
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Bill Type: {{$bill->bill_type}}</label>

            </div>

            <div class="form-group">
                <label class="form-label">Bill Status : {!! ($bill->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>



        </div>

    </div>
</div>
