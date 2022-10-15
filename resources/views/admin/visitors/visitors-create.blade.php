@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop

@section('pagecss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('breadcrum')

@stop

@section('content')


<div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>{{ $data['title'] }}</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item">{{ $data['title'] }} </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-xl-6">
          <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" class="theme-form" id="submitForm" action="{{$data['url']}}">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="type">Visitors Type</label>
                            <select class="form-select" id="type" name="type" >
                                <option value="">Select</option>
                                <option @if(isset($post)) @if($post->type=='Guest') selected @endif  @endif value="Guest">Guest</option>
                                <option  @if(isset($post)) @if($post->type=='Workers') selected @endif  @endif value="Workers">Workers</option>
                                <option  @if(isset($post)) @if($post->type=='Visitors') selected @endif  @endif value="Visitors">Visitors</option>
                                <option  @if(isset($post)) @if($post->type=='Society Worker') selected @endif  @endif value="Society Worker">Society Worker</option>
                                <option  @if(isset($post)) @if($post->type=='Members') selected @endif  @endif value="Members">Members</option>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="society_owner">Society Owner</label>
                            <select class="form-select" id="society_owner" name="society_owner" >
                                <option value="">Select</option>
                                @foreach ($owner as $item)
                                <option @if(isset($post))  @if($post->society_owner == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="entry_date">Entry Date</label>
                        <input class="form-control" id="entry_date" value="{{ (isset($post)?$post->entry_date:'')}}" name="entry_date" type="date" aria-describedby="" placeholder="Enter Entry Date">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="name">Name</label>
                        <input class="form-control" id="name" value="{{ (isset($post)?$post->name:'')}}" name="name" type="text" aria-describedby="" placeholder="Enter Name">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="mobile">Mobile</label>
                        <input class="form-control" id="mobile" value="{{ (isset($post)?$post->mobile:'')}}" name="mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter Mobile">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="address">Address</label>
                        <input class="form-control" id="address" value="{{ (isset($post)?$post->address:'')}}" name="address" type="text" aria-describedby="" placeholder="Enter Address">
                        </div>


                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="floor_no">Floor No</label>
                            <select class="form-select" onchange="getunit()"  id="floor_no" name="floor_no" >
                                <option value="">Select</option>
                                @foreach ($floor as $item)
                                <option @if(isset($post))  @if($post->floor_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="unit_no">Unit No</label>
                            <select class="form-select" id="unit_no" name="unit_no" >
                                <option value="">Select</option>
                                @foreach ($unit as $item)
                                <option @if(isset($post))  @if($post->unit_no == $item->id) selected @endif @endif value="{{$item->id}}">{{$item->unit_no}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="in_time">In Time</label>
                        <input class="form-control" id="in_time" value="{{ (isset($post)?$post->in_time:'')}}" name="in_time" type="time" aria-describedby="" placeholder="Enter in_time">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="out_time">Out Time</label>
                        <input class="form-control" id="out_time" value="{{ (isset($post)?$post->out_time:'')}}" name="out_time" type="time" aria-describedby="" placeholder="Enter out_time">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="title">Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="">Select</option>
                            <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                            <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                    <button  id="submitButton"  type="submit" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..." data-rest-text="Save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>

@endsection

@section('pagejs')


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
        $(function () {

          $('.roles').select2();


           $('#submitForm').submit(function(){
            var $this = $('#submitButton');
            buttonLoading('loading', $this);
            $('.is-invalid').removeClass('is-invalid state-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                url: $('#submitForm').attr('action'),
                type: "POST",
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: new FormData($('#submitForm')[0]),
                success: function(data) {
                    if(data.status){
                        var btn = '<a href="{{route('user-list')}}" class="btn btn-info btn-sm">GoTo List</a>';
                        successMsg('Create User', data.msg, btn);
                        $('#submitForm')[0].reset();

                    }else{
                        $.each(data.errors, function(fieldName, field){
                            $.each(field, function(index, msg){
                                $('#'+fieldName).addClass('is-invalid state-invalid');
                               errorDiv = $('#'+fieldName).parent('div');
                               errorDiv.append('<div class="invalid-feedback">'+msg+'</div>');
                            });
                        });
						errorMsg('Create User', data.msg);
                    }
                    buttonLoading('reset', $this);

                },
                error: function() {
                    errorMsg('Create User', 'There has been an error, please alert us immediately');
                    buttonLoading('reset', $this);
                }

            });

            return false;
           });
      });
    </script>



    <script>
    function getunit(){

       var floor_no = $("#floor_no option:selected").val();

       $.ajax({
            url: '{{route('getunit')}}',
            type: "GET",
            processData: true,  // Important!
            data: {floor_no:floor_no},
            success: function(data) {
                        $("#unit_no").empty();
                    $("#unit_no").append(" <option value=''> Select </option>  ");



                    if(data.data.length > 0){
                        $.each(data.data,function(key,value){
                                $("#unit_no").append(`<option value='${value.id}' >${value.unit_no} </option> `)
                        });
                    }

            }

        });


    }
</script>
@stop

