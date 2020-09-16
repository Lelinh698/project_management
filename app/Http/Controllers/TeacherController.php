<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Redirect,Response;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $data = DB::table('teachers')
                    ->join('departments', 'departments.id', '=', 'teachers.id_department')
                    ->select('teachers.name as tname', 'email', 'phone', 'degree', 'teachers.id as tid', 'departments.name as dname')
                    ->get();

            return datatables()->of($data)
            ->addColumn('action', 'DataTables.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $department = Department::all();

        return view('admin.teacherlist', ['bomon' => $department]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bomon = DB::table('departments')->get();

        return view('admin.teachercreate', ['bomon' => $bomon ]);
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
        $hoten  = $allRequest['hoten'];
        $username = $allRequest['username'];
        $password = $allRequest['password'];
        $email = $allRequest['email'];
        $sodienthoai = $allRequest['sodienthoai'];
        $bomon = $allRequest['bomon'];
        $hocvi = $allRequest['hocvi'];
        $ngaysinh = $allRequest['ngaysinh'];
        $quequan = $allRequest['quequan'];

        $teacherId = $allRequest['teacher_id'];
        $teacher = Teacher::updateOrCreate(
                    ['id' => $teacherId],
                    ['name'  => $hoten,
                    'email' => $email,
                    'phone' => $sodienthoai,
                    'id_department' => $bomon,
                    'degree' => $hocvi,
                    'birth' => $ngaysinh,
                    'address' => $quequan,
                    'username' => $username,
                    'password' => Hash::make($password),
                    ]);        
        return Response::json($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);
    
        return Response::json($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::where('id', '=', $id)->delete();
        
        return Response::json($teacher);
    }

}
