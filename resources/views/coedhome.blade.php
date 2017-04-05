@extends('layouts.cartasks')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        ปฏิทินการจอง
                    </div>

                    <div class="panel-body">

                        <div id='calendar'></div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">เลือกทำรายการ</div>

                    <div class="panel-body" >

                        <button type="button" class="btn btn-default btn-lg btn-block"
                                onclick="window.location='{{ url("roomtasks/create") }}'">จองห้องประชุม</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
