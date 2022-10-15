
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Name: {{$service->name}}</label>

            </div>

             <div class="form-group">
                <label class="form-label">Image: <img style="height:100px;width:100px" src="{{url(''.$service->image)}}"></label>
            </div>

            <div class="form-group">
                <label class="form-label">Status : {!! ($service->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>



        </div>

    </div>
</div>
