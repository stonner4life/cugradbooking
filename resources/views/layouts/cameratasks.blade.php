<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="/css/bootstrap-glyphicons.css" />

    <link href='/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='/css/jquery.qtip.min.css' rel='stylesheet' />
    <link href='/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />


    {{--Kanit Font--}}
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Styles -->

    <!-- GIF WHILE LOAD -->
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


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

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
            </ul>

            @endif
        </div>
    </nav>
    @include('layouts.flash')
    @yield('content')

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

<!--ALL CALENDAR -->
<script src='/js/lib/moment.min.js'></script>
<script src='/js/locale/th.js'></script>
<script src="/js/bootstrap-datetimepicker.js"></script>
<script src="/js/select2.min.js"></script>
<script src='/js/fullcalendar.min.js'></script>
<script src='/js/jquery.qtip.min.js'></script>
<script src='/js/locale/th.js'></script>


<!-- CarTask Calendar JavaScript -->
<script>
    $(document).ready(function()
    {
        // ajax request roomtasks
        $.ajax({
            url: "/calendarcameradata",
        })
                .done(function (data)
                {
                    var cameraevents=[];
                    // loop for keep roomtasks

                    for(var k =0; k < data.length; k++)
                    {
                        cameraevents.push
                        ( {
                            title: data[k].description,
                            start: data[k].start_at,
                            end: data[k].finish_at,
                            name:data[k].user.name,
                            role:data[k].user.roles.name,
                            sub_role:data[k].user.subroles.name,
                            description: data[k].description,
                            backgroundColor: '#ff0066'
                        })

                    }


                    $('#calendar').fullCalendar({


                        editable: false,
                        lang:'th',
                        navLinks: true, // can click day/week names to navigate views
                        eventLimit: true, // allow "more" link when too many events
                        header:
                        {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listMonth'
                        },

                        eventSources: [cameraevents],

                        eventRender: function(event, element)
                        {

                            $(element).qtip({

                                style:{
                                    classes: 'qtip-bootstrap',
                                    textAlign: 'center',
                                },

                                content:
                                {

                                    title: event.room_id,

                                    text:
                                    "<strong>รายละเอียด:</strong> "+event.description+"<br/>"
                                    +"<strong>ผู้จอง:</strong> "+event.name+"<br/>"
                                    +"<strong>กลุ่มภารกิจ:</strong> "+event.role+"<br/>"
                                    +"<strong>สหสาขา:</strong> "+event.sub_role+"<br/>"

                                },

                            })
                        }

                    });
                });
    });



</script>



{{--DATETIME PICKER--}}
<script type="text/javascript">
    $(function () {

        $('#start_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#finish_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $("#start_at").on("dp.change", function (e) {
            $('#finish_at').data("DateTimePicker").minDate(e.date);
        });
        $("#finish_at").on("dp.change", function (e) {
            $('#start_at').data("DateTimePicker").maxDate(e.date);
        });

        //For CarTask//

        $('#carstart_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#carfinish_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $("#start_att").on("dp.change", function (e) {
            $('#carfinish_at').data("DateTimePicker").minDate(e.date);
        });
        $("#finish_att").on("dp.change", function (e) {
            $('#carstart_at').data("DateTimePicker").maxDate(e.date);
        });

        //For CameraTask//

        $('#camstart_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#camfinish_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $("#camstart_at").on("dp.change", function (e) {
            $('#camfinish_at').data("DateTimePicker").minDate(e.date);
        });
        $("#camfinish_at").on("dp.change", function (e) {
            $('#camstart_at').data("DateTimePicker").maxDate(e.date);
        });
    });

</script>

{{--FOR ROOMLIST DEVICES SELECT2 --}}
<script type="text/javascript">
    $('#good_List').select2({
        width: '100%',
        placeholder:' เพิ่มอุปกรณโสตฯ',

    });
</script>

{{--FOR ROOMTASK DEVICES SELECT2 --}}
<script type="text/javascript">
    $('#good_Lists').select2({
        width: '100%',
        placeholder:' เพิ่มอุปกรณโสตฯ',

    });
</script>


{{--Show GIF while load--}}
<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });
    });

</script>

@stack('scripts')
</body>
</html>
