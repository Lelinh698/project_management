<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department_criteria;
use App\Teacher_criteria;
use App\Student;
use App\Teacher;
use App\Attend;
use App\Project;
use Auth;
use Response;

class AjaxController extends Controller
{
    public function ajaxCriteria(Request $request) {
        // $number = count($request->criteria_name);
        
        parse_str($request->data, $array);
        $project = Project::find($request->prid);
        
        if(Auth::guard('admin')->check()){
            $sum = 0;
            $number = count($array['end_criteria']);
            $deletedRows = Department_criteria::where('id_project', $request->prid)->delete();
            for ($i = 0; $i < $number; $i++) {
                $criteria = Department_criteria::create([
                    'id_project' => $request->prid, 
                    'name' => $array['end_criteria'][$i],
                    'weight' => $array['end_weight'][$i],
                    'mark' => $array['end_mark'][$i],
                ]);

                $sum += $array['end_weight'][$i] * $array['end_mark'][$i];
            }

            if(isset($project->assess->id)) {
                DB::table('assesses')->where('id', $project->assess->id)->update(['end_mark' => $sum]);
            }
            else {
                DB::table('assesses')->insert(
                    ['end_mark' => $sum, 'id_project' => $request->prid]
                );
            }
        } 
        elseif(Auth::guard('teacher')->check())
        {   
            $sum = 0;
            $number = count($array['criteria']);
            $deletedRows = Teacher_criteria::where('id_project', $request->prid)
                            ->where('type', 0)->delete();
            for ($i = 0; $i < $number; $i++) {
                $criteria = Teacher_criteria::create([
                    'id_project' => $request->prid, 
                    'name' => $array['criteria'][$i],
                    'weight' => $array['weight'][$i],
                    'mark' => $array['mark'][$i],
                    'type' => 0, //đồ án loại 2
                ]);

                $sum += $array['weight'][$i] * $array['mark'][$i];
            }

            if(isset($project->assess->id)) {
                DB::table('assesses')->where('id', $project->assess->id)->update(['process_mark' => $sum]);
            }
            else {
                DB::table('assesses')->insert(
                    ['process_mark' => $sum, 'id_project' => $request->prid]
                );
            }
        }
        
        echo json_encode($array);
    }

    public function endCriteria(Request $request) {
        
        parse_str($request->data, $array);
        $project = Project::find($request->prid);
        $sum = 0;
        $number = count($array['end_criteria']);
        $deletedRows = Teacher_criteria::where('id_project', $request->prid)
                        ->where('type', 1)->delete();
        for ($i = 0; $i < $number; $i++) {
            $criteria = Teacher_criteria::create([
                'id_project' => $request->prid, 
                'name' => $array['end_criteria'][$i],
                'weight' => $array['end_weight'][$i],
                'mark' => $array['end_mark'][$i],
                'type' => 1, // đồ án loại 1
            ]);

            $sum += $array['end_weight'][$i] * $array['end_mark'][$i];
        }

        if(isset($project->assess->id)) {
            DB::table('assesses')->where('id', $project->assess->id)->update(['end_mark' => $sum]);
        }
        else {
            DB::table('assesses')->insert(
                ['end_mark' => $sum, 'id_project' => $request->prid]
            );
        }

        echo json_encode($array);
    }

    public function studentList() {
        $student = Student::select('name', 'mssv', 'username', 'email', 'phone', 'year', 'class', 'birth', 'address')->get();
        $data = array();
        $data['data'] = $student;
        echo json_encode($data);
    }

    public function ajaxStudent() {
        $matches = array();

        $result = Student::select('id', 'name', 'mssv')->get();
        
        foreach ($result as $student) {
            $matches[$student->id] = $student->mssv . " - " . $student->name;
        }

        return response()->json($matches);
    }

    public function ajaxTeacher(Request $request) {
        $sql = Teacher::where('id_department', $request['departmentID'])->select('id', 'name')->get();

    	$result = array();
    	foreach ($sql as $teacher) {
    		$result[$teacher->id] = $teacher->name;
    	}

    	// $result['0'] = '';

    	return response()->json($result);
    }

    public function getStudent(Request $request)
    {
        $student = Attend::where('id_project', $request['id_project'])->select('id_student')->get();

        echo json_encode($student);
    }
}
