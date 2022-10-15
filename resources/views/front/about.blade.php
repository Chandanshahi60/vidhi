<!DOCTYPE html>
<!--[if IE 9]>
<html lang="en" class="ie9">
   <![endif]-->
   <!--[if IE 8]>
   <html lang="en" class="ie8">
      <![endif]-->
      <!--[if !IE]><!-->
      <html lang="en">
         <!--<![endif]-->
         <head>
            <title>Super Prime Facility</title>
            <!-- Mobile Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Web Fonts -->
            <link href="{{asset('front/assets/css/staticpage.min.css')}}" rel="stylesheet" type="text/css">
            <!-- <link href='<link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Lora|Roboto|Signika|Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">' rel='stylesheet' type='text/css'> -->
            <!--  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet"> -->
            <!--  <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
            <!-- <link href="assets/css/staticpage.min.css?v=20.19" rel="stylesheet" type="text/css"> -->
            <link href="{{asset('front/assets/css/custom.css')}}" rel="stylesheet" type="text/css">

         </head>
         <body class="front no-trans">
            <div class="scrollToTop"><i class="icon-up-open-big"></i></div>
            <div class="page-wrapper">
               <div class="header-top">
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-2 col-sm-6">
                           <div class="header-top-first clearfix">
                              <ul class="social-links clearfix hidden-xs">
                                 <li class="facebook"><a  href="javascript:void" style="color:white"><i class="fa fa-facebook" style="color:white"></i></a></li>
                                 <li class="twitter"><a  href="javascript:void" style="color:white"><i class="fa fa-twitter" style="color:white"></i></a></li>
                                 <li class="linkedin"><a  href="javascript:void"><i class="fa fa-linkedin" style="color:white"></i></a></li>
                                 <li class="linkedin"><a  href="javascript:void"><i class="fa fa-youtube" style="color:white"></i></a></li>
                                 <li class="linkedin"><a  href="javascript:void" style="color:white"></i></a></li>
                              </ul>
                              <div class="social-links hidden-lg hidden-md hidden-sm">
                                 <div class="btn-group dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                                    <ul class="dropdown-menu dropdown-animation">
                                       <li class="facebook"><a target="_blank" href="javascript:void"><i class="fa fa-facebook" style="color:white"></i></a></li>
                                       <li class="twitter"><a target="_blank" href="javascript:void"><i class="fa fa-twitter" style="color:white"></i></a></li>
                                       <li class="linkedin"><a target="_blank" href="javascript:void"><i class="fa fa-linkedin" style="color:white"></i></a>
                                    </li>
                                    <li class="linkedin"><a  href="javascript:void"><i class="fa fa-youtube" style="color:white"></i></a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-10 col-sm-6">
                     <div id="header-top-second"  class="clearfix">
                        <div class="header-top-dropdown">
                           <div class="btn-group dropdown">
                              <div class="btn-group dropdown">
                                 <a class="btn" href="tel:+911234567890"><i class="fa fa-phone"></i>(+91) 1234567890</a>
                              </div>
                              <!-- <div class="btn-group dropdown">
                                 <button type="button" class="btn show-society-register-form" data-register-form="0" aria-expanded="true"><i class="fa fa-envelope"></i> Enquiry</button>
                              </div> -->
                              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" style="color:white"></i> Login</button>
                              <ul class="dropdown-menu dropdown-menu-right dropdown-animation">
                                 <li>
                                    <form  method="post" action="" id="login-form">
                                       <div class="form-group has-feedback">
                                          <label class="control-label">Email</label>
                                          <input type="text" class="form-control" name="username" placeholder="Email">
                                          <i class="fa fa-user form-control-feedback"></i>
                                       </div>
                                       <div class="custom-error" id="username-error">
                                       </div>
                                       <div class="form-group has-feedback">
                                          <label class="control-label">Password</label>
                                          <input type="password" name="password" class="form-control" placeholder="Password">
                                          <i class="fa fa-lock form-control-feedback"></i>
                                       </div>
                                       <div class="custom-error" id="password-error">
                                       </div>
                                       <div class="custom-error" id="user-login-error"></div>
                                       <button type="submit" class="btn btn-group btn-dark btn-sm">Log In</button>
                                       <ul>
                                          <li><a href="javascript:void" id="forgot-password-link">Forgot your password?</a></li>
                                       </ul>
                                    </form>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <header id="site-header" class="header fixed clearfix">
            <div class="container">
               <div class="row">
                  <div class="col-md-3">
                     <div class="header-left clearfix">
                        <div class="logo">
                           <a href="javascript:void"><img id="logo" src="{{asset('front/assets/images/myslogo.png')}}" alt="SuperPrimeFacility"></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="header-right clearfix">
                        <div class="main-navigation animated">
                           <nav class="navbar navbar-default">
                              <div class="container-fluid">
                                 <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    </button>
                                 </div>
                                 <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                       <li>
                                          <a href="{{url('/index')}}" >Home</a>
                                       </li>
                                       <li class="active ">
                                          <a href="{{url('/about')}}" >About us</a>
                                       </li>
                                       <li class="dropdown" >
                                          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Features</a>
                                          <ul class="dropdown-menu">
                                             <li><a href="{{url('/blog')}}">Blogs</a></li>
                                             <li><a href="{{url('/media')}}">Media</a></li>
                                          </ul>
                                       </li>
                                       <!-- <li>
                                          <a href="pyment.html">Payments</a>
                                       </li> -->

                                       <li class="dropdown">
                                          <a href="javascript:void" >Downloads</a>
                                          <ul class="dropdown-menu">
                                             <li><a href="javascript:void"><i class="fa fa-android"></i>&nbsp;android Application</a></li>
                                             <li><a href="javascript:void"><i class="fa fa-apple"></i> &nbsp;Apple Application</a></li>
                                          </ul>
                                       </li>
                                       <li>
                                          <a href="{{url('/contact')}}" >Contact us </a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="aboutus">
            <div class="container">
               <div class="row">
                  <div class="About">
                     <h1>About Us</h1>
                     <a href="javascript:void"><i class="fa fa-home" aria-hidden="true"></i></a>
                     <span><i class="fa fa-angle-double-right" aria-hidden="true"></i>About Us</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="homepage-background">
            <div class="container">
               <div class="row">
                  <div class="col-sm-7">
                     <h3 class="page-title text-left top-heading" style="color: #fff;
                     font-size: 40px;
                     font-weight: bold;">ABOUT US</h3>
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also </p>
                     <p>the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                     <p>the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                  </div>
                  <div class="col-sm-5">
                     <div class="about_img"><img src="{{asset('front/assets/images/aboutus.png')}}"></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="back-img1">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="Hasslefree">
                           <img src="{{asset('front/assets/images/download.png')}}"></div>
                        </div>
                        <div class="col-sm-6">
                           <h2>Hasslefree Entry-Exit Process For All Your Visitors</h2>
                           <p>Advance from manual entry and visitor logbooks with a smart visitor management system thus saving time and environment. We provide a mobile app based gate management solution that ensures a smooth, quick and pleasant entry-exit experience to all your visitors at the same time ensuring optimum security for the premises by restricting unauthorized visitors from entering and recording the time-stamps, photos and other details of visitors, daily help providers, cabs & delivery personnels.</p>
                           <!-- <a href="javascript:void"><button style="font-size:14px;width:20px;" type="button" class="btn btn-danger">READ MORE</button></a> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <footer id="footer">
            <div class="footer">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="footer-content">
                           <div class="logo-footer">
                              <img src="{{asset('front/assets/images/1footerlogo.jpg')}}">
                           </div>
                           <p>Super Prime Facility.com is a most comprehensive cloud-based society management and accounting software for Cooperative Housing Societies, Housing Society Federation and Resident or Apartment Welfare Association in India.</p>
                        </div>
                        <!-- Applogo div starts here -->
                        <h3 class="center"><strong>Download Super Prime Facility App</strong></h3>
                        <!-- Applogo div ends here -->
                     </div>
                     <div class="col-md-4">
                        <div class="footer-content">
                           <h3>Our Company Policy</h3>
                           <nav>
                              <ul class="nav nav-pills nav-stacked">
                                 <li><a href="javascript:void">Privacy Policy</a></li>
                                 <li><a href="javascript:void">Terms &amp; Conditions</a></li>
                                 <li><a href="javascript:void">Copy Right Policy</a></li>
                              </ul>
                           </nav>
                           <h3>Other Related Pages</h3>
                           <nav>
                              <ul class="nav nav-pills nav-stacked">
                                 <li><a href="javascript:void">Connect</a></li>
                                 <li><a href="javascript:void">Our Team</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="footer-content">
                           <h3>Follow us to get Housing Society Updates</h3>
                           <a class="twitter-follow-button" href="javascript:void">Follow @Theprimestar</a>
                           <a class="twitter-timeline"
                              href="javascript:void"
                           data-tweet-limit="0"></a>
                           <div class="ms_applogo">
                              <a href="javascript:void" target="_blank">
                                 <div class="app_logo margin-right-5">
                                    <img src="{{asset('front/assets/images/googleplay.png')}}" alt="Society Management Software Android App">
                                 </div>
                              </a>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="subfooter">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p style="text-align: center;">2022 @ SuperPrimeFacility All Rights Reserved.</p>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <div class="hidden">
            <input type="text" id="copy-text" value="">
         </div>
         <a class="advertise-with-us  btn btn-info hidden-xs hidden-sm" href="javascript:void">Advertise with us</a>
         <div id="my-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div id="my-modal-content">
                  </div>
               </div>
            </div>
         </div>
         <div id="enquiry-popup-model" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Enquiry of Housing Society Management Software</h4>
                           </div>
                           &nbsp;<small><span class="red-text"> * marked fields are mandatory</span></small>
                           <form autocomplete="off" id="submit-society-register-form" method="post" action="">
                              <div class="alert alert-dismissible alert-success form-success hidden" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <span class="alert-message success-message"></span>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-xs-12">
                                       <div class="col-xs-4">
                                          <div class="radio">
                                             <label><input type="radio" name="enquiry-for" value="1">Technical Support</label>
                                          </div>
                                       </div>
                                       <div class="col-xs-4">
                                          <div class="radio">
                                             <label><input type="radio" name="enquiry-for" value="2">New Enquiry</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xs-12">
                                       <div class="custom-error" id="enquiry-for-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                       <div class="form-group">
                                          <label for="society-name">Society Name <span class="red-text required">*</span></label>
                                          <input type="text" name="society-name" id="society-name" class="form-control" placeholder="Society Name" value="">
                                       </div>
                                       <div class="custom-error" id="society-name-error">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                       <div class="form-group">
                                          <label for="no-of-register-member">No. Of Members<span class="red-text required">*</span></label>
                                          <input type="text" name="no-of-register-member" class="form-control" id="no-of-register-member" placeholder="No. of Member" value="">
                                       </div>
                                       <div class="custom-error" id="no-of-register-member-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                       <div class="form-group">
                                          <label for="location">Location<span class="red-text required">*</span></label>
                                          <input type="text" name="location" class="form-control" id="location" placeholder="Mumbai, New Mumbai,Pune etc" value="">
                                       </div>
                                       <div class="custom-error" id="location-error">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                       <div class="form-group">
                                          <label for="location">Product Name<span class="red-text required">*</span></label>
                                          <div class="form-group">
                                             <select class="form-control" id="sel1" name="lead_type">
                                                <option value="erp">ERP Software</option>
                                                <option value="gate_management">Visitor Management Software</option>
                                                <option value="both">Both</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="custom-error" id="location-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label for="lead-name">Name <span class="red-text required">*</span></label>
                                          <input type="text" name="lead-name" id="lead-name" class="form-control" placeholder="Name" value="">
                                       </div>
                                       <div class="custom-error" id="lead-name-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-7">
                                       <div class="form-group">
                                          <label for="email-address">Email Address <span class="red-text required">*</span></label>
                                          <input type="text" name="email-address" class="form-control" id="email-address" placeholder="Email Address" value="">
                                       </div>
                                       <div class="custom-error" id="email-address-error">
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                       <div class="form-group">
                                          <label for="contact-number">Contact Number <span class="red-text required">*</span></label>
                                          <input type="text" name="contact-number" class="form-control" id="contact-number" placeholder="Contact Number" value="">
                                       </div>
                                       <div class="custom-error" id="contact-number-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       <div class="form-group">
                                          <div class="g-recaptcha" id="society-register-recaptcha" data-sitekey="6Lek2igTAAAAAC5vjizSoefW_68WCMlZ5KfT3xaA"></div>
                                       </div>
                                       <div class="custom-error" id="society-register-recaptcha-error">
                                       </div>
                                    </div>
                                 </div>
                                 <br/>
                                 <div class="custom-error" id="submit-society-register-application-error">
                                 </div>
                                 <div class="modal-footer">
                                    <input type="hidden" name="enquiry" value="1" />
                                    <input type="hidden" name="request-from" value="0" />
                                    <input type="hidden" name="demo-request" id="lead-demo-request" value="0">
                                    <input type="hidden" name="lead-site-url" value="">
                                    <div class="form-group">
                                       <button type="submit" value="societyregisterSubmit" class="btn btn-dark">Submit</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="contact-us-popup-model" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Contact Super Prime Facility</h4>
                           </div>
                           &nbsp;<small><span class="red-text"> * marked fields are mandatory</span></small>
                           <form autocomplete="off" id="contact-us-popup-form" action="" method="post">
                              <div class="alert alert-dismissible alert-success form-success hidden" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <span class="alert-message success-message"></span>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       <div class="form-group">
                                          <label for="name">Name <span class="red-text required">*</span></label>
                                          <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="">
                                       </div>
                                       <div class="custom-error" id="name-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="mobile">Mobile<span class="red-text required">*</span></label>
                                          <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="">
                                       </div>
                                       <div class="custom-error" id="mobile-error">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="email">Email <span class="red-text required">*</span></label>
                                          <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="">
                                       </div>
                                       <div class="custom-error" id="email-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="subject">Subject <span class="red-text required">*</span></label>
                                          <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="">
                                       </div>
                                       <div class="custom-error" id="subject-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       <div class="form-group">
                                          <label for="message">Message <span class="red-text required">*</span></label>
                                          <textarea name="message" class="form-control" id="message" placeholder="Message"></textarea>
                                       </div>
                                       <div class="custom-error" id="message-error">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <p>
                                          A -502 Charkop Omsiddhivinayak CHS,
                                          Plot No. 50, RDP-II Sector -2A,
                                          Charkop, Kandivali (West)
                                          Mumbai - 400067
                                       </p>
                                       <p><a href="tel:+911234567890"><i class="fa fa-phone"></i>(+91) 1234567890</a></p>
                                       <p><a href="tel:02228671090"><i class="fa fa-phone"></i>(+91) 022-28671090</a></p>
                                       <p><a href="tel:02228681092"><i class="fa fa-phone"></i>(+91) 022-28681092</a></p>
                                       <p><i class="fa fa-envelope"></i>  &nbsp;info@SuperPrimeFacility.com  </p>
                                    </div>
                                 </div>
                                 <br/>
                                 <div class="modal-footer">
                                    <button type="submit" value="contactusSubmit" class="btn btn-dark">Get In Touch</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
   <!-- jQuery library -->
   <script src="{{asset('front/assets/js/jquery.min.js')}}"></script>
   <!-- Latest compiled JavaScript -->
   <script src="{{asset('front/assets/js/bootstrap.min.js')}}"></script>
</html>
