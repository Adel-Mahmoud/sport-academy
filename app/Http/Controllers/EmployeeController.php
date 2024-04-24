<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $jobs = Job::all(); 
        if ($request->has('search')) {
            $employeesQuery = Employee::where('emp_name', 'like', '%' . $request->input('search') . '%')->orderBy('job_id');
            $employees = $employeesQuery->paginate(10); 
            $count = $employees->total();
        } else {
            $employees = Employee::orderBy('job_id')->paginate(10); 
            $count = Employee::count();
        }
      //  return view('employees.index', compact('employees','jobs','count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'emp_name' => 'required|min:4|max:20',
          'job_id' => 'required',
      ]);
      $employee = new Employee([
          'emp_name' => $request->emp_name,
          'job_id' => $request->job_id
      ]);
      $employee->save();
      return redirect()->route('employees.index')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
              "ok"=>false,
              "message"=>"ID : $id Not Found",
              "data"=>""
            ],404);
        }
        return response()->json([
            "ok"=>true,
            "message"=>"Data Is Found",
            "data"=>$employee
          ]);
    }

    public function edit(string $id)
    {
        $jobs = Job::all();
        $employee = Employee::find($id);
      //  return view('employees.edit', compact('employee','jobs'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'emp_name' => 'required|min:3|max:20',
            'job_id' => 'required',
        ]);
        $employee = Employee::findOrFail($id);
        $employee->emp_name = $request->input('emp_name');
        $employee->job_id = $request->input('job_id');
        $employee->save();
        return redirect()->route('employees.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index');
    }
}
