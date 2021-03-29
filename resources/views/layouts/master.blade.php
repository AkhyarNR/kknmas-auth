<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KKN MAs</title>

   <!-- Icon Page -->
   <link rel="shortcut icon" href="https://adminlte.io/docs/3.0/assets/img/AdminLTELogo.png" />
   <!-- Bootstrap -->
   <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
   <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
   <!-- Font Awesome -->
   <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
   <!-- NProgress -->
   <link href="{{ asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
   <!-- iCheck -->
   <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
   <!-- bootstrap-wysiwyg -->
   <link href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
   <!-- Select2 -->
   <link href="{{ asset('assets/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
   <!-- Switchery -->
   <link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
   <!-- starrr -->
   <link href="{{ asset('assets/vendors/starrr/dist/starrr.css')}}" rel="stylesheet">
   <!-- bootstrap-daterangepicker -->
   <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
   <!-- Datatables -->    
   <link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
   <!-- Custom Theme Style -->
   <link href="{{ asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
   <link href="{{ asset('sweatalert/sweetalert.css')}}" rel="stylesheet">

    <!-- Kendo -->
   <link href="{{ asset('css/kendo.common.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/kendo.material.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/kendo.material.mobile.min.css') }}" rel="stylesheet">

  <script src="https://kendo.cdn.telerik.com/2020.1.406/js/jquery.min.js"></script>
   <script src="https://kendo.cdn.telerik.com/2020.1.406/js/kendo.all.min.js"></script>
   <script src="https://kendo.cdn.telerik.com/2018.2.620/js/cultures/kendo.culture.id-ID.min.js"></script>
   <script type="text/javascript">
     function calcDate(startDate) {
        var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date(startDate);
            // var secondDate = new Date(EndDate);
            var secondDate = new Date(Date.now());
            console.log(firstDate);
            console.log(secondDate);
            var diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
            return diffDays;
      }
   </script>

<style>
.k-header{
  background-color: #2a3f53;
}
.k-grid .k-header .k-button{
  background-color: #2a3f53;
  border-color:  #2a3f53;
  box-shadow: none;
}
.k-grid .k-header .k-button:hover{
  background-color: #7e96ac;
  border-color:  #7e96ac;
}
.k-tabstrip-items .k-link
{
  background-color: #192d41;
  border-color:  #192d41;
  box-shadow: none;
}

.k-tabstrip-items .k-link:hover
{
  background-color: #7e96ac;
  border-color:  #7e96ac;
  box-shadow: none;
}

.k-tabstrip-items{
  padding: 5px;
}

  </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/beranda') }}" class="site_title"><img src="https://adminlte.io/docs/3.0/assets/img/AdminLTELogo.png" width="40" height="40"> <span>KKN MAs</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/user2-160x160.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Main Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('/beranda') }}"><i class="fa fa-home"></i> Home </a></li>
                  <li><a><i class="fa fa-folder-open" aria-hidden="true"></i> Master<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/periode') }}">Periode</a></li>
                      <li><a href="{{ url('/universitas') }}">Universitas</a></li>
                      <li><a href="{{ url('/mitra') }}">Mitra</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('/pendaftar') }}"><i class="fa fa-user"></i> Pendaftar KKN </a></li>
                  <!-- <li><a><i class="fa fa-user"></i> Pendaftar KKN<span class="fa fa-chevron-down"></span></a> -->
                    <!-- <ul class="nav child_menu">
                      <li><a href="{{ url('pasien/Pasien') }}">Daftar Peserta</a></li>
                    </ul> -->
                  </li>

                  <li><a><i class="fa fa-user" aria-hidden="true"></i> Dosen Pendamping<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/dpl') }}">Daftar Dosen Pendamping</a></li>
                      <li><a href="{{ url('/nilai') }}">Daftar Input Nilai</a></li>
                    </ul>
                  </li>


                  <li><a><i class="fa fa-archive" aria-hidden="true"></i> Resume <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/rekap_baju') }}">Rekap Ukuran Baju</a></li>
                      <li><a href="{{ url('/kelompok') }}">Pembagian Kelompok</a></li>
                      <li><a href="{{ url('/lokasi') }}">Daftar Lokasi KKN</a></li>
                    </ul>
                  </li>    
                  <li><a href="{{ url('/perijinan') }}"><i class="fa fa-file"></i> Surat Perijinan </a></li>
                  <!-- <li><a><i class="fa fa-file-archive-o" aria-hidden="true"></i> Surat Perijinan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('#')}}">Daftar Rekam Medis</a></li>
                    </ul>
                  </li>     -->
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

<!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/user2-160x160.jpg" alt="...">{{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profil</a>
                      <a class="dropdown-item"  href="javascript:;"><i class="fa fa-refresh pull-right"></i>Ubah Password</a>
                      {{-- <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a> --}}
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i>
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>

                    </div>
                  </li>

                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            KKN Muhammadiyah Aisyiyah by UTC2021
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{ asset('assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
    <script src="{{ asset('assets/vendors/google-code-prettify/src/prettify.js')}}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- Autosize -->
    <script src="{{ asset('assets/vendors/autosize/dist/autosize.min.js')}}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{ asset('assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
    <!-- starrr -->
    <script src="{{ asset('assets/vendors/starrr/dist/starrr.js')}}"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{ asset('sweatalert/sweetalert.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/build/js/custom.min.js')}}"></script>
    <script src="{{ asset('jszip/dist/jszip.js') }}"></script>
    <script src="{{ asset('js/kendo.all.min.js') }}"></script>
    <script>
      $(function () {
          moment.locale("id");
          kendo.culture("id-ID");
      })

  </script>
  @include('sweetalert::alert')
  </body>
</html>