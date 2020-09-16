@extends('adminlte::page')

@section('title','Admin')

@section('content')



<div class="page-header"><h4>Quản lý điểm</h4></div>

<p><a class="btn btn-primary" href="{{ url('/admin/assesslist') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Thêm điểm</h4></center>
	<form action="{{ url('admin/assessstore') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
		<div class="form-group">
			<label for="thoigian">Điểm thời gian</label>
			<input type="text" class="form-control" id="thoigian" name="thoigian" placeholder="Điểm thời gian" maxlength="255" required />
		</div>
		<div class="form-group">
			<label for="hieuqua">Điểm hiệu quả</label>
			<input type="text" class="form-control" id="hieuqua" name="hieuqua" placeholder="Điểm hiệu quả" maxlength="15" required />
		</div>
		<div class="form-group">
			<label for="diem">Điểm</label>
			<input type="text" class="form-control" id="diem" name="diem" placeholder="Điểm" maxlength="255" required />
		</div>
		<div class="form-group">
			<label for="password">Mô tả</label>
			<input type="text" class="form-control" id="mota" name="mota" placeholder="Mô tả" maxlength="255" required />
		</div>	
		<center><button type="submit" class="btn btn-primary">Thêm</button></center>
	</form>
</div>
@endsection