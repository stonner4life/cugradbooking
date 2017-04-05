@extends('layouts.cameratasks')

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
                    <div class="panel-heading" style="text-align: center">จองพนักงานถ่ายภาพ</div>

                    <div class="panel-body" >
                        <form method="post" action="/cameratask/create">

                            {{ csrf_field() }}


                            <div class="form-group">
                                <label>ตั้งแต่วัน/เวลา:</label>
                                <div class='input-group date' id='camstart_at'>
                                    <input name="start_at" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>จนถึงวัน/เวลา:</label>
                                <div class='input-group date' id='camfinish_at'>
                                    <input name="finish_at" type='text' class="form-control" />
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="place">สถานที่:</label>
                                <select class="form-control" name="place">

                                    <option>ภายใน กรุงเทพและปริมณฑล</option>
                                    <option>ภายนอก กรุงเทพและปริมณฑล</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">รายละเอียดการจอง:</label>
                                <textarea class="form-control" name="description" rows="2" ></textarea>
                            </div>


                            <div class="form-group">
                                <label for="contactNumber">เบอร์โทรศัพท์ที่ติดต่อได้:</label>
                                <textarea class="form-control" name="contactNumber" rows="1" ></textarea>
                            </div>



                            <div class="form-group">
                                <label for="cameraMan">พนักงานถ่ายภาพ :</label>
                                <select class="form-control" name="cameraMan">
                                    @foreach($cameramans as $cameraman)
                                        <option>  {{$cameraman->name}} {{$cameraman->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>


                            @include('layouts.errors')
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="submit"  class="btn btn-primary">จอง</button>
                                    <button type="button" onclick="history.back()" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
