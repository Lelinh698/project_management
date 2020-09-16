<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Report;
use App\Progress_result;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Response;
use Carbon;

class FileController extends Controller
{
    public function index($id)
    {
     
    	$tailieu = Document::where('id_project', $id)->get();

     
        return view('teacher.filelist', ['listdoan' => $tailieu, 'id' => $id]);
	}

	public function fileListStudent($id) {
		$svid = Auth::guard('student')->user()->id;

        $currentTime = Carbon::now();

        $result = DB::table('plan')
            ->where('id_project', $svid)
            ->select('deadline')  
            ->orderBy(DB::raw('ABS( DATEDIFF( deadline, NOW() ) )'))
            ->first();

    	$tailieu = Document::where('id_project', $id)->get();

        return view('student.filelist', ['listdoan' => $tailieu, 'id' => $id, 'time' => $result]);
	}

	public function report(Request $request)
	{
		if(request()->ajax()) {
            $data = Report::where('id_project', $request['id_project'])->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
        }

        return view('student.studentpr');
	}

    public function reportUpload(Request $request)
    {
		// $this->validate($request, [
		// 	'id'=>'required',
		// 	'mota'=>'required',
		// 	'report'=>'required',]
		// );
        // // kiểm tra có files sẽ xử lý
		// if($request->hasFile('fileTest')) {
			$files = $request->file('fileTest');
			$currentTime = Carbon\Carbon::now();
			$currentTime->toDateTimeString();

			foreach ($request->report as $ft) {
				$filename = $ft->getClientOriginalName();
				$ft->storeAs('upload', $filename);
				Report::create([
					'id_project' => $request->id,
					'link' => $filename,
					'description' => $request->mota,
					'time' => $currentTime,
				]);
			}
			return Response::json([
				'message' => 'Cập nhật thành công',
			]);
		// }

		

	}
	
	public function progress_result(Request $request)
	{
		if(request()->ajax()) {
            $data = Progress_result::where('id_project', $request['id_project'])->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
        }

        return view('student.studentpr');
	}

    public function progress_resultUpload(Request $request)
    {
		// $this->validate($request, [
		// 	'id'=>'required',
		// 	'mota'=>'required',
		// 	'report'=>'required',]
		// );
        // // kiểm tra có files sẽ xử lý
		// if($request->hasFile('fileTest')) {
			$files = $request->file('fileTest');
			$currentTime = Carbon\Carbon::now();
			$currentTime->toDateTimeString();

			foreach ($request->diary as $ft) {
				$filename = $ft->getClientOriginalName();
				$ft->storeAs('upload', $filename);
				Progress_result::create([
					'id_project' => $request->id,
					'diary_work' => $filename,
					'done_work' => $request->done_work,
					'remain_work' => $request->remain_work,
				]);
			}
			return Response::json([
				'message' => 'Cập nhật thành công',
			]);
		// }
	}
	
	public function document(Request $request)
	{
		if(request()->ajax()) {
            $data = Document::where('id_project', $request['id_project'])->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
        }

        return view('teacher.studentpr');
	}

    public function documentUpload(Request $request)
    {
		// $this->validate($request, [
		// 	'id'=>'required',
		// 	'mota'=>'required',
		// 	'report'=>'required',]
		// );
        // // kiểm tra có files sẽ xử lý
		// if($request->hasFile('fileTest')) {
			$files = $request->file('fileTest');
			$currentTime = Carbon\Carbon::now();
			$currentTime->toDateTimeString();

			foreach ($request->document as $ft) {
				$filename = $ft->getClientOriginalName();
				$ft->storeAs('upload', $filename);
				Document::create([
					'id_project' => $request->id,
					'link' => $filename,
					'description' => $request->mota,
				]);
			}
			return Response::json([
				'message' => 'Cập nhật thành công',
			]);
		// }

		

	}

    // public function list(){
    //     $files = Storage::allFiles('upload');
    //     return view('display', ['files' => $files]);
    // }

	public function getfile($filename)
	{
	    $file_path = storage_path('app/upload') . "/" . $filename;
        return Response::download($file_path);
	}

  //   public function view(){
  //       $files = Storage::files("upload");
  //   	$images=array();
  //   	foreach ($files as $key => $value) {
  //   		$value= str_replace("upload/","",$value);
  //   		array_push($images,$value);
  //   	}
		// return view('display', ['images' => $images]);
  //   }
}