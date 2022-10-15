
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label"><b>Month: </b> {{$month->month_name}}</label>

            </div>

            <div class="form-group">
                <label class="form-label"><b>Status : </b>{!! ($month->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>
        </div>

    </div>
</div>
