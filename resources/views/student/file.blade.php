@extends('templates.master')

@section('title','Danh sách đồ án')

@section('content')

@include('student.studnetMenu')

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
    <p><a class="btn btn-primary" href="/student/filelist/{{ $id }}">Về danh sách</a></p>
    <div class="row">
        <div class="col-md-8"><h2>Upload File</h2></div>
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
            <form action="/student/filestore" name="file" method="post" onsubmit="return validateFile()" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{!! $id !!}">

                <label for="tailieu">Tài liệu</label>
                <br>
                <input type="file" class="form-control" name="fileTest[]" multiple />
                <br>
                <div class="form-group">
                    <label for="motas">Mô tả</label>
                    <input type="text" name="mota" class="form-control" placeholder="Mô tả">
                </div>
                <br><br>
                <input type="submit" class="btn btn-primary" value="Upload" />
            </form>
        </div>
    </div>
</div>

@endsection