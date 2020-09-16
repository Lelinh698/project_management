<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Department_plan;
use App\Teacher_plan;
use Illuminate\Http\Request;
use Auth;
use Redirect,Response;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::guard('teacher')->check()) {
            if(request()->ajax()) {
                $plan = Teacher_plan::select('deadline', 'description')
                        ->where('id_project', '=' , $request->id_project);
    
                return datatables()->of($plan)
                ->addIndexColumn()
                ->make(true);
            }
            return view('teacher.studentpr');
        }
        elseif(Auth::guard('admin')->check()) 
        {

            if(request()->ajax()) {
                $plan = Department_plan::all();
    
                return datatables()->of($plan)
                ->addIndexColumn()
                ->make(true);
            }
            return view('admin.planlist');
        }
    }

    function planListStudent($id) {
        $plan = Plan::where('id_project', $id)->get();

        $svid = Auth::guard('student')->user()->id;

        $currentTime = Carbon\Carbon::now();

        $result = DB::table('plan')
            ->where('id_project', $svid)
            ->select('deadline')  
            ->orderBy(DB::raw('ABS( DATEDIFF( deadline, NOW() ) )'))
            ->first();

        return view('student.planlist', ['listkehoach' => $plan, 'id' => $id, 'time' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('teacher.plancreate', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        Teacher_plan::create([
            'id_project' => $request->id,
            'deadline' => $request->ketthuc,
            'description' => $request->mota
        ]);

        $data = Teacher_plan::where('id_project', $request->id)->get();

        echo json_encode($data);
    }

    public function dstore(Request $request)
    {   
        $departmentPlan_id = $request->departmentPlan_id;
        $departmentPlan = Department_plan::updateOrCreate(
                            ['id' => $departmentPlan_id],
                            ['name'  => $request->name,
                            'description' => $request->description,
                            'request' => $request->planrequest,
                            'deadline' => $request->time,
                            ]
                        );

        return Response::json($departmentPlan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
    
    public function getDepartmentPlan()
    {
        $plan = Department_plan::all();

        return view('student.planlist', ['listkehoach' => $plan]);
    }
}
