@extends('admin.layout.main')
@section('title')
<title>{{ $data['title'] }}</title>
@stop
@section('inlinecss')

@stop
@section('breadcrum')

@stop
@section('content')

<div class="page-body">
  <div class="container-fluid">
    <div class="email-wrap bookmark-wrap">
      <div class="row">
        
        <div class="col-xl-3 box-col-4 xl-30">
          <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">bookmark filter</a>
            <div class="email-left-aside">
              <div class="card">
                <div class="card-body">
                  <div class="email-app-sidebar left-bookmark">
                    <div class="media">
                      <div class="media-size-email"><img class="me-3 rounded-circle" src="../assets/images/user/user.png" alt=""></div>
                      <div class="media-body">
                        <h6 class="f-w-600">{{$post->society_name}}</h6>
                        <p>{{$post->email}}</p>
                      </div>
                    </div>
                    <ul class="nav main-menu" role="tablist">
                      
                      <br /><br />
                      <li class="mt-4"><a id="pills-created-tab" data-bs-toggle="pill" href="#pills-created" role="tab" aria-controls="pills-created" aria-selected="false">
                        <span class="title"> 
                          {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle me-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> --}}
                          <i class="fa fa-home"></i>
                            Basic     
                        </span>
                      </a>
                      </li>
                      
                      <li>
                        <a class="show " id="pills-todaytask-tab" data-bs-toggle="pill" href="#pills-todaytask" role="tab" aria-controls="pills-todaytask" aria-selected="false">
                          <span class="title">
                            <i class="fa fa-users feather feather-check-circle me-2"></i>                              
                            Committe
                          </span>
                        </a>
                      </li>


                      <li>
                        <a class="show" id="pills-delayed-tab" data-bs-toggle="pill" href="#pills-delayed" role="tab" aria-controls="pills-delayed" aria-selected="false">

                          <span class="title"> 
                            <i class="fa fa-users feather feather-check-circle me-2"></i>    
                            Members </span>
                        </a>
                      </li>

                      <li>
                        <a class="show" id="pills-upcoming-tab" data-bs-toggle="pill" href="#pills-upcoming" role="tab" aria-controls="pills-upcoming" aria-selected="false">
                          <span class="title">
                            <i class="fa fa-car" aria-hidden="true"></i>

                            Parking</span>

                        </a>
                      </li>

                      <li><a class="show" id="pills-weekly-tab" data-bs-toggle="pill" href="#pills-weekly" role="tab" aria-controls="pills-weekly" aria-selected="false"><span class="title">
                        <i class="fas fa-hard-hat"></i>
                        Workers</span></a></li>

                      <li><a class="show" id="pills-monthly-tab" data-bs-toggle="pill" href="#pills-monthly" role="tab" aria-controls="pills-monthly" aria-selected="false"><span class="title">
                        <i class="fa fa-shield-alt"></i>

                        Security</span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-9 col-md-12 box-col-8 xl-70">
          <div class="email-right-aside bookmark-tabcontent">
            <div class="card email-body radius-left">
              <div class="ps-0">
                <div class="tab-content">
                 
                 
                  <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                    <div class="card mb-0">
                      <div class="card-header">
                        <h5 class="mb-0">Basic Details</h5>
                      </div>

                      <div class="card-body p-0">

                        <table class="table">
                            <tr>
                              <td>Society Name : </td>
                              <td>{{$post->society_name}}</td>

                              <td>State : </td>
                              <td>{{$post->society_name}}</td>

                              <td>City : </td>
                              <td></td>

                              <td>Address : </td>
                              <td></td>

                            </tr>

                        </table>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('pagejs')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://www.khiladys.com/public/admin/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://www.khiladys.com/public/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

$(document).ready(() => {
          let url = location.href;

          if (location.hash) {
            const hash = url.split("#");
            $('a[href="#'+hash[1]+'"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
              $(window).scrollTop(0);
            }, 400);
          }

          $('a[data-bs-toggle="pill"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("href");
            if(hash == "#home") {
              newUrl = url.split("#")[0];
            } else {
              newUrl = url.split("#")[0] + hash;
            }
            newUrl += "";
            history.replaceState(null, null, newUrl);
          });
    });

const anchor = window.location.hash;
$(`a[href="${anchor}"]`).tab('show')

</script>
@stop
