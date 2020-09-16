@extends('adminlte::page')

@section('title','Admin')

@section('content')
<div class="page-header"><h4>Danh sách giảng viên</h4></div>

<?php //Hiển thị danh sách giảng viên?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			<!-- <p><a class="btn btn-primary" id="create-new-teacher">Thêm giảng viên</a></p> -->
			<button type="button" id="create-new-teacher" class="btn btn-primary" data-toggle="modal" 
    data-target="#ajax-teacher-modal" style="float: right; bottom: 10px;">Thêm giảng viên</button>
			<table id="teacher_table" class="display compact nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>STT</th>
						<th>Họ tên</th>
						<th>Email</th>
						<th>SĐT</th>
						<th>Học vị</th>
						<th>Bộ môn</th>
						<th>Thao tác</th>
					</tr>
				</thead>
			</table>
		</div>

<div class="modal fade" id="ajax-teacher-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="teacherCrudModal"></h4>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        

		<form id="teacherForm" name="teacherForm" class="form-horizontal">
           <input type="hidden" name="teacher_id" id="teacher_id">
		   
		   		<div class="form-group">
					<label for="hoten">Tên giảng viên</label>
					<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên giảng viên" maxlength="255" required />
				</div>
		
			
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="username" class="form-control" id="username" name="username" placeholder="Username" maxlength="255" required />
				</div>
			</div>
			<div class="col-md-6">	
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="255" required autocomplete="current-password"/>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" required />
				</div>
			</div>
		   	<div class="col-md-6">
				<div class="form-group">
					<label for="sodienthoai">Số điện thoại</label>
					<input type="number" class="form-control" id="sodienthoai"  name="sodienthoai" placeholder="Số điện thoại" maxlength="15" required />
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="bomon">Bộ môn</label>
					<select class="form-control" name="bomon" id="bomon">
						@foreach($bomon as $bm)
							<option value="{{ $bm->id }}">{{ $bm->name }}</option>
						@endforeach
					</select>	
				</div>
			</div>
		   	<div class="col-md-6">
				<div class="form-group">
					<label for="hocvi">Học vị</label>
					<input type="text" class="form-control" id="hocvi" name="hocvi" placeholder="Học vị" maxlength="255" required />
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="ngaysinh">Ngày sinh</label>
					<input type="date" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Ngày sinh" maxlength="255" required />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="quequan">Quê quán</label>
					<input type="text" class="form-control" id="quequan" name="quequan" placeholder="Quê quán" maxlength="255" required />
				</div>
			</div>
			</div>
        </form>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			<button type="submit" id="btn-save" class="btn btn-primary" form="teacherForm">Lưu lại</button>
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
<script type="text/javascript" src="{!! url('js/jquery.dataTables.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script>
		var SITEURL = '{{URL::to('')}}';
		$(document).ready( function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#teacher_table').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			autoWidth: true,
			ajax: {
			url: "/admin/teacher",
			type: 'GET',
			},
			columns: [
					{"data": 'tid', name: 'tid', 'visible': false},
					{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
					{ "data": "tname" },
					{ "data": "email" },
					{ "data": "phone" },
					{ "data": "degree" },
					{ "data": "dname" },
					{
						data: null, 
						orderable: false,
						searchable: false,
						render: function (data, type, row, meta) {
							return "<a data-row='" + row.tid + "' title='Sửa' class='btn btn-edit btn-warning btn-xs'><i class='fa fa-pen'></i></a> <a data-row='" + row.tid + "' title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a>";
						}	
					},
				],
		});

		$('#create-new-teacher').click(function () {
			$('#btn-save').val("create-teacher");
			$('#teacher_id').val('');
			$('#teacherForm').trigger("reset");
			$('#teacherCrudModal').html("Thêm giảng viên");
			$('#ajax-teacher-modal').modal('show');
		});

		$(document).on("click",".btn-edit",function(){
			event.preventDefault();

			teacher_id = $(this).attr('data-row');

			$.get('/admin/teacher/edit/' + teacher_id, function (data) {
				console.log(data)
				$('#teacherCrudModal').html("Sửa giảng viên");
				$('#btn-save').val("edit-teacher");
				$('#ajax-teacher-modal').modal('show');
				$('#teacher_id').val(teacher_id);
				$("input[name='hoten']").val(data.name);
				$("input[name='username']").val(data.username);
				$("input[name='password']").val(data.password);
				$("input[name='email']").val(data.email);
				$("input[name='sodienthoai']").val(data.phone);
				$("#bomon").val(data.id_department);
				$("input[name='hocvi']").val(data.degree);
				$("input[name='ngaysinh']").val(data.birth);
				$("input[name='quequan']").val(data.address);
			})
		});

		$(document).on("click",".btn-delete",function(){

			teacher_id = $(this).attr('data-row');
			console.log(teacher_id)

			if(confirm("Bạn chắc chắn muốn xóa chứ?")){
			
			$.ajax({
				type: "GET",
				url: "/admin/teacher/delete/" + teacher_id,
				success: function (data) {
					var oTable = $('#teacher_table').dataTable(); 
					oTable.fnDraw(false);
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
			}
		});

		if ($("#teacherForm").length > 0) {
			$("#teacherForm").validate({
		
				submitHandler: function(form) {
			
				var actionType = $('#btn-save').val();
				$('#btn-save').html('Đang gửi..');
				
				$.ajax({
					data: $('#teacherForm').serialize(),
					url: "/admin/teacher/store",
					type: "POST",
					dataType: 'json',
					success: function (data) {
			
						$('#teacherForm').trigger("reset");
						$('#ajax-teacher-modal').modal('hide');
						$('#btn-save').html('Lưu lại');
						var oTable = $('#teacher_table').dataTable();
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

		});
	</script>
@stop