@extends('adminlte::page')

@section('title','Admin')

@section('content')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Đề xuất kế hoạch của bộ môn</h4></div>
<p><a class="btn btn-primary" href="javascript:void(0)" id="create-new-departmentPlan">Thêm kế hoạch</a></p>
<?php //Hiển thị danh sách học sinh?>
<div class="card">
		<div class="card-body">
			<table id="plan_table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nhiệm vụ</th>
						<th>Mô tả nhiệm vụ</th>
						<th>Các yêu cầu cần gửi</th>
						<th>Thời gian upload</th>
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="ajax-departmentPlan-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="departmentPlanCrudModal"></h4>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="departmentPlanForm" name="departmentPlanForm" class="form-horizontal">
           <input type="hidden" name="departmentPlan_id" id="departmentPlan_id">
		   
		   		<div class="form-group">
					<label for="name">Nhiệm vụ</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Tên nhiệm vụ" maxlength="255" required />
				</div>
		
				<div class="form-group">
					<label for="description">Mô tả nhiệm vụ</label>
					<input type="text" class="form-control" id="description" name="description" placeholder="Mô tả nhiệm vụ" maxlength="255" required />
				</div>
				
				<div class="form-group">
					<label for="request">Các yêu cầu cần gửi</label>
					<textarea class="form-control" id="planrequest" name="planrequest" placeholder="Các yêu cầu cần gửi" maxlength="500" required></textarea>
				</div>
	
				<div class="form-group">
					<label for="time">Thời gian upload</label>
					<input type="date" class="form-control" id="time" name="time" placeholder="Thời gian upload" maxlength="255" required />
				</div>
		</form>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			<button type="submit" id="btn-save" class="btn btn-primary" form="departmentPlanForm">Lưu lại</button>
		</div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@section('css')
<link href="{{ asset('css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<script type="text/javascript" src="{!! url('js/moment-with-locales.js') !!}"></script>
<script type="text/javascript" src="{!! url('js/jquery.dataTables.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script>

$(document).ready( function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#plan_table').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		autoWidth: true,
		searching: false,
        info: false,
        paging: false,
        lengthChange: false,
		ajax: {
		url: "/admin/plan",
		type: 'GET',
		},
		columns: [
				{"data": 'id', name: 'id', 'visible': false},
				{ "data": "name" },
				{ "data": "description" },
				{ "data": "request" },
				{ "data": "deadline" , 
					render: function (data, type, row, meta) {
						return moment(data).format('DD-MM-YYYY');
					}
				},
			],
	});

	/*  When user click add plan button */
	$('#create-new-departmentPlan').click(function () {
		$('#btn-save').val("create-departmentPlan");
		$('#departmentPlan_id').val('');
		$('#departmentPlanForm').trigger("reset");
		$('#departmentPlanCrudModal').html("Thêm kế hoạch");
		$('#ajax-departmentPlan-modal').modal('show');
	});

	if ($("#departmentPlanForm").length > 0) {
		$("#departmentPlanForm").validate({
	
			submitHandler: function(form) {
		
			var actionType = $('#btn-save').val();
			$('#btn-save').html('Đang gửi..');
			
			$.ajax({
				data: $('#departmentPlanForm').serialize(),
				url: "/admin/plan/department/store",
				type: "POST",
				dataType: 'json',
				success: function (data) {
		
					$('#departmentPlanForm').trigger("reset");
					$('#ajax-departmentPlan-modal').modal('hide');
					$('#btn-save').html('Lưu lại');
					var oTable = $('#plan_table').dataTable();
					oTable.fnDraw(false);
					
				},
				error: function (data) {
					console.log('Error:', data);
					$('#btn-save').html('Lưu lại');
				}
			});
			}
		})
	}
})

</script>
@stop