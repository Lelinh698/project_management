@extends('templates.master')

@section('title','Danh sách kế hoạch')

@section('content')

@include('teacher.teacherMenu')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Danh sách kế hoạch</h4></div>

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
			<p><a class="btn btn-primary" href="/teacher/plancreate/{{ $id }}">Thêm mới</a></p>
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>STT</th>
						<!-- <th>Bắt đầu</th> -->
						<th>Kết thúc</th>
						<th>Mô tả</th>
					</tr>
				</thead>
				<tbody>
				<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
				@foreach($listkehoach as $key => $lkh)
					<tr>
						<?php //Điền số thứ tự?>
						<td>{{ $key+1 }}</td>
						<!-- <td>{{ date("d-m-Y", strtotime($lkh->batdau)) }}</td> -->
						<td>{{ date("d-m-Y", strtotime($lkh->deadline)) }}</td>
						<td>{{ $lkh->description }}</td>
					</tr>
				<?php //Kết thúc vòng lập foreach?>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection