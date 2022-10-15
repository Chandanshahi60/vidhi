
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label"><b>Country Name: </b> {{$currency->currency_name}}</label>

            </div>

            <div class="form-group">
                <label class="form-label"><b>Currency Symbol: </b> {{$currency->symbol}}</label>

            </div>

            <div class="form-group">
                <label class="form-label"><b>Status : </b>{!! ($currency->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>
        </div>

    </div>
</div>
