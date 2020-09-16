@extends('layouts.default')

@section('title','Nhóm sinh viên')

@section('content_header')
<h3>{{ $project->name }}</h3>
@stop

@section('content')

<div class="card">
	<!-- <div class="card-header"></div> -->
	<div class="card-body">
		<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
			<li class="nav-item">
			<a class="nav-link active" id="custom-content-below-group-tab" data-toggle="pill" href="#custom-content-below-group" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Nhóm sinh viên</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-teacher-tab" data-toggle="pill" href="#custom-content-below-teacher" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Giảng viên</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-assess-tab" data-toggle="pill" href="#custom-content-below-assess" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Đánh giá</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-plan-tab" data-toggle="pill" href="#custom-content-below-plan" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Kế hoạch</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-document-tab" data-toggle="pill" href="#custom-content-below-document" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Tài liệu hướng dẫn</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-progress-tab" data-toggle="pill" href="#custom-content-below-progress" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Tiến độ</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-content-below-report-tab" data-toggle="pill" href="#custom-content-below-report" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Báo cáo</a>
			</li>
		</ul>
		<div class="tab-content" id="custom-content-below-tabContent">
			<div class="tab-pane fade show active" id="custom-content-below-group" role="tabpanel" aria-labelledby="custom-content-below-group-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Nhóm sinh viên</strong></h3>
					</div>
					<div class="card-body">
						<table id="student_group" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>STT</th>
									<th>Họ tên</th>
									<th>Email</th>
									<th>SĐT</th>
									<th>Lớp</th>
									<th>Khóa</th>
								</tr>
							</thead>
							<tbody>
							<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
							@foreach($sinhvien as $key => $sv)
								<tr>
									<?php //Điền số thứ tự?>
									<td>{{ $key+1 }}</td>
									<td>{{ $sv->name }}</td>
									<td>{{ $sv->email }}</td>
									<td>{{ $sv->phone }}</td>
									<td>{{ $sv->class }}</td>
									<td>{{ $sv->year }}</td>
								</tr>
							<?php //Kết thúc vòng lập foreach?>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-content-below-teacher" role="tabpanel" aria-labelledby="custom-content-below-teacher-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Giảng viên hướng dẫn</strong></h3>
					</div>
					<div class="card-body">
						<table id="teacher" class="table table-bordered table-hover">
							<thead>
								<tr>
									
									<th>Họ tên</th>
									<th>Email</th>
									<th>SĐT</th>
									<th>Bộ môn</th>
									<th>Học vị</th>
								</tr>
							</thead>
							<tbody>
							<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
							@foreach($giangvien as $key => $gv)
								<tr>
									<?php //Điền số thứ tự?>	
									<td>{{ $gv->name }}</td>
									<td>{{ $gv->email }}</td>
									<td>{{ $gv->phone }}</td>
									<td>{{ $gv->department->name }}</td>
									<td>{{ $gv->degree }}</td>
								</tr>
							<?php //Kết thúc vòng lập foreach?>
							@endforeach
							</tbody>
						</table>
					</div>
				</div> 
			</div>
			<div class="tab-pane fade" id="custom-content-below-assess" role="tabpanel" aria-labelledby="custom-content-below-assess-tab">
				<div class="row">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h3 class = "card-title"> Điểm quá trình </h3>
							</div>
							<div class="card-body">
								<table id="process_mark" class="table" style="width:100%">
									<thead>
										<tr>
											<th>Tên tiêu chí</th>
											<th>Trọng số</th>
											<th>Điểm</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($project->teacher_criteria->where('type', 0) as $dc)
											<tr>
												<td><input class="form-control form-control-sm" type="text" name="criteria[]" value="{{$dc->name}}" required></td>
												<td><input class="form-control form-control-sm" type="number" min="0" max="1.0" step="0.1" name="weight[]" value="{{$dc->weight}}" required></td>
												<td><input class="form-control form-control-sm" type="number" min ="0" max="10" name="mark[]" value="{{$dc->mark}}" required></td>
												<td><a title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<br>
								<strong>Điểm quá trình:
								<?php $pm = 0; ?>
								@foreach($project->teacher_criteria->where('type', 0) as $dc)
									<?php 
										$pm += $dc->weight * $dc->mark;
									?>
								@endforeach
								{{$pm ?? ''}}
								</strong>
								<br>
								<hr>
								<div>
									<button id="add_row" class="btn btn-success">Thêm tiêu chí</button>
									<button type="submit" id="submit" class="btn btn-primary" style="float:right;">Lưu</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h3 class = "card-title"> Điểm kết thúc </h3>
							</div>
							<div class="card-body">
								<table id="end_mark" class="table" style="width:100%">
								<input type="hidden" id="prid" value="{{ $project->id }}">
									
									@if($project->project_type()->first()->type == '2')
									<thead>
										<tr>
											<th>Tên tiêu chí</th>
											<th>Trọng số</th>
											<th>Điểm</th>
										</tr>
									</thead>
									<tbody>
										@foreach($project->department_criteria as $dc)
											<tr>
												<td>{{ $dc->name }}</td>
												<td>{{ $dc->weight }}</td>
												<td>{{ $dc->mark }}</td>
											</tr>
										@endforeach
									</tbody>
									@endif
									@if($project->project_type()->first()->type == '1')
									<thead>
										<tr>
											<th>Tên tiêu chí</th>
											<th>Trọng số</th>
											<th>Điểm</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($project->teacher_criteria->where('type', 1) as $dc)
											<tr>
												<td><input class="form-control form-control-sm" type="text" name="end_criteria[]" value="{{$dc->name}}"></td>
												<td><input class="form-control form-control-sm" type="number" min="0" max="1.0" step="0.1" name="end_weight[]" value="{{$dc->weight}}"></td>
												<td><input class="form-control form-control-sm" type="number" min ="0" max="10" name="end_mark[]" value="{{$dc->mark}}"></td>
												<td><a title='Xóa' class='btn btn-delete2 btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>
											</tr>
										@endforeach
									</tbody>
									@endif
								</table>
								<br>
								<strong>Điểm kết thúc:
									<?php $em = 0; ?>
								@if($project->project_type()->first()->type == '1')
									@foreach($project->teacher_criteria->where('type', 1) as $dc)
										<?php 
											$em += $dc->weight * $dc->mark;
										?>
									@endforeach
									{{$em}}
								</strong>	
								<br>
								<hr>
								<div>
									<button id="add_row2" class="btn btn-success">Thêm tiêu chí</button>
									<button type="submit2" id="submit2" class="btn btn-primary" style="float:right;">Lưu</button>
								</div>
								@endif
								@if($project->project_type()->first()->type == '2')
								@foreach($project->department_criteria as $dc)
										<?php 
											$em += $dc->weight * $dc->mark;
										?>
									@endforeach
									{{$em}}
								</strong>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-content-below-plan" role="tabpanel" aria-labelledby="custom-content-below-plan-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"> Kế hoạch giảng viên </h3>
						@include('teacher.plancreate')
					</div>
					<div class="card-body">
						<div class="table-reponsive">
							<table id="teacher_plan" class="display" style="width:100%;">
								<thead>
									<tr>
										<th width="10%">ID</th>
										<th width="30%">Kết thúc</th>
										<th width="60%">Mô tả</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
			</div>
		</div>
		<div class="tab-pane fade" id="custom-content-below-document" role="tabpanel" aria-labelledby="custom-content-below-document-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Danh sách tài liệu hướng dẫn</strong></h3>
					</div>
					<div class="card-body">
					<table id="document" class="table table-bordered table-hover" style="width:100%">
							<thead>
								<tr>	
								<th>STT</th>
								<th>Tài liệu hướng dẫn</th>
								<th>Mô tả tài liệu</th>
								</tr>
							</thead>
						</table>
					</div>
			<div class="card">
			<div class="card-header">
						<h3 class = "card-title"><strong>Cập nhật tài liệu hướng dẫn</strong></h3>
			</div>
			<div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
            <form id="upload_document" enctype="multipart/form-data">
                {{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{!! $project->id !!}">
				<div class="form-group">
                	<label for="tailieu">Tài liệu hướng dẫn</label>
                	<input type="file" class="form-control" name="document[]" multiple/>
				</div>
                <div class="form-group">
                	<label for="motas">Mô tả</label>
                	<textarea type="text" name="mota" class="form-control" placeholder="Mô tả báo cáo"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Upload" />
            </form>
        	</div>
    		</div>	 
			</div>
			</div>
			</div>
			<div class="tab-pane fade" id="custom-content-below-progress" role="tabpanel" aria-labelledby="custom-content-below-progress-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Cập nhật tiến độ</strong></h3>
					</div>
					<div class="card-body">
					<table id="progress_result" class="table table-bordered table-hover" style="width:100%">
					<thead>
						<tr>
							<th>STT</th>
							<th>Nhật ký làm việc</th>
							<th>Công việc đã hoàn thành</th>
							<th>Công việc còn lại</th>
						</tr>
					</thead>
					<tbody>
						@foreach($project->progress_result as $key => $ltl)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>
									<a href="/file/getfile/{{ $ltl->diary_work }}">{{ $ltl->diary_work }}</a>
								</td>
								<td>{{ $ltl->done_work }}</td>
								<td>{{ $ltl->remain_work }}</td>
							</tr>
						@endforeach
					</tbody>
					</table>
					</div>
				</div>	
			</div>
			<div class="tab-pane fade" id="custom-content-below-report" role="tabpanel" aria-labelledby="custom-content-below-report-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Danh sách báo cáo</strong></h3>
					</div>
					<div class="card-body">
					<table id="report" class="table table-bordered table-hover" style="width:100%">
							<thead>
								<tr>	
								<th>STT</th>
								<th>Tài liệu báo cáo</th>
								<th>Thời gian nộp</th>
								<th>Mô tả báo cáo</th>
								</tr>
							</thead>
							<tbody>
							@foreach($project->report as $key => $ltl)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>
										<a href="/file/getfile/{{ $ltl->link }}">{{ $ltl->link }}</a>
									</td>
									<td>{{ $ltl->time }}</td>
									<td>{{ $ltl->description }}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
	    </div>
    </div>
</div>
@stop

@section('sidebar')
    @include('includes.teacher_sidebar')
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<!-- <script type="text/javascript" src="{!! url('js/update_criteria.js') !!}"></script> -->
<script>
    
    $(document).ready(function() {

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

	plan = $('#teacher_plan').DataTable({
		searching: false,
		info: false,
		paging: false,
		lengthChange: false,
		processing: true,
		serverSide: true,
		responsive: true,
		autoWidth: true,
		ajax: {
			url: "/teacher/plan",
			type: 'POST',
			data: {
				'id_project': {!! $project->id !!}
			},
		},
		columns: [
			{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
			{"data": 'deadline', name: 'deadline',
				render: function (data, type, row, meta) {
					return moment(data).format('DD-MM-YYYY');
				}
			},
			{"data": 'description', name: 'description'},
		],
	});
	
    $("#btn-save").click(function(event) {
        event.preventDefault();
        if ($("input[name='ketthuc']").val() == '' || $('input[name="mota"]').val() == '')
        {
            Toast.fire({
                type: 'error',
                title: 'Hãy nhập đầy đủ các trường!'
            })
        }
        else
        {   
            $.ajax({
                url: "/teacher/planstore",
                method: "POST",
                dataType: "json",
                data : $("#plancreategv").serialize(),
                success: function(data){
                    console.log(data)
                    $("input[name='ketthuc']").val("");
                    $("input[name='mota']").val("");
                    $("#modal-lg").modal("hide");
					$('#teacher_plan').DataTable().ajax.reload()
                    Toast.fire({
                        type: 'success',
                        title: 'Đã thêm kế hoạch.'
                    })
                },
                error: function (request, textStatus, errorThrown) {
                    alert(request.responseText.message);
                }
            });
        }
    })
	
	var process_table = $('#process_mark').DataTable({
        searching: false,
        info: false,
        paging: false,
        lengthChange: false,
        columnDefs: [
            { targets: [1, 2],  width: "20%"},
        ],
    });

    var end_table = $('#end_mark').DataTable({
        searching: false,
        info: false,
        paging: false,
        lengthChange: false,
        columnDefs: [
            { targets: [1, 2],  width: "20%"},
        ]
    });

    $('#submit').click( function() {
        var data = process_table.$('input').serialize();
        // alert(data)
        
        if ($("input[name='criteria[]']").val() == '' || $('input[name="weight[]"]').val() == '')
        {
            Toast.fire({
                type: 'error',
                title: 'Hãy nhập đầy đủ các trường!'
            })
        }
        else
        {   
            var x = $("input[name='weight[]']")
            // console.log(x[0].value)
            var sum = 0;
            for(i=0; i<x.length; i++) {
                sum += parseFloat(x[i].value)
                // console.log(sum)
            }
            if (sum != 1.0) {
                Toast.fire({
                    type: 'error',
                    title: 'Hãy nhập sao cho tổng trọng số bằng 1.0'
                })
            }
            else
            {
                $.ajax({
                    url: "/ajax_criteria",
                    method: "POST",
                    dataType: "json",
                    data : {
                        'data': data,
                        'prid': $('#prid').val(),
                    },
                    success: function(data){
                        console.log(data)
                        Toast.fire({
                            type: 'success',
                            title: 'Đã cập nhật tiêu chí.'
                        })
                    },
                    error: function (request, textStatus, errorThrown) {
                        alert(request.responseText.message);
                        console.log("Loi vcl")
                    }
                });
            }
        }
        // alert(data)
        return false;
    });

	$('#process_mark').on('click', 'a.btn-delete', function (e) {
        e.preventDefault();
        process_table.row($(this).parents('tr')).remove().draw(false)
		
    });

    $('#add_row').on( 'click', function () {
        process_table.row.add( [
            '<input class="form-control form-control-sm" type="text" name="criteria[]">',
            '<input class="form-control form-control-sm" type="number" min="0" max="1.0" step="0.1" name="weight[]">',
            '<input class="form-control form-control-sm" type="number" value="0" min ="0" max="10" name="mark[]">',
			"<a title='Xóa' class='btn btn-delete btn-danger btn-xs'><i class='fa fa-trash'></i></a>"
        ] ).draw().node();		
	});


	@if($project->project_type()->first()->type == '1')
		$('#submit2').click( function() {
			var data = end_table.$('input').serialize();
			// alert(data)
			
			if ($("input[name='end_criteria[]']").val() == '' || $('input[name="end_weight[]"]').val() == '')
			{
				Toast.fire({
					type: 'error',
					title: 'Hãy nhập đầy đủ các trường!'
				})
			}
			else
			{   
				var x = $("input[name='end_weight[]']")
				// console.log(x[0].value)
				var sum = 0;
				for(i=0; i<x.length; i++) {
					sum += parseFloat(x[i].value)
					// console.log(sum)
				}
				if (sum != 1.0) {
					Toast.fire({
						type: 'error',
						title: 'Hãy nhập sao cho tổng trọng số bằng 1.0'
					})
				}
				else
				{
					$.ajax({
						url: "/end_criteria",
						method: "POST",
						dataType: "json",
						data : {
							'data': data,
							'prid': $('#prid').val(),
						},
						success: function(data){
							console.log(data)
							Toast.fire({
								type: 'success',
								title: 'Đã cập nhật tiêu chí.'
							})
						},
						error: function (request, textStatus, errorThrown) {
							alert(request.responseText.message);
							console.log("Loi vcl")
						}
					});
				}
			}
			// alert(data)
			return false;
		});

		$('#end_mark').on('click', 'a.btn-delete2', function (e) {
			e.preventDefault();
			end_table.row($(this).parents('tr')).remove().draw(false)
			
		});

		$('#add_row2').on( 'click', function () {
			end_table.row.add( [
				'<input class="form-control form-control-sm" type="text" name="end_criteria[]">',
				'<input class="form-control form-control-sm" type="number" min="0" max="1.0" step="0.1" name="end_weight[]">',
				'<input class="form-control form-control-sm" type="number" value="0" min ="0" max="10" name="end_mark[]">',
				"<a title='Xóa' class='btn btn-delete2 btn-danger btn-xs'><i class='fa fa-trash'></i></a>"
			] ).draw().node();		
		});
	@endif

    });

	document = $('#document').DataTable({
		searching: false,
		info: false,
		paging: false,
		lengthChange: false,
		processing: true,
		serverSide: true,
		responsive: true,
		autoWidth: true,
		ajax: {
			url: "/teacher/file/document",
			type: 'GET',
			data: {
				'id_project': {!! $project->id !!}
			},
		},
		columns: [
			{"data": 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
			{
				data: null, 
				orderable: false,
				searchable: false,
				render: function (data, type, row, meta) {
					return "<a href='/file/getfile/" + data.link + "'>" + data.link + "</a>";
				}	
			},
			{"data": 'description', name: 'description'},
		],
	});

	$('#upload_document').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: "/teacher/file/document/upload",
			method: "POST",
			dataType: "json",
			data : new FormData($('#upload_document')[0]),
			processData: false,
   			contentType: false,
			success: function(data){
				console.log(data)
				$('#document').dataTable().fnDraw(false);
				Toast.fire({
					type: 'success',
					title: data.message,
				})
			},
			error: function (request, textStatus, errorThrown) {
				alert(request.responseText.message);
				console.log("Loi vcl")
			}
		})
	});
</script>
@stop