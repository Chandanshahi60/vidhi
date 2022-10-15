
<div class="col-lg-12">
    <div class="card">

        <div class="card-body">

            <div class="form-group">
                <label class="form-label">Title: {{$banner->title}}</label>
            </div>

            <div class="form-group">
                <label class="form-label">Image: <img style="height:100px;width:100px" src="{{url(''.$banner->image)}}"></label>
            </div>

            <div class="form-group">
                <label class="form-label">Status : {!! ($banner->status=='1')?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-danger"> INActive </span>' !!}</label>
            </div>


        </div>

    </div>
</div>
