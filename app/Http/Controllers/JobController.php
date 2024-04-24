<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employee;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $jobsQuery = Job::where('job_name', 'like', '%' . $request->input('search') . '%');
            $jobs = $jobsQuery->paginate(10); 
            $count = $jobs->total();
        } else {
            $jobs = Job::paginate(10); 
            $count = Job::count();
        }
        return view('jobs.index', compact('jobs','count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'job_name' => 'required|min:3|max:20',
      ]);
      $job = new Job([
          'job_name' => $request->job_name
      ]);
      $job->save();
      return redirect()->route('jobs.index')->with('add_success', 'true');
    }

    public function show(Request $request,string $id)
    {
        $job_name = Job::find($id)->job_name;
        
        $employeesQuery = Employee::whereHas('job', function ($query) use ($id) {
            $query->where('id', $id);
        });
        if ($request->has('search')) {
            $employeesQuery->where('emp_name', 'like', '%' . $request->input('search') . '%');
        }
        $employees = $employeesQuery->paginate(10);
        $count = $employees->total();
    
        
      //  return view('jobs.view', compact('employees','job_name','count'));
    }

    public function edit(string $id)
    {
        $job = Job::find($id);
      //  return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'job_name' => 'required|min:3|max:20'
        ]);
        $job = Job::findOrFail($id);
        $job->job_name = $request->input('job_name');
        $job->save();
        return redirect()->route('jobs.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Job::destroy($id);
        return redirect()->route('jobs.index');
    }
}
