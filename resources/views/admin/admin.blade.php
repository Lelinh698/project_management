@extends('adminlte::page')

@section('title','Danh sách đồ án')

@section('content_header')

<h3>Danh sách đồ án</h3>

@stop

@section('content')
<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajax-project-modal" id="create-new-project">Thêm đồ án</button></p>
<div class="card">
	<div class="card-header">
		<h3 class = "card-title"> Nhóm Đồ Án Giảng Viên Quản Lý </h3>
	</div>
	<div class="card-body">
		<table id="project1" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>STT</th>
					<th>Loại đồ án</th>
					<th>Tên đề tài</th>
					<th>GVHD</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h3 class = "card-title"> Nhóm Đồ Án Bộ Môn Quản Lý </h3>
	</div>
	<div class="card-body">
		<table id="project2" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>STT</th>
					<th>Loại đồ án</th>
					<th>Tên đề tài</th>
					<th>GVHD</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			
		</table>
	</div>
<div class="modal fade" id="ajax-project-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="projectCrudModal"></h4>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <form id="projectForm" name="projectForm" class="form-horizontal">
           <input type="hidden" name="project_id" id="project_id">
		   <div class="form-group">
			<label for="loaidoanID">Loại đồ án</label>
			<select class="form-control" name="ldoan" id="ldoan">
				@foreach($ldoan as $ld)
					<option value="{{ $ld->id }}">{{ $ld->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="bomonID">Bộ môn</label>
			<select class="form-control" name="bomon" id="bomon">
				@foreach($bomon as $bm)
					<option value="{{ $bm->id }}">{{ $bm->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="ten">Tên đề tài</label>
			<input type="text" class="form-control" id="ten" name="ten" placeholder="Tên đề tài" maxlength="255" required />
		</div>
		<div class="form-group">
			<label for="giangvien">Giảng viên</label>
			<select class="form-control" name="giangvien" id="giangvien">
				@foreach($giangvien->where('id_department', 1) as $gv)
					<option value="{{ $gv->id }}">{{ $gv->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="giangvien" class="col-sm-3 control-label">Sinh viên</label>
			<select class="select2 col-sm-9" multiple="multiple" style="width:100%;" data-placeholder="Chọn sinh viên" id="sinhvien" name="sinhvien[]">
			</select>
		</div>
        </form>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			<button type="submit" id="btn-save" class="btn btn-primary" form="projectForm">Lưu lại</button>
		</div>
</div>
@endsection

@section('css')
<link href="{{ asset('css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<script type="text/javascript" src="{!! url('js/jquery.dataTables.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script type="text/javascript" src="{!! url('js/select2.full.min.js') !!}"></script>
<script>
$('.select2').select2({

});

$.ajax({
	url: '/ajax_student',
	dataType: 'json',
	success: function(data) {
		$( "select[name='sinhvien[]']").empty();
		$.each(data, function(key, value) {
			$("select[name='sinhvien[]']").append('<option value="'+ key +'">'+ value +'</option>');
		});
	}
});

$( "select[name='bomon']" ).change(function () {
    var departmentID = $(this).val();

    if (departmentID) {
      $.ajax({
        url: '/ajax_teacher',
        dataType: 'json',
        data: {'departmentID': departmentID},
        success: function(data) {
          $( "select[name='giangvien']").empty();
          $.each(data, function(key, value) {
            $("select[name='giangvien']").append('<option value="'+ key +'">'+ value +'</option>');
          });          
        }
      });
    } else{
        $("select[name='giangvien']").empty();
    }
  });
</script>
<script>
		var SITEURL = '{{URL::to('')}}';
		$(document).ready( function () {
			(function (){
			var close = window.swal.close;
			var previousWindowKeyDown = window.onkeydown;
			window.swal.close = function() {
			close();
			window.onkeydown = previousWindowKeyDown;
			};
		});

		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 5000
		})

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#project1').DataTable({
			// searching: false,
			// info: false,
			// paging: false,
			// lengthChange: false,
			processing: true,
			serverSide: true,
			responsive: true,
			autoWidth: true,
			ajax: {
				url: "/admin/project",
				type: 'GET',
				data: {
					'project_type': 1,
				},
			},
			columns: [
					{"data": 'id', name: 'id', 'visible': false},
					{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
					{ "data": "project_type_name" },
					{
						data: null, 
						orderable: false,
						searchable: false,
						render: function (data, type, row, meta) {
							return "<a href='/admin/project/" + data.id + "'>" + data.project_name +"</a>";
						}	
					},
					{ "data": "teacher_name" },
					{
						data: null, 
						orderable: false,
						searchable: false,
						render: function (data, type, row, meta) {
							return "<a data-row='" + row.id + "' title='Sửa' class='btn btn-edit btn-warning btn-xs'><i class='fa fa-pen'></i></a> <a data-row='" + row.id + "' title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a>";
						}	
					},
				],
		});

		$('#project2').DataTable({
			searching: false,
			info: false,
			paging: false,
			lengthChange: false,
			processing: true,
			serverSide: true,
			responsive: true,
			autoWidth: true,
			ajax: {
				url: "/admin/project",
				type: 'GET',
				data: {
					'project_type': 2,
				},
			},
			columns: [
					{"data": 'id', name: 'id', 'visible': false},
					{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
					{ "data": "project_type_name" },
					{
						data: null, 
						orderable: false,
						searchable: false,
						render: function (data, type, row, meta) {
							return "<a href='/admin/project/" + data.id + "'>" + data.project_name +"</a>";
						}	
					},
					{ "data": "teacher_name" },
					{
						data: null, 
						orderable: false,
						searchable: false,
						render: function (data, type, row, meta) {
							return "<a data-row='" + row.id + "' title='Sửa' class='btn btn-edit btn-warning btn-xs'><i class='fa fa-pen'></i></a> <a data-row='" + row.id + "' title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a>";
						}	
					},
				],
		});
/*  When user click add user button */
		$('#create-new-project').click(function () {
        $('#btn-save').val("create-project");
        $('#project_id').val('');
		$("#sinhvien").val(null).trigger('change');
        $('#projectForm').trigger("reset");
        $('#projectCrudModal').html("Thêm đồ án");
        $('#ajax-project-modal').modal('show');
    });

	$(document).on("click",".btn-edit",function(){
			event.preventDefault();

			project_id = $(this).attr('data-row');

			$.get('/admin/project/edit/' + project_id, function (data) {
				console.log(data)
				id_teacher = data.id_teacher
				$('#projectCrudModal').html("Sửa thông tin đồ án");
				$('#btn-save').val("edit-project");
				$('#ajax-project-modal').modal('show');
				$('#project_id').val(project_id);
				$("#ldoan").val(data.id_project_type);
				$("#bomon").val(data.id_department);
				$("input[name='ten']").val(data.name);
				$.ajax({
					url: '/ajax_teacher',
					dataType: 'json',
					data: {'departmentID': data.id_department},
					success: function(data) {
						$( "select[name='giangvien']").empty();
						$.each(data, function(key, value) {
							if(key == id_teacher){
								$("select[name='giangvien']").append('<option value="'+ key +'" selected>'+ value +'</option>');	
							} else {
								$("select[name='giangvien']").append('<option value="'+ key +'">'+ value +'</option>');
							}
						});          
					}
				});
				$.ajax({
                  url: '/ajax_get_student',
                  type: 'POST',
                  dataType: 'json',
                  data: {'id_project': project_id},
                  success: function(data) {
                    var student = []
                    for (i = 0; i < data.length; i++) {
                        student.push(data[i]['id_student'])
                    }
					$("#sinhvien").val(student)
					$('#sinhvien').trigger('change');
                  }
                });
			})
		});

		$(document).on("click",".btn-delete",function(){

			project_id = $(this).attr('data-row');
			console.log(project_id)

			if(confirm("Bạn chắc chắn muốn xóa chứ?")){
			
			$.ajax({
				type: "GET",
				url: "/admin/project/delete/" + project_id,
				success: function (data) {
					var oTable1 = $('#project1').dataTable(); 
					oTable1.fnDraw(false);
					var oTable2 = $('#project2').dataTable(); 
					oTable2.fnDraw(false);
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
			}
		});

		if ($("#projectForm").length > 0) {
			$("#projectForm").validate({
		
				submitHandler: function(form) {
			
				var actionType = $('#btn-save').val();
				$('#btn-save').html('Đang gửi..');
				
				$.ajax({
					data: $('#projectForm').serialize(),
					url: "/admin/project/store",
					type: "POST",
					dataType: 'json',
					success: function (data) {
			
						$('#projectForm').trigger("reset");
						$('#ajax-project-modal').modal('hide');
						$('#btn-save').html('Lưu lại');
						Toast.fire({
							type: 'success',
							title: 'Cập nhật thành công',
						})
						var oTable1 = $('#project1').dataTable();
						oTable1.fnDraw(false);
						var oTable2 = $('#project2').dataTable();
						oTable2.fnDraw(false);
						
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
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)