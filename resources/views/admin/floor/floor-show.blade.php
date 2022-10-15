<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Name: {{$floor->title}}</label>

            </div>

            <div class="form-group">
                <label class="form-label">Status : {!! ($floor->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>

        </div>

    </div>
</div>
