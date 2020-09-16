@extends('layouts.default')

@section('title','Danh sách kế hoạch')

@section('content')

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Đề xuất kế hoạch của bộ môn</h4></div>

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
						<th>Nhiệm vụ</th>
						<th>Mô tả nhiệm vụ</th>
						<th>Các yêu cầu cần gửi</th>
						<th>Thời hạn upload</th>
					</tr>
				</thead>
				<tbody>
				<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
				@foreach($listkehoach as $key => $lkh)
					<tr>
						<td>{{ $lkh->name }}</td>
						<td>{{ $lkh->description }}</td>
						<td>{{ $lkh->request }}</td>
						<td>{{ date("d-m-Y", strtotime($lkh->deadline)) }}</td>
					</tr>
				<?php //Kết thúc vòng lập foreach?>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection