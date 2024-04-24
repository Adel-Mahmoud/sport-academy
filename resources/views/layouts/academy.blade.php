<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>Sports Academy</title>
    <!-- Icons -->
    <!-- Main styles for this application -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@600&display=swap" rel="stylesheet">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custome_style.css')}}" rel="stylesheet">
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <style>
      *{
        font-family: 'Noto Kufi Arabic', sans-serif;
      }
    </style>
  </head>
<body class="navbar-fixed sidebar-nav fixed-nav" style="height:100vh !important;">
    <!--
    <div id="loading-image" class="loading-image">
        <img src="{{asset('img/loader1.gif')}}"/>
    </div>
    -->
    <header class="navbar">
        <div class="container-fluid">
            <div class="container-logo">
              <img class="logo" src="{{ asset('images/logo/'.$settings['logo']) }}"/>
            </div>
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        </div>
    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-tachometer-alt"></i> لوحة التحكم 
                    <!--
                    <span class="tag tag-info">جدید</span>
                    -->
                    </a>
                </li>
                <li class="nav-title">
                   ادارة البرنامج
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-dumbbell"></i> الانشطة</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sports') }}" target="_top"> كل الانشطة</a>
                        </li>
                        @foreach ($sports_links as $sport)
                          <li class="nav-item">
                              <a class="nav-link" href="{{url('sports/'.$sport->id)}}" target="_top">{{$sport->sport_name}}</a>
                          </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-football-ball"></i> الفرق</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('teams') }}" target="_top"> كل الفرق</a>
                        </li>
                        @foreach ($teams_links as $team)
                          <li class="nav-item">
                              <a class="nav-link" href="{{url('teams/'.$team->id)}}" target="_top">{{$team->team_name}}</a>
                          </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('coaches') }}"><i class="fa fa-chalkboard-teacher"></i> المدربين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('players') }}"><i class="fa fa-running"></i> اللاعبين</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-invoice-dollar"></i> سجل الإشتراكات</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('paid') }}" target="_top"> اللاعبين المشتركين</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('unpaid') }}" target="_top"> اللاعبين الغير مشتركين</a>
                        </li>
                    </ul>
                </li>
                <!--
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-briefcase"></i> الوظائف</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('jobs') }}" target="_top"> كل الوظائف</a>
                        </li>
                        @foreach ($jobs_links as $job)
                          <li class="nav-item">
                              <a class="nav-link" href="{{url('jobs/'.$job->id)}}" target="_top">{{$job->job_name}}</a>
                          </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('employees')}}"><i class="fa fa-user-tie"></i> الموظفين</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-money-bill-wave"></i> المرتبات</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('salary_paid') }}" target="_top">سجل الرواتب المدفوعة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('salary_unpaid') }}" target="_top">سجل الرواتب الغير المدفوعة</a>
                        </li>
                    </ul>
                </li>
                -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('expenses') }}"><i class="fa fa-money-bill-alt"></i> المصروفات</a>
                </li>
                @if(Auth::user()->role == 2)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('users') }}"><i class="fa fa-users"></i> المستخدمين</a>
                </li>
                @endif
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('settings') }}"><i class="fa fa-cogs"></i> إعداد النظام</a>
                </li>
            </ul>
        </nav>
    </div>
    <main class="main">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ url('/') }}">الرئيسية</a>
          </li>
          <li class="breadcrumb-item">{{ Auth::user()->name }}</li>
          <li class="breadcrumb-item active">
              <a class="text-danger" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  تسجيل الخروج
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>
        </ol>
    </main>
    <!-- Main content -->
    <div class="container-fluid">
      <main class="main">
           @yield('section')
      </main>
    </div>
    <aside class="aside-menu">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
            </li>
        </ul>
    </aside>
    <main class="main main-footer" style="display:none;">
      <footer class="footer">
          <span class="">
              <a href="#">Sports Academy</a> &copy; 2023 creativeLabs.
          </span>
          <span class="pull-right">
              Powered by <a href="#">Adel</a>
          </span>
      </footer>
    </main>
    <br /><br />
    <script src="js/libs/tether.min.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @if(session('add_success'))
    <script>
        swal("تم", "تمت إضافة البيانات بنجاح!", "success");
        {{ session()->forget('add_success') }}
    </script>
    @endif
    @if(session('edit_success'))
    <script>
        swal("تم", "تم تعديل البيانات بنجاح!", "success");
        {{ session()->forget('edit_success') }}
    </script>
    @endif
    @if(session('warning'))
    <script>
        swal(
          "تنبيه",
          " المبلغ غير متوفر!",
          "warning");
        {{ session()->forget('warning') }}
    </script>
    @endif
</body>
</html>