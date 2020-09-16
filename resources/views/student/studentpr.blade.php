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
											</tr>
										</thead>
										<tbody>
											@foreach($project->teacher_criteria->where('type', 0) as $dc)
												<tr>
													<td>{{ $dc->name }}</td>
													<td>{{ $dc->weight }}</td>
													<td>{{ $dc->mark }}</td>
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
									<thead>
										<tr>
											<th>Tên tiêu chí</th>
											<th>Trọng số</th>
											<th>Điểm</th>
										</tr>
									</thead>
									<tbody>
									@if($project->project_type()->first()->type == '2')
										@foreach($department_criteria as $dc)
											<tr>
												<td>{{$dc->name}}</td>
												<td>{{$dc->weight}}</td>
												<td>{{$dc->mark}}</td>
											</tr>
										@endforeach
									@endif
									@if($project->project_type()->first()->type == '1')
										@foreach($project->teacher_criteria->where('type', 1) as $dc)
											<tr>
												<td>{{$dc->name}}</td>
												<td>{{$dc->weight}}</td>
												<td>{{$dc->mark}}</td>
											</tr>
										@endforeach
									@endif
									</tbody>
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
								@endif
								@if($project->project_type()->first()->type == '2')
								@foreach($project->department_criteria as $dc)
										<?php 
											$em += $dc->weight * $dc->mark;
										?>
									@endforeach
									{{$em}}
								@endif
								</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-content-below-plan" role="tabpanel" aria-labelledby="custom-content-below-plan-tab">
			<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Danh sách kế hoạch</strong></h3>
					</div>
				<div class="card-body">
					<table id="plan" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>STT</th>
							<th>Mô tả kế hoạch</th>
							<th>Thời hạn</th>
						</tr>
					</thead>
					<tbody>
					<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
					@foreach($listkehoach as $key => $lkh)
						<tr>
							<?php //Điền số thứ tự?>
							<td>{{ $key+1 }}</td>
							<td>{{ $lkh->description }}</td>
							<td>{{ date("d-m-Y", strtotime($lkh->deadline)) }}</td>
						</tr>
					<?php //Kết thúc vòng lập foreach?>
					@endforeach
					</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="tab-pane fade" id="custom-content-below-document" role="tabpanel" aria-labelledby="custom-content-below-document-tab">
				<div class="card">
					<div class="card-header">
						<h3 class = "card-title"><strong>Danh sách tài liệu hướng dẫn</strong></h3>
					</div>
					<div class="card-body">
					<table id="document" class="table table-bordered table-hover">
							<thead>
								<tr>	
								<th>STT</th>
								<th>Tài liệu hướng dẫn</th>
								<th>Mô tả tài liệu</th>
								</tr>
							</thead>
							<tbody>
								@foreach($project->document as $key => $ltl)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>
										<a href="/file/getfile/{{ $ltl->link }}">{{ $ltl->link }}</a>
									</td>
									<td>{{ $ltl->description }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
					</table>
				</div>	
			</div>
			<div class="card">
			<div class="card-header">
						<h3 class = "card-title"><strong>Cập nhật nhật ký</strong></h3>
					</div>
			<div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
            <form id="upload_progress_result" enctype="multipart/form-data">
                {{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{!! $project->id !!}">
				<div class="form-group">
                	<label for="tailieu">Nhật ký làm việc</label>
                	<input type="file" class="form-control" name="diary[]" multiple/>
				</div>
                <div class="form-group">
                	<label for="done">Công việc đã hoàn thành</label>
                	<textarea type="text" name="done_work" class="form-control" placeholder=""></textarea>
                </div>
				<div class="form-group">
                	<label for="remain">Công việc còn lại</label>
                	<textarea type="text" name="remain_work" class="form-control" placeholder=""></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Upload" />
            </form>
        	</div>
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
									<th>Mô tả báo cáo</th>
									<th>Thời gian nộp</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			<div class="card">
			<div class="card-header">
						<h3 class = "card-title"><strong>Cập nhật báo cáo</strong></h3>
					</div>
			<div class="row">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
            <form id="upload_report" enctype="multipart/form-data">
                {{ csrf_field() }}
				<input type="hidden" name="id" id="id" value="{!! $project->id !!}">
				<div class="form-group">
                	<label for="tailieu">Tài liệu báo cáo</label>
                	<input type="file" class="form-control" name="report[]" multiple/>
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
	</div>
</div>

@stop
@section('sidebar')
    @include('includes.student_sidebar')
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
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

	report = $('#report').DataTable({
		searching: false,
		info: false,
		paging: false,
		lengthChange: false,
		processing: true,
		serverSide: true,
		responsive: true,
		autoWidth: true,
		ajax: {
			url: "/student/file/report",
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
			{"data": 'time', name: 'time', 
				render: function (data, type, row, meta) {
					return moment(data).format('DD-MM-YYYY');
				}
			},
		],
	});

	$('#upload_report').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: "/student/file/report/upload",
			method: "POST",
			dataType: "json",
			data : new FormData($('#upload_report')[0]),
			processData: false,
   			contentType: false,
			success: function(data){
				console.log(data)
				$('#report').dataTable().fnDraw(false);
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

	progress_result = $('#progress_result').DataTable({
		searching: false,
		info: false,
		paging: false,
		lengthChange: false,
		processing: true,
		serverSide: true,
		responsive: true,
		autoWidth: true,
		ajax: {
			url: "/student/file/progress_result",
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
					return "<a href='/file/getfile/" + data.diary_work + "'>" + data.diary_work + "</a>";
				}	
			},
			{"data": 'done_work', name: 'done_work'},
			{"data": 'remain_work', name: 'remain_work'}, 
		],
	});

	$('#upload_progress_result').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: "/student/file/progress_result/upload",
			method: "POST",
			dataType: "json",
			data : new FormData($('#upload_progress_result')[0]),
			processData: false,
   			contentType: false,
			success: function(data){
				console.log(data)
				$('#progress_result').dataTable().fnDraw(false);
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
});
</script>
@endsection