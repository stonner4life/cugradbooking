@extends('layouts.roomtasks')

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
                    <div class="panel-heading" style="text-align: center">จองห้องประชุม</div>

                    <div class="panel-body" >
                        <form method="post" action="/roomtasks/create">

                            {{ csrf_field() }}




                            <div class="form-group">
                                <label>ตั้งแต่วัน/เวลา:</label>
                                <div class='input-group date' id='start_at'>
                                    <input name="start_at" type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>จนถึงวัน/เวลา:</label>
                                <div class='input-group date' id='finish_at'>
                                    <input name="finish_at" type='text' class="form-control" />
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="room_id">ห้องเรียน/ห้องประชุม :</label>
                                <select class="form-control" name="room_id">
                                    @if(Auth::check() && Auth::user()->role == 1)
                                        @foreach($roomlists as $roomlist)
                                            <option value="{{$roomlist->id}}">{{$roomlist->roomname}}</option>
                                        @endforeach
                                    @elseif((Auth::check() && Auth::user()->role >1 && Auth::user()->role <=6))
                                        @foreach($roomlists as $roomlist)
                                            <option value="{{$roomlist->id}}">{{$roomlist->roomname}}</option>
                                        @endforeach
                                    @elseif(Auth::check() && Auth::user()->role==10)
                                        <option value="5">ห้องประชุมชั้น 1401 บัณฑิตวิทยาลัยชั้น 14</option>
                                        <option value="6">ห้องประชุมชั้น 1402 บัณฑิตวิทยาลัยชั้น 14</option>
                                        <option value="7">ห้องประชุมชั้น 1501 บัณฑิตวิทยาลัยชั้น 15</option>
                                        <option value="8">ห้องประชุมชั้น 1502 บัณฑิตวิทยาลัยชั้น 15</option>

                                    @endif
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="topic">เรื่องของการเรียน/การประชุม :</label>
                                <textarea class="form-control" name="topic" rows="1" ></textarea>
                            </div>



                            <div class="form-group">
                                <label for="description">คำบรรยายพอสังเขป :</label>
                                <textarea class="form-control" name="description" rows="2" ></textarea>
                            </div>



                            <div class="form-group">
                                <label for="capacity">จำนวนผู้เข้าเรียน/เข้าประชุม :</label>
                                <textarea class="form-control" name="capacity" rows="1" ></textarea>
                            </div>

                            <div class="form-group">
                                {!! Form::label('devices','อุปกรณ์โสตฯ:') !!}
                                {!! Form::select('devices[]',$devices,null,['id'=>'good_Lists','clsss'=>'form-control','multiple']) !!}
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
