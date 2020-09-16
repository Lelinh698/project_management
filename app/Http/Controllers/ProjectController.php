<?php

namespace App\Http\Controllers;

use App\Project;
use App\Project_type;
use App\Department;
use App\Department_criteria;
use App\Teacher;
use App\Teacher_plan;
use App\Student;
use App\Attend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect,Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::guard('teacher')->check()) {
            $gvid = Auth::guard('teacher')->user()->id;

            $getData = DB::table('project_types')
                ->join('projects', 'project_types.id', '=', 'projects.id_project_type')
                ->where('projects.id_teacher', $gvid)
                ->select('projects.name as project_name', 'projects.description', 'project_types.name as project_type_name', 'projects.id', 'project_types.type')
                ->get();

            $teacher_info = Teacher::where('id', $gvid)->first();

            $department = Teacher::find($gvid)->department()->select('name')->first();

            return view('pages.teacher', ['doan' => $getData, 'teacher_info' => $teacher_info, 'department' => $department]);
        }
        else if (Auth::guard('student')->check()) {
            $svid = Auth::guard('student')->user()->id;

            $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                ->join('students', 'attends.id_student', '=', 'students.id')
                ->join('teachers', 'projects.id_teacher', '=', 'teachers.id')
                ->join('project_types', 'projects.id_project_type', '=', 'project_types.id')
                ->where('students.id', $svid)
                ->select('projects.name as project_name', 'projects.description', 'projects.id', 'teachers.name as teacher_name', 'project_types.name as project_type_name', 'project_types.type')
                ->get();

            $student_info = Student::where('id', $svid)->first();

            return view('pages.student', ['doan' => $data, 'student_info' => $student_info]);
        }
        else if (Auth::guard('admin')->check()) {
            if(request()->ajax()) {
                if($request['project_type'] == 1) {
                    $data = DB::table('project_types')
                        ->join('projects', 'project_types.id', '=', 'projects.id_project_type')
                        ->join('teachers', 'projects.id_teacher', '=', 'teachers.id')
                        ->select('projects.name as project_name', 'project_types.name as project_type_name',
                        'projects.id', 'teachers.name as teacher_name')
                        ->where('project_types.type', '=', 1)
                        ->get();
                } 
                elseif($request['project_type'] == 2)
                {
                    $data = DB::table('project_types')
                        ->join('projects', 'project_types.id', '=', 'projects.id_project_type')
                        ->join('teachers', 'projects.id_teacher', '=', 'teachers.id')
                        ->select('projects.name as project_name', 'project_types.name as project_type_name',
                        'projects.id', 'teachers.name as teacher_name')
                        ->where('project_types.type', '=', 2)
                        ->get();
                }
    
                return datatables()->of($data)
                ->addColumn('action', 'DataTables.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }

            $ldoan = Project_type::all();
            $bomon = Department::all();
            $giangvien = Teacher::all();
            $sinhvien = Student::all();

            return view('admin.admin', ['ldoan' => $ldoan, 'bomon' => $bomon, 'giangvien' => $giangvien, 'sinhvien' => $sinhvien]
);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ldoan = Project_type::all();
        $bomon = Department::all();
        $giangvien = Teacher::all();

        return view('admin.projectcreate', ['ldoan' => $ldoan, 'bomon' => $bomon, 'giangvien' => $giangvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allRequest = $request->all();
        $id_teacher  = $allRequest['giangvien'];
        $bomonID = $allRequest['bomon'];
        $loaidoanID = $allRequest['ldoan'];
        $projectId = $allRequest['project_id'];
        $ten = $allRequest['ten'];
        // $mota = $allRequest['mota'];
        $student = $allRequest['sinhvien'];

        $Id = $allRequest['project_id'];
        $project = Project::updateOrCreate(
                    ['id' => $projectId],
                    ['id_teacher'  => $id_teacher,
                    'id_department' => $bomonID,
                    'id_project_type' => $loaidoanID,
                    'name' => $ten,
                    ]);

        if(!empty($student)){
            Attend::where('id_project', $project->id)->delete();   
            
            foreach ($student as $value) {
                Attend::create(
                    ['id_project' => $project->id, 'id_student' => $value],
                );
            }
        }
        return Response::json($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
    
        return Response::json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Thực hiện câu lệnh update với các giá trị $request trả về
        $updateData = Project::where('id', $request->id)->update([
            'id_teacher' => $request-> $id_teacher,
            'id_department' => $bomonID,
            'id_project_type' => $loaidoanID,
            'name' => $ten,
            'description' => $mota,
        ]);
        
        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Sửa đồ án thành công!');
        }else {                        
            Session::flash('error', 'Sửa thất bại!');
        }
        
        //Thực hiện chuyển trang
        return redirect('admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Attend::where('id_project', $id)->delete();
        $project = Project::where('id', '=', $id)->delete();
        
        return Response::json($project);
    }

    public function getProjectInfo($id) {

        $project = Project::find($id);
        $department_criteria = $project->department_criteria;
        $teacher = Teacher::where('id', $project->id_teacher)->get();

        if(Auth::guard('admin')->check()){
            $student = DB::table('students')->get();
            $plan = Teacher_plan::where('id_project', $id)->get();

            $student_list = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                            ->join('students', 'attends.id_student', '=', 'students.id')
                            ->where('projects.id', $id)
                            ->select('students.name', 'students.username', 'students.email', 'students.phone', 'students.year', 'students.class')->get();

            return view('admin.studentpr', ['sinhvien' => $student_list, 'svid' => $student, 
                            'project' => $project, 'giangvien' => $teacher, 
                            'department_criteria' => $department_criteria, 'listkehoach' => $plan]);
        }
        else if (Auth::guard('teacher')->check())
        {
            $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                    ->join('students', 'attends.id_student', '=', 'students.id')
                    ->where('projects.id', $id)
                    ->select('students.name', 'students.email', 'students.phone', 'students.year', 'students.class')->get();

            $teacher_info = Teacher::where('id', $project->id_teacher)->first();
            $plan = Teacher_plan::where('id_project', $id)->get();

            return view('teacher.studentpr', ['sinhvien' => $data, 'project' => $project, 
            'giangvien' => $teacher, 'department_criteria' => $department_criteria,
            'listkehoach' => $plan, 'teacher_info' => $teacher_info]);
        } 
        else if (Auth::guard('student')->check())
        {
            $svid = Auth::guard('student')->user()->id;

            $student_info = Student::where('id', $svid)->first();
            $plan = Teacher_plan::where('id_project', $id)->get();

            $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                        ->join('students', 'attends.id_student', '=', 'students.id')
                        ->where('projects.id', $id)
                        ->select('students.name', 'students.email', 'students.phone', 'students.year', 'students.class')->get();

            return view('student.studentpr', ['sinhvien' => $data, 'project' => $project, 
                            'giangvien' => $teacher, 'department_criteria' => $department_criteria,
                            'student_info' => $student_info, 'listkehoach' => $plan]);
        }
    }
}