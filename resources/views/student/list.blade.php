@extends('templates.master')

@section('title','Danh sách đồ án')

@section('content')

@include('student.studentMenu')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Danh sách đồ án</h4></div>

@if ( Session::has('success') )
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>{{ Session::get('success') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

<?php //Hiển thị thông báo lỗi?>
@if ( Session::has('error') )
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong>{{ Session::get('error') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

<?php //Hiển thị danh sách học sinh?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>STT</th>
						<th>Loại đồ án</th>
						<th>Tên đề tài</th>
						<th>Mô tả</th>
						<th>Giảng viên</th>
						<th>Đánh giá</th>
						<th>Kế hoạch</th>
						<th>Tài liệu</th>
					</tr>
				</thead>
				<tbody>
				<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
				@foreach($doan as $key => $da)
					<tr>
						<?php //Điền số thứ tự?>
						<td>{{ $key + 1 }}</td>
						<td>{{ $da->project_type_name }}</td>
						<td><a href="/student/student/{{ $da->id }}">{{ $da->project_name }}</a></td>
						<td>{{ $da->description }}</td>
						<td>{{ $da->teacher_name }}</td>
						<td></td>
						<td><a href="/student/planlist/{{ $da->id }}">Xem</a></td>
						<td><a href="/student/filelist/{{ $da->id }}">Xem</a></td>
					</tr>
				<?php //Kết thúc vòng lập foreach?>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection