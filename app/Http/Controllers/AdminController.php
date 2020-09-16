<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\Teacher;
use App\Document;
use App\Teacher_plan;
use App\Project;
use App\Project_type;
use App\Department;
use Session;
use App\Assess;

class AdminController extends Controller
{
    public function plancreate($id) {
        return view('admin.plancreate', ['id' => $id]);
    }

    public function planstore(Request $request) {
        $this->validate($request, [
            'id'=>'required',
            'mota'=>'required',
            'ketthuc' => 'required',
            // 'batdau'=>'required',
            ]
        );
        Teacher_plan::create([
            'id_project' => $request->id,
            // 'batdau' => $request->batdau,
            'deadline' => $request->ketthuc,
            'description' => $request->mota
        ]);

        return view('admin.plancreate', ['id' => $request->id])->with('thongbao', 'Thêm kế hoạch thành công');
    }

    public function fileList($id) {
        // $gvid = Auth::guard('teacher')->user()->id;

        // $getData = Project::where('id_teacher', $gvid)->first();

        $tailieu = Document::where('id_project', $id)->get();

        // $files = Storage::allFiles('upload');

        return view('admin.filelist', ['listdoan' => $tailieu, 'id' => $id]);
    }

    public function assessList($id) {
        // $gvid = Auth::guard('teacher')->user()->id;

        // $getData = Project::where('id_teacher', $gvid)->first();

        $assess = Assess::where('id_project', $id)->get();

        // $files = Storage::allFiles('upload');

        return view('admin.assesslist', ['listdanhgia' => $assess, 'id' => $id]);
    }


    public function assesscreate($id) {
        return view('admin.assesscreate', ['id' => $id]);
    }

    public function assessstore(Request $request) {
        $allRequest = $request->all();
        $hoten  = $allRequest['thoigian'];
        $mssv = $allRequest['hieuqua'];
        $username = $allRequest['diem'];

        $dataInsertToDatabase = array(
            'thoigian'  => $hoten,
            'hieuqua' => $mssv,
            'diem' => $username,        );

        $insertData = DB::table('assesses')->insert($dataInsertToDatabase);
        
        //Kiểm tra Insert để trả về một thông báo
        if ($insertData) {
            Session::flash('success', 'Thêm mới đánh giá thành công!');
        }else {                        
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect('/admin');
    }

    public function addstudent(Request $request) {

        $allRequest = $request->all();
        $prid = $allRequest['prid'];
        $sv = $allRequest['sv'];

        $allsv = DB::table('students')->get();

        $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                    ->join('students', 'attends.id_student', '=', 'students.id')
                    ->where('projects.id', $sv)
                    ->select('students.name', 'students.email', 'students.phone', 'students.year', 'students.class', 'projects.id')->get();

        $dataInsertToDatabase = array(
            'id_project' => $prid,
            'id_student' => $sv,
        );

        $insertData = DB::table('attends')->insert($dataInsertToDatabase);
        
        //Kiểm tra Insert để trả về một thông báo
        if ($insertData) {
            Session::flash('success', 'Thêm mới sinh viên thành công!');
        }else {                        
            Session::flash('error', 'Thêm thất bại!');
        }

        return redirect('/admin');
    }

    public function demo() {
        $allsv = DB::table('project_types')->get();

        echo json_encode($allsv);
    }
}
