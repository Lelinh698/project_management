<button type="button" id="criteia-create" class="btn btn-primary" data-toggle="modal" 
    data-target="#modal-lg" style="float: right; bottom: 10px;">Thêm kế hoạch</button>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm kế hoạch</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form id="plancreategv" name="plancreategv" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{!! $project->id !!}">

                        <div class="form-group">
                            <label for="ketthuc">Ngày kết thúc</label>
                            <input type="date" name="ketthuc" class="form-control" placeholder="Ngày kết thúc">
                        </div>
                        <div class="form-group">
                            <label for="mota">Mô tả</label>
                            <input type="text" name="mota" class="form-control" placeholder="Mô tả">
                        </div>
                    </form>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btn-save" class="btn btn-primary" form="plancreategv">Lưu lại</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>