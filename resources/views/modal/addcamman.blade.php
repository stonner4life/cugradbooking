
<!-- Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" data-backdrop="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cameraModalLabel">กรอกรายละเอียดของพนักงานถ่ายภาพ</h4>
            </div>
            <div class="modal-body">
                <style>
                    .form-control {
                        display: inline-block;
                    }
                    .modal-backdrop {
                        z-index: -1;
                    }
                </style>

                <form method="post" action="/cameraman/create">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="image" class="control-label"> รูปเจ้าหน้าที่ถ่ายภาพ:</label>
                        <input id="input-1" type="file" class="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="description">ชื่อ :</label>
                        <textarea class="form-control" name="name" rows="1" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">นามสกุล :</label>
                        <textarea class="form-control" name="lastname" rows="1" ></textarea>
                    </div>


                    <div class="form-group">
                        <label for="phoneNumber">เบอร์โทรศัพท์ที่ติดต่อได้:</label>
                        <textarea class="form-control" name="phoneNumber" rows="1" ></textarea>
                    </div>


                    @include('layouts.errors')
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary">เพิ่ม</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

                        </div>

                    </div>
                </form>



            </div>

        </div>
    </div>
</div>