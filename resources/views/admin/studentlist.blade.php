@extends('adminlte::page')

@section('title','Admin')

@section('content')
<div class="page-header"><h4>Danh sách sinh viên</h4></div>

<?php //Hiển thị danh sách học sinh?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		
		<div class="table-responsive">
		<button type="button" id="create-new-student" class="btn btn-primary" data-toggle="modal" 
    data-target="#ajax-student-modal" style="float: right; bottom: 10px;">Thêm sinh viên</button>
			<table id="student_table" class="display compact nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>STT</th>
						<th>Họ tên</th>
						<th>MSSV</th>
						<th>Username</th>
						<th>Email</th>
						<th>SĐT</th>
						<th>Khóa</th>
						<th>Lớp</th>
						<th>Ngày sinh</th>
						<th>Quê quán</th>
						<th>Thao tác</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	
</div>
<div class="modal fade" id="ajax-student-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
		<h4 class="modal-title" id="studentCrudModal"></h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="studentForm" name="studentForm" class="form-horizontal">
           <input type="hidden" name="student_id" id="student_id">
		    <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="hoten">Tên sinh viên</label>
						<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên sinh viên" maxlength="255" required />
					</div>
				</div>
				<div class="col-md-6">	
					<div class="form-group">
						<label for="mssv">MSSV</label>
						<input type="text" class="form-control" id="mssv" name="mssv" placeholder="MSSV" maxlength="15" required />
					</div>
				</div>
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
						<input type="text" class="form-control" id="sodienthoai"  name="sodienthoai" placeholder="Số điện thoại" maxlength="15" required />
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="khoa">Khóa</label>
						<input type="text" class="form-control" id="khoa" name="khoa" placeholder="Khóa" maxlength="255" required />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="lop">Lớp</label>
						<input type="text" class="form-control" id="lop" name="lop" placeholder="Lớp" maxlength="255" required />
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
			<button type="submit" id="btn-save" class="btn btn-primary" form="studentForm">Lưu lại</button>
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
		$('#student_table').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			autoWidth: true,
			ajax: {
				url: "/admin/student",
				type: 'GET',
			},
			columns: [
				{"data": 'id', name: 'id', 'visible': false},
				{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
				{ "data": "name" },
				{ "data": "mssv" },
				{ "data": "username" },
				{ "data": "email" },
				{ "data": "phone" },
				{ "data": "year" },
				{ "data": "class" },
				{ "data": "birth" },
				{ "data": "address" },
				{
					data: null, 
					orderable: false,
					searchable: false,
					render: function (data, type, row, meta) {
						return "<a data-row='" + row.id + "' title='Sửa' class='btn btn-edit btn-warning btn-xs'><i class='fa fa-pen'></i></a> | <a data-row='" + row.id + "' title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a>";
					}	
				},
			],
		});

		$('#create-new-student').click(function () {
			$('#btn-save').val("create-student");
			$('#student_id').val('');
			$('#studentForm').trigger("reset");
			$('#studentCrudModal').html("Thêm sinh viên");
			$('#ajax-student-modal').modal('show');
		});

		$(document).on("click",".btn-edit",function(){
			event.preventDefault();

			student_id = $(this).attr('data-row');

			$.get('/admin/student/edit/' + student_id, function (data) {
				console.log(data)
				$('#studentCrudModal').html("Sửa sinh viên");
				$('#btn-save').val("edit-student");
				$('#ajax-student-modal').modal('show');
				$('#student_id').val(student_id);
				$("input[name='hoten']").val(data.name);
				$("input[name='mssv']").val(data.mssv);
				$("input[name='username']").val(data.username);
				$("input[name='password']").val(data.password);
				$("input[name='email']").val(data.email);
				$("input[name='sodienthoai']").val(data.phone);
				$("input[name='khoa']").val(data.year);
				$("input[name='lop']").val(data.class);
				$("input[name='ngaysinh']").val(data.birth);
				$("input[name='quequan']").val(data.address);
			})
		});

		$(document).on("click",".btn-delete",function(){

			student_id = $(this).attr('data-row');
			console.log(student_id)

			if(confirm("Bạn chắc chắn muốn xóa chứ?")){
			
			$.ajax({
				type: "GET",
				url: "/admin/student/delete/" + student_id,
				success: function (data) {
					var oTable = $('#student_table').dataTable(); 
					oTable.fnDraw(false);
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
			}
		});

		if ($("#studentForm").length > 0) {
			$("#studentForm").validate({
		
				submitHandler: function(form) {
			
				var actionType = $('#btn-save').val();
				$('#btn-save').html('Đang gửi..');
				
				$.ajax({
					data: $('#studentForm').serialize(),
					url: "/admin/student/store",
					type: "POST",
					dataType: 'json',
					success: function (data) {
			
						$('#studentForm').trigger("reset");
						$('#ajax-student-modal').modal('hide');
						$('#btn-save').html('Lưu lại');
						var oTable = $('#student_table').dataTable();
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