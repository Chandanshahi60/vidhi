
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Gas Bill: {{$bill->gas_bill}}</label>

            </div>

            <div class="form-group">
                <label class="form-label">Security Bill : {{$bill->security_bill}}</label>
            </div>

            <div class="form-group">
                <label class="form-label">Status : {!! ($bill->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>

        </div>

    </div>
</div>
