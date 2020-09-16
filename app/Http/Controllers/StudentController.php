<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Redirect,Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getData = Student::all();
    
        // return view('admin.studentlist')->with('listhocsinh',$getData);

        if(request()->ajax()) {
            return datatables()->of(Student::select('id','name', 'mssv', 'username', 'email', 'phone', 'year', 'class', 'birth', 'address'))
            ->addColumn('action', 'DataTables.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.studentlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.studentcreate');
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
        $mssv = $allRequest['mssv'];
        $username = $allRequest['username'];
        $password = $allRequest['password'];
        $email = $allRequest['email'];
        $sodienthoai = $allRequest['sodienthoai'];
        $lop = $allRequest['lop'];
        $khoa = $allRequest['khoa'];
        $ngaysinh = $allRequest['ngaysinh'];
        $quequan = $allRequest['quequan'];

        $studentId = $allRequest['student_id'];
        $student = Student::updateOrCreate(
                    ['id' => $studentId],
                    ['name'  => $hoten,
                    'mssv' => $mssv,
                    'email' => $email,
                    'phone' => $sodienthoai,
                    'class' => $lop,
                    'year' => $khoa,
                    'birth' => $ngaysinh,
                    'address' => $quequan,
                    'username' => $username,
                    'password' => Hash::make($password),
                    ]);        
        return Response::json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
    
        return Response::json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::where('id', '=', $id)->delete();
        
        return Response::json($student);
    }
}
