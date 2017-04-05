
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">



    {{--Kanit Font--}}
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Styles -->
    <style>
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(/images/Preloader_3.gif) center no-repeat #fff;
        }


    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/kanit.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
<div class="se-pre-con"></div>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">


            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                </button>
                <!-- Branding Image -->
                <div><img class="logo" src="/images/prakeaw.png" style="width: 30px; height: 50px;"></div>

            </div>


            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;  <a class="navbar-brand" href="{{ url('home') }} " >
                    {{ config('app.name', 'Laravel') }}
                </a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
                    <li><a href="{{ url('/register') }}">ลงทะเบียน</a></li>

                @elseif( Auth::user()->role == 1 )   {{-- 1-->ADMIN--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{{ url('/home') }}">
                                <span class="glyphicon glyphicon-home"  ></span>
                                หน้าหลัก
                            </a>
                        </li>

                        <li>
                            <a href="/users/{{ Auth::user()->id }}/edit">
                                <span class="glyphicon glyphicon-user"  ></span>
                                ประวัติส่วนตัวของฉัน
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('alllists') }}">
                                <span class="glyphicon glyphicon-blackboard"  ></span>
                                ห้องประชุมและยานพาหนะในระบบ
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/users/booklist') }}">
                                <span class="glyphicon glyphicon-list-alt"  ></span>
                                ประวัติการจองของฉัน
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/admin/booklist/all') }}">
                                <span class="glyphicon glyphicon-list-alt" href="{{ url('/datatables/show') }}" ></span>
                                ประวัติการจองทั้งหมด
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"  ></span>
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

                @elseif( Auth::check() && Auth::user()->role >1 && Auth::user()->role <=6) {{-- 2-6 ->NORMAL USER--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{{ url('/home') }}">
                                <span class="glyphicon glyphicon-home"  ></span>
                                หน้าหลัก
                            </a>
                        </li>

                        <li>
                            <a href="/users/{{ Auth::user()->id }}/edit">
                                <span class="glyphicon glyphicon-user"  ></span>
                                ประวัติส่วนตัวของฉัน
                            </a>
                        </li>



                        <li>
                            <a href="{{ url('/alllists') }}">
                                <span class="glyphicon glyphicon-blackboard"  ></span>
                                ห้องประชุมและยานพาหนะในระบบ
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/users/booklist') }}">
                                <span class="glyphicon glyphicon-list-alt"  ></span>
                                ประวัติการจองของฉัน
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"  ></span>
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

                @elseif( Auth::user()->role == 10 ) {{-- 10-->SAHA USER--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{{ url('/home') }}">
                                <span class="glyphicon glyphicon-home"  ></span>
                                หน้าหลัก
                            </a>
                        </li>

                        <li>
                            <a href="/users/{{ Auth::user()->id }}/edit">
                                <span class="glyphicon glyphicon-user"  ></span>
                                ประวัติส่วนตัวของฉัน
                            </a>
                        </li>



                        <li>
                            <a href="{{ url('/alllists') }}">
                                <span class="glyphicon glyphicon-blackboard"  ></span>
                                ห้องประชุมและยานพาหนะในระบบ
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/users/booklist') }}">
                                <span class="glyphicon glyphicon-list-alt"  ></span>
                                ประวัติการจองของฉัน
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"  ></span>
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

                @elseif( Auth::user()->role == 7 ) {{-- 7-->Driver USER--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{{ url('/home') }}">
                                <span class="glyphicon glyphicon-home"  ></span>
                                หน้าหลัก
                            </a>
                        </li>

                        <li>
                            <a href="/users/{{ Auth::user()->id }}/edit">
                                <span class="glyphicon glyphicon-user"  ></span>
                                ประวัติส่วนตัวของฉัน
                            </a>
                        </li>



                        <li>
                            <a href="{{ url('/alllists') }}">
                                <span class="glyphicon glyphicon-blackboard"  ></span>
                                ห้องประชุมและยานพาหนะในระบบ
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/users/booklist') }}">
                                <span class="glyphicon glyphicon-list-alt"  ></span>
                                รายละเอียดการจองยานพาหนะในระบบ
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"  ></span>
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @elseif( Auth::user()->role == 8 ) {{-- 10-->Camera man USER--}}

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="{{ url('/home') }}">
                                <span class="glyphicon glyphicon-home"  ></span>
                                หน้าหลัก
                            </a>
                        </li>

                        <li>
                            <a href="/users/{{ Auth::user()->id }}/edit">
                                <span class="glyphicon glyphicon-user"  ></span>
                                ประวัติส่วนตัวของฉัน
                            </a>
                        </li>



                        <li>
                            <a href="{{ url('/alllists') }}">
                                <span class="glyphicon glyphicon-blackboard"  ></span>
                                ห้องประชุมและยานพาหนะในระบบ
                            </a>
                        </li>


                        <li>
                            <a href="{{ url('/users/booklist') }}">
                                <span class="glyphicon glyphicon-list-alt"  ></span>
                                ประวัติการจองของฉัน
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"  ></span>
                                ออกจากระบบ
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            @endif
        </div>
    </nav>
    @include('layouts.flash')
    @yield('content')

</div>
</div>



<!-- jQuery -->
<script  src="/js/jquery-2.1.3.min.js"></script>

<!-- DataTables -->
<script src="/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="/js/bootstrap.min.js"></script>
<!-- DataButton -->
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<!-- Datatable Print Button -->
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<!-- Datatable JS Button -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<!-- Datatable PDF Button -->
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
<!-- Datatable VFS font Button -->
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>

<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>



{{--Show GIF while load--}}
<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });
    });
</script>
<!-- App scripts -->
@stack('scripts')
</body>
</html>