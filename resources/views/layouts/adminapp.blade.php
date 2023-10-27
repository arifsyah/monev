<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitoring dan Evaluasi Kinerja Berkala | DPKP Bandung </title>

    <!-- Bootstrap core CSS -->

    <link href="{{url('/backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{url('/backend')}}/assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{url('/backend')}}/assets/css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/custom.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/jquery.Jcrop.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/jquery.fancybox.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="{{url('/backend')}}/assets/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="{{url('/backend')}}/assets/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="{{url('/backend')}}/assets/css/floatexamples.css" rel="stylesheet" type="text/css" /> -->
    

    <!-- <link href="{{url('/backend')}}/assets/css/floatexamples.css" rel="stylesheet" type="text/css" /> -->
    

    <script src="{{url('/backend')}}/assets/js/jquery.min.js"></script>
    <script src="{{url('/backend')}}/assets/js/jquery.fancybox.js"></script>
    <script src="{{url('/backend')}}/assets/js/tinymce/tinymce.min.js"></script>
    
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js" type="text/javascript"></script>

    <style>
        .form-control{
            border:1px solid #d3d3d3;
        }
        .textcenter{text-align: center !important;}
        .textright{text-align: right !important;}
        .lds-spinner {
          color: black;
          display: inline-block;
          position: relative;
          width: 80px;
          height: 80px;
        }
        .lds-ring {
          display: inline-block;
          position: relative;
          width: 80px;
          height: 80px;
        }
        .lds-ring div {
          box-sizing: border-box;
          display: block;
          position: absolute;
          width: 64px;
          height: 64px;
          margin: 8px;
          border: 8px solid #d0d0d0;
          border-radius: 50%;
          animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
          border-color: #d0d0d0 transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
          animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
          animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
          animation-delay: -0.15s;
        }
        @keyframes lds-ring {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }


    </style>
    <?php /*<script src="{{url('/backend')}}/assets/js/nprogress.js"></script>*/ ?>
    <script>
        // NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../{{url('/backend')}}/assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        function showspinner(){
            $('.x_content').html('<div class="textcenter"><div class="lds-ring"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');
        }
        (function(a) {
            (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4));
        })(navigator.userAgent || navigator.vendor || window.opera);
    </script>
</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><span>DPKP</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{url('/backend')}}/assets/images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Session::get('name') }}</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard </a></li>
                                <!-- <li><a href="{{ url('category') }}"><i class="fa fa-bookmark"></i> Kategori </a></li> -->
                                <!-- <li><a href="{{ url('subcategory') }}"><i class="fa fa-bookmark-o"></i> Sub Kategori </a></li> -->
                                <!-- <li><a href="{{ url('tag') }}"><i class="fa fa-check"></i> Tag </a></li> -->
                                <li><a href="{{ url('unit_kerja') }}"><i class="fa fa-list"></i> Unit Kerja </a></li>
                                <li><a href="{{ url('program') }}"><i class="fa fa-check"></i> Program </a></li>
                                <li><a href="{{ url('kegiatan') }}"><i class="fa fa-check-square-o"></i> Kegiatan </a></li>
                                <li><a href="{{ url('subkegiatan') }}"><i class="fa fa-check-circle"></i> Sub Kegiatan </a></li>
                                <li><a href="{{ url('kinerja') }}"><i class="fa fa-line-chart"></i> Kinerja </a></li>
                                <!-- <li><a href="{{ url('data') }}"><i class="fa fa-book"></i> Data </a></li> -->
                                <!-- <li><a href="{{ url('file') }}"><i class="fa fa-file"></i> File / Dokumen </a></li> -->
                                <!-- <li><a><i class="fa fa-briefcase"></i> Data <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ url('taman') }}">Taman</a></li>
                                        <li><a href="{{ url('lppd2020') }}">LPPD 2020</a></li>
                                    </ul>
                                </li> -->

                                <!-- <li><a href="{{ url('course') }}"><i class="fa fa-file"></i> Kelas </a></li>
                                <li><a href="{{ url('blog_categories') }}"><i class="fa fa-copy"></i> Blog Categories </a></li>
                                <li><a href="{{ url('blog') }}"><i class="fa fa-book"></i> Blog </a></li>
                                 -->
                                <!-- <li><a><i class="fa fa-image"></i> Library <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ url('image') }}">Gambar</a></li>
                                    </ul>
                                </li> -->

                                <?php 
                                if (Session::get('role') == 1) {
                                    ?>
                                    <li><a href="{{ url('logs') }}"><i class="fa fa-list"></i> Catatan Aplikasi </a></li>
                                    
                                    <?php
                                }

                                if (Session::get('role') == 1) {
                                    ?><li><a href="{{ url('users') }}"><i class="fa fa-users"></i> Pengguna </a></li><?php
                                }else{
                                    ?><li><a href="{{ route('users.edit',Session::get('id_user')) }}"><i class="fa fa-users"></i> Pengguna </a></li><?php
                                }

                                ?>

                                
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="{{ url('logout') }}" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{url('/backend')}}/assets/images/user.png" alt="">

                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="{{ route('users.edit',Session::get('id_user')) }}"><i class="fa fa-pencil pull-right"></i> Ubah Pengguna</a></li>
                                    <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <!-- <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a> -->
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('/backend')}}/assets/images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('/backend')}}/assets/images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('/backend')}}/assets/images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('/backend')}}/assets/images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
                

                <!-- footer content -->

                <footer>
                    <div class="">
                        <p class="pull-right">Monitoring dan Evaluasi Kinerja Berkala |
                            <span class="lead">DPKP Bandung</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="{{url('/backend')}}/assets/js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="{{url('/backend')}}/assets/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="{{url('/backend')}}/assets/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="{{url('/backend')}}/assets/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="{{url('/backend')}}/assets/js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="{{url('/backend')}}/assets/js/moment.min.js"></script>
    <script type="text/javascript" src="{{url('/backend')}}/assets/js/datepicker/daterangepicker.js"></script>

    <script src="{{url('/backend')}}/assets/js/custom.js"></script>

    <!-- flot js -->
    
    <script>
        $(document).ready(function () {});
    </script>

    <!-- worldmap -->
    <script type="text/javascript" src="{{url('/backend')}}/assets/js/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="{{url('/backend')}}/assets/js/jquery.Jcrop.min.js"></script>
    
    <script>
        $(function () {
            
        });
    </script>
    <!-- skycons -->
    <script src="{{url('/backend')}}/assets/js/skycons/skycons.js"></script>
    <script>
        
    </script>

    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
    <script>
        // NProgress.done();
    </script>
    <!-- /datepicker -->
    <!-- /footer content -->
</body>

</html>
