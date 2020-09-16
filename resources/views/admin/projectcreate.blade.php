@extends('adminlte::page')

@section('title','Admin')

@section('content')



<div class="page-header"><h4>Quản lý đồ án</h4></div>

<p><a class="btn btn-primary" href="{{ url('/admin') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Thêm đồ án</h4></center>
	<form action="{{ url('/admin/projectcreate') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
		<div class="form-group">
			<label for="loaidoanID">Loại đồ án</label>
			<select class="form-control" name="ldoan">
				@foreach($ldoan as $ld)
					<option value="{{ $ld->id }}">{{ $ld->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="bomonID">Bộ môn</label>
			<select class="form-control" name="bomon">
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
			<select class="form-control" name="giangvien">
				@foreach($giangvien as $gv)
					<option value="{{ $gv->id }}">{{ $gv->name }}</option>
				@endforeach
			</select>
		</div>
		<center><button type="submit" class="btn btn-primary">Thêm</button></center>
	</form>
</div>
@endsection