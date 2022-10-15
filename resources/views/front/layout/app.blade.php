<!DOCTYPE html>
<html lang="en">
<head>
    <title>Super Prime Facility</title>
      <!-- Mobile Meta -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Web Fonts -->

    @yield('title')
    @yield('inlinecss')


      <link href="{{asset('front/assets/css/staticpage.min.css')}}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
      <link href="{{asset('front/assets/css/custom.css')}}" rel="stylesheet" type="text/css">
    <style>
        #searchdata:not( :hover ){
        display:none;
        }
        /* The snackbar - position it at the bottom and in the middle of the screen */
        #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        min-width: 250px; /* Set a default minimum width */
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 30px; /* 30px from the bottom */
        }
        /* Show the snackbar when clicking on a button (class added with JavaScript) */
        #snackbar.show {
        visibility: visible; /* Show the snackbar */
        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        /* Animations to fade the snackbar in and out */
        @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }
        @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }
        @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }
        @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }
    </style>

</head>
    <div class="scrollToTop"><i class="icon-up-open-big"></i></div>
        <div class="page-wrapper">
            <div class="header-top">
                <div class="container">
                <div class="row">
                    <div class="col-xs-2 col-sm-6">
                        <div class="header-top-first clearfix">
                            <ul class="social-links clearfix hidden-xs">
                            <li class="facebook"><a  href="javascript:void" style="color:white"><i class="fa fa-facebook" style="color:white"></i></a>
                            </li>
                            <li class="twitter"><a  href="javascript:void" style="color:white"><i class="fa fa-twitter" style="color:white"></i></a>
                        </li>
                        <li class="linkedin"><a  href="javascript:void"><i class="fa fa-linkedin" style="color:white"></i></a>
                    </li>
                    <li class="linkedin"><a  href="javascript:void"><i class="fa fa-youtube" style="color:white"></i></a>
                </li>
                <li class="linkedin"><a  href="javascript:void" style="color:white"></i></a>
                </li>
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
<!--  messages -->
    <header id="site-header" class="header fixed clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="header-left clearfix">
                    <div class="logo">
                        <a href="javascript:void"><img id="logo" src="assets/images/myslogo.png" alt="SuperPrimeFacility"></a>
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
                                    <li class="active ">
                                        <a href="index.html" >Home</a>
                                    </li>
                                    <li>
                                        <a href="about.html" >About us</a>
                                    </li>
                                    <li class="dropdown" >
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Features</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="blog.html">Blogs</a></li>
                                            <li><a href="media.html">Media</a></li>
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
                                        <a href="contact.html" >Contact us </a>
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

    @yield('content')

    <!-- Footer -->
    <footer id="footer">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                    <div class="footer-content">
                        <div class="logo-footer">
                            <img src="assets/images/1footerlogo.jpg">
                        </div>
                        Super Prime Facility.com is a most comprehensive cloud-based society management and accounting software for Cooperative Housing Societies, Housing Society Federation and Resident or Apartment Welfare Association in India.</p>
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
                        <!-- <script async src="https://platform.twitter.com/widgets.js"></script>  -->
                        <div class="ms_applogo">
                            <a href="javascript:void" target="_blank">
                                <div class="app_logo margin-right-5">
                                <img src="https://mysocietyclub.com/assets/images/newimg/google-play-apps.png" alt="Society Management Software Android App">
                                </div>
                            </a>
                            <!-- <a href="javascript:void" target="_blank">
                                <div class="app_logo">
                                    <img src="https://mysocietyclub.com/assets/images/newimg/iOS-app.png" alt="Society Management Software iOS App">
                                </div>
                                </a> -->
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
                    <!-- <div class="col-md-8">
                    <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-2">
                        <ul class="nav navbar-nav">
                            <li><a href="javascript:void" target="_blank">Blog</a></li>
                            <li><a href="javascript:void">About Us</a></li>
                            <li><a href="javascript:void">FAQ's</a></li>
                            <li><a href="javascript:void">Contact Us</a></li>
                            <li><a href="javascript:void">Feedback</a></li>
                            <li><a href="javascript:void">Technical Support</a></li>
                            <li><a href="javascript:void">Customer Support</a></li>
                            <li><a href="javascript:void" target="_blank">Career</a></li>
                        </ul>
                    </div>
                    </nav>
                    </div> -->
                </div>
            </div>
        </div>
    </footer>



    <!-- <script src="https://mysocietyclub.com/assets/min-js/staticpage.min.js?v=27.15"></script> -->
    <!-- Google Code for Remarketing Tag -->
    <script>
            /* <![CDATA[ */
            var google_conversion_id = 940278076;
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;
            /* ]]> */
            </script>
            <!-- <script src="//www.googleadservices.com/pagead/conversion.js"></script> -->
            <!--             <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/940278076/?guid=ON&amp;script=0"/>;
            </div>
            </noscript> -->
            <div class="hidden">
            <div id="loader">
            <br/>
            <div style="text-align: center;margin:auto;opacity:0.5">
            <img src="https://mysocietyclub.com/assets/images/spinner2.gif" alt="Mini Loader" width="200" height="200">
            </div>
            </div>
            <div id="mini-loader">
            <img class="mini-loader-image" style="text-align:center; display:inline;" src="https://mysocietyclub.com/assets/images/wait16.gif" alt="Mini Loader" width="20" height="20">
            </div>
            </div>
            </body>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <!-- jQuery library -->
            <script src="assets/js/jquery.min.js"></script>
            <!-- Latest compiled JavaScript -->
            <script src="assets/js/bootstrap.min.js"></script>
            <script>
            $(document).ready(function(){
            $("#flip").click(function(){
            $("#panel").slideToggle("slow");
            });
            });
    </script>
    @yield('inlinejs')



</body>
</html>
