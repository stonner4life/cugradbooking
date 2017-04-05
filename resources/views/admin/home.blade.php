@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">ปฏิทินการจอง</div>

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
                        <button type="button" class="btn btn-default btn-lg btn-block"
                                onclick="window.location='{{ url("cartasks/create") }}'">จองรถ</button>
                        <button type="button" class="btn btn-default btn-lg btn-block"
                                onclick="window.location='{{ url("cameratasks/create") }}'">จองพนักงานถ่ายภาพ</button>
                    </div>
                    <div class="panel-heading" style="text-align: center">เลือกทำรายการสำหรับผู้ดูแลระบบ</div>

                    <div class="panel-body" >
                        <button type="button" onclick="window.location='{{ url("register") }}'"
                        class="btn btn-default btn-lg btn-block">เพิ่มผู้ใช้ในระบบ</button>

                        <button type="button"  data-toggle="modal" data-target="#roomModal"
                        class="btn btn-default btn-lg btn-block">เพิ่มห้องประชุม</button>

                        <button type="button" data-toggle="modal" data-target="#carModal"
                        class="btn btn-default btn-lg btn-block">เพิ่มยานพาหนะ</button>

                        <button type="button"  data-toggle="modal" data-target="#cameraModal"
                        class="btn btn-default btn-lg btn-block">เพิ่มเจ้าหน้าที่ถ่ายรูป</button>

                        <button type="button"  data-toggle="modal" data-target="#driverModal"
                                class="btn btn-default btn-lg btn-block">เพิ่มพนักงานขับรถ</button>
                    </div>
                    @include('modal.adddriver')
                </div>

                <style>
                    ul {

                    }

                    .input-color {
                        position: relative;
                    }
                    .input-color input {
                        padding-left: 20px;
                    }
                    .input-color .color-box {
                        width: 10px;
                        height: 10px;
                        display: inline-block;
                        background-color: #ccc;
                        position: absolute;
                        left: 5px;
                        top: 5px;
                    }
                </style>
                <ul>

                        <div class="input-color">
                            <input type="text" value="รายการจองห้องประชุม" />
                            <div class="color-box" style="background-color: #2baeef;"></div>
                        </div>


                        <div class="input-color">
                            <input type="text" value="รายการจองยานพาหนะ" />
                            <div class="color-box" style="background-color: #ff0066;"></div>
                        </div>


                        <div class="input-color">
                            <input type="text" value="รายการจองพนักงานถ่ายภาพ" />
                            <div class="color-box" style="background-color: #28CD52;"></div>
                        </div>
                </ul>

                @include('modal.addroom')

            </div>
        </div>
    </div>
   @include('modal.addcar')
    @include('modal.addcamman')






@endsection
