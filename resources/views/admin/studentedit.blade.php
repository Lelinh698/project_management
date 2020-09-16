@extends('adminlte::page')

@section('title','Admin')

@section('content')



<div class="page-header"><h4>Quản lý học sinh</h4></div>

<p><a class="btn btn-primary" href="{{ url('/admin/student') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Sửa học sinh</h4></center>
	<form action="{{ url('admin/student/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getHocSinhById[0]->id !!}" />
		<div class="form-group">
			<label for="hoten">Tên sinh viên</label>
			<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên sinh viên" maxlength="255" value="{{ $getHocSinhById[0]->name}}" required />
		</div>
		<div class="form-group">
			<label for="mssv">MSSV</label>
			<input type="text" class="form-control" id="mssv" name="mssv" placeholder="MSSV" maxlength="15" value="{{ $getHocSinhById[0]->mssv}}" required />
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" value="{{ $getHocSinhById[0]->email}}" required />
		</div>
		<div class="form-group">
			<label for="sodienthoai">Số điện thoại</label>
			<input type="text" class="form-control" id="sodienthoai"  name="sodienthoai" placeholder="Số điện thoại" maxlength="15" value="{{ $getHocSinhById[0]->phone}}" required />
		</div>
		<div class="form-group">
			<label for="khoa">Khoa</label>
			<input type="text" class="form-control" id="khoa" name="khoa" placeholder="Khoa" maxlength="255" value="{{ $getHocSinhById[0]->year}}" required />
		</div>
		<div class="form-group">
			<label for="lop">Lớp</label>
			<input type="text" class="form-control" id="lop" name="lop" placeholder="Lớp" maxlength="255" value="{{ $getHocSinhById[0]->class}}" required />
		</div>
		<div class="form-group">
			<label for="ngaysinh">Ngày sinh</label>
			<input type="date" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Ngày sinh" maxlength="255" value="{{ $getHocSinhById[0]->birth}}" required />
		</div>
		<div class="form-group">
			<label for="quequan">Quê quán</label>
			<input type="text" class="form-control" id="quequan" name="quequan" placeholder="Quê quán" maxlength="255" value="{{ $getHocSinhById[0]->address}}" required />
		</div>
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

@endsection