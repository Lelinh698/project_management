@extends('adminlte::page')

@section('title','Admin')

@section('content')



@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <p><a class="btn btn-primary" href="/admin/planlist/{{ $id }}">Về danh sách</a></p>
    <div class="row">
        <div class="col-md-8"><h2>Thêm kế hoạch</h2></div>
        <div class="col-md-4">
            @if(session('thongbao'))
                        <div class="alert alert-danger">
                        {{session('thongbao')}}
                        </div>
                    @endif
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form name="plancreate" action="/admin/planstore" onsubmit="return validateForm()" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{!! $id !!}">

                <!-- <div class="form-group">
                    <label for="batdau">Ngày bắt đầu</label>
                    <input type="date" name="batdau" class="form-control" placeholder="Ngày bắt đầu">
                </div> -->
                <div class="form-group">
                    <label for="ketthuc">Ngày kết thúc</label>
                    <input type="date" name="ketthuc" class="form-control" placeholder="Ngày kết thúc">
                </div>
                <div class="form-group">
                    <label for="mota">Mô tả</label>
                    <input type="text" name="mota" class="form-control" placeholder="Mô tả">
                </div>
                <br><br>
                <input type="submit" class="btn btn-primary" value="Thêm" />
            </form>
        </div>
    </div>
</div>

@endsection