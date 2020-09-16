@extends('adminlte::page')

@section('title','Admin')

@section('content')



<div class="page-header"><h4>Quản lý giảng viên</h4></div>
	<div class="card">
		<!-- <div class="card-header">
			<h3 class="card-title">Fixed Header Table</h3>
			</div>
		</div> -->
		<!-- /.card-header -->
		<div class="card-body">
		<p><a class="btn btn-primary" href="{{ url('/admin/teacher') }}">Về danh sách</a></p>
		<div class="box-body">
			<center><h4>Thêm giảng viên</h4></center>
			<form action="{{ url('admin/teacher/create') }}" method="post">
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
				<div class="form-group">
					<label for="hoten">Tên giảng viên</label>
					<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên giảng viên" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="username" class="form-control" id="username" name="username" placeholder="Username" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="sodienthoai">Số điện thoại</label>
					<input type="number" class="form-control" id="sodienthoai"  name="sodienthoai" placeholder="Số điện thoại" maxlength="15" required />
				</div>
				<div class="form-group">
					<label for="bomon">Bộ môn</label>
					<select class="form-control" name="bomon">
						@foreach($bomon as $bm)
							<option value="{{ $bm->id }}">{{ $bm->name }}</option>
						@endforeach
					</select>		
				</div>
				<div class="form-group">
					<label for="hocvi">Học vị</label>
					<input type="text" class="form-control" id="hocvi" name="hocvi" placeholder="Học vị" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="ngaysinh">Ngày sinh</label>
					<input type="date" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Ngày sinh" maxlength="255" required />
				</div>
				<div class="form-group">
					<label for="quequan">Quê quán</label>
					<input type="text" class="form-control" id="quequan" name="quequan" placeholder="Quê quán" maxlength="255" required />
				</div>		
				<center><button type="submit" class="btn btn-primary">Thêm</button></center>
			</form>
		</div>
		<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>

</div>
@endsection