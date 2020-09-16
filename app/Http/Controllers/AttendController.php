<?php

namespace App\Http\Controllers;

use App\Attend;
use Illuminate\Http\Request;

class AttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                    ->join('students', 'attends.id_student', '=', 'students.id')
                    ->where('projects.id', $id)
                    ->select('students.name', 'students.email', 'students.phone', 'students.class', 'students.class')->get();

        return view('teacher.studentpr', ['sinhvien' => $data]);
    }

    public function AttendStudent($id)
    {
        $svid = Auth::guard('student')->user()->id;

        // $currentTime = Carbon\Carbon::now();

        // $result = DB::table('plan')
        //     ->where('id_project', $svid)
        //     ->select('ketthuc')  
        //     ->orderBy(DB::raw('ABS( DATEDIFF( ketthuc, NOW() ) )'))
        //     ->first();

        $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                    ->join('students', 'attends.id_student', '=', 'students.id')
                    ->where('projects.id', $id)
                    ->select('students.name', 'students.email', 'students.phone', 'students.year', 'students.class')->get();

        return view('student.studentpr', ['sinhvien' => $data]);
    }

    public function AttendAdmin($id)
    {
        $sv = DB::table('students')->get();

        $data = DB::table('attends')->join('projects', 'attends.id_project', '=', 'projects.id')
                    ->join('students', 'attends.id_student', '=', 'students.id')
                    ->where('projects.id', $id)
                    ->select('students.name', 'students.username', 'students.email', 'students.phone', 'students.year', 'students.class')->get();

        return view('admin.studentpr', ['sinhvien' => $data, 'svid' => $sv, 'prid' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function edit(Attend $attend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attend $attend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attend  $attend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attend $attend)
    {
        //
    }
}
