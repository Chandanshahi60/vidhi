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
                        <h4>Vendor Details</h4>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="services">Service Provider</label>
                            <br>
                            <input type="checkbox" id="select_service" name="select_service"  placeholder="" />
                                <label class="form-label">Select All</label><br>
                            <select class="js-example-basic-single form-control" multiple data-live-search="true" id="services" name="services[]" >
                                @foreach ($service as $item)
                                <option @if(isset($post))  @if(in_array($item->name,explode(',',$post->services))) selected @endif @endif value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="name">Vendor Name</label>
                        <input class="form-control" id="name" value="{{ (isset($post)?$post->name:'')}}" name="name" type="text" aria-describedby="" placeholder="Enter Name">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="contact_name">Vendor Contact Name</label>
                        <input class="form-control" id="contact_name" value="{{ (isset($post)?$post->contact_name:'')}}" name="contact_name"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter contact_name">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="mobile">Vendor Mobile</label>
                        <input class="form-control" id="mobile" value="{{ (isset($post)?$post->mobile:'')}}" name="mobile"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" aria-describedby="" placeholder="Enter Mobile">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="email">Vendor Email</label>
                        <input class="form-control" id="email" value="{{ (isset($post)?$post->email:'')}}" name="email" type="email" aria-describedby="" placeholder="Enter email">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="notes">Notes</label>
                        <input class="form-control" id="notes" value="{{ (isset($post)?$post->notes:'')}}" name="notes" type="text" aria-describedby="" placeholder="Enter notes">
                        </div>

                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="account_head">Account Head</label>
                            <input class="form-control" id="account_head" value="{{ (isset($post)?$post->account_head:'')}}" name="account_head" type="text" aria-describedby="" placeholder="Enter account_head">
                        </div>

                        <div class="mb-3">
                        <label class="col-form-label pt-0" for="title">Vendor Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="">Select</option>
                            <option @if(isset($post)) @if($post->status==1) selected @endif  @endif value="1">Active</option>
                            <option  @if(isset($post)) @if($post->status==0) selected @endif  @endif value="0">Inactive</option>
                            </select>
                        </div>

                        <h4>AMC Term</h4>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="start_date"> Start Date</label>
                            <input class="form-control" value="{{ (isset($post)?$post->start_date:'')}}" id="start_date" name="start_date" type="date" aria-describedby="" placeholder="Enter start_date">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="end_date"> End Date</label>
                            <input class="form-control" value="{{ (isset($post)?$post->end_date:'')}}" id="end_date" name="end_date" type="date" aria-describedby="" placeholder="Enter end_date">
                        </div>

                        <h4>Vendor Payment Information</h4>

                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="tds_rate"> TDS Rate</label>
                            <input class="form-control" value="{{ (isset($post)?$post->tds_rate:'')}}" id="tds_rate" name="tds_rate" type="number" aria-describedby="" placeholder="Enter Tds Rate">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="service_tax_rate"> Service Tax Rate</label>
                            <input class="form-control" value="{{ (isset($post)?$post->service_tax_rate:'')}}" id="service_tax_rate" name="service_tax_rate" type="number" aria-describedby="" placeholder="Enter Service Tax Rate">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="service_tax_registration"> Service Tax Registration</label>
                            <input class="form-control" value="{{ (isset($post)?$post->service_tax_registration:'')}}" id="service_tax_registration" name="service_tax_registration" type="text" aria-describedby="" placeholder="Enter Service Tax Registration">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="gstin"> GSTIN</label>
                            <input class="form-control" value="{{ (isset($post)?$post->gstin:'')}}" id="gstin" name="gstin" type="text" aria-describedby="" placeholder="Enter GSTIN">
                        </div>

                        <div class="col-md-12">
                            <label class="col-form-label pt-0" for="gst_rate"> GST Rate</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" value="{{ (isset($post)?$post->cgst_rate:'')}}" id="cgst_rate" name="cgst_rate" type="number" aria-describedby="" placeholder="Enter GST rate">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" value="{{ (isset($post)?$post->gst_rate:'')}}" id="gst_rate" name="gst_rate" type="number" aria-describedby="" placeholder="Enter GST rate">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="pan_no"> Pan No</label>
                            <input class="form-control" value="{{ (isset($post)?$post->pan_no:'')}}" id="pan_no" name="pan_no" type="text" aria-describedby="" placeholder="Enter Pan No">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="section_code"> Section Code</label>
                            <input class="form-control" value="{{ (isset($post)?$post->section_code:'')}}" id="section_code" name="section_code" type="text" aria-describedby="" placeholder="Enter Section Code">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="legal_type"> Vendor Legal Type</label><br>
                            <input type="radio" name="legal_type"  value="Company"><span>Company</span>
                            <input type="radio" name="legal_type"  value="Non Company"><span>Non Company</span>
                            <input type="radio" name="legal_type"  value="Professtional"><span>Professional</span>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="payee_name"> Payee Name</label>
                            <input class="form-control" value="{{ (isset($post)?$post->payee_name:'')}}" id="payee_name" name="payee_name" type="text" aria-describedby="" placeholder="Enter Payee Name">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="billing_address"> Billing Address</label>
                            <textarea class="form-control" value="{{ (isset($post)?$post->billing_address:'')}}" id="billing_address" name="billing_address" type="text" aria-describedby="" placeholder="Enter Payee Name"></textarea>
                        </div>

                        <h4>Vendor Bank Information</h4>
                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="account_no"> Bank Account No</label>
                            <input class="form-control" value="{{ (isset($post)?$post->account_no:'')}}" id="account_no" name="account_no" type="text" aria-describedby="" placeholder="Enter Bank Account No">
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="branch_name"> Bank Branch Name</label>
                            <input class="form-control" value="{{ (isset($post)?$post->branch_name:'')}}" id="branch_name" name="branch_name" type="text" aria-describedby="" placeholder="Enter Bank Branch Name">
                        </div>

                         <div class="mb-3">
                            <label class="col-form-label pt-0" for="bank_code"> Bank NEFT/IFSC Code</label>
                            <input class="form-control" value="{{ (isset($post)?$post->bank_code:'')}}" id="bank_code" name="bank_code" type="text" aria-describedby="" placeholder="Enter Bank NEFT/IFSC Code">
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

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });


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
						errorMsg('Create User', 'Input Error');
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
      $("#select_service").click(function(){
            if($("#select_service").is(':checked') ){
                $("#services > option").prop("selected", true);
                $("#services").trigger("change");
            }else{
                $("#services > option").prop("selected", false);
                $("#services").trigger("change")
            }
        });
</script>
@stop

