<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){}
    
    public function OldSalary()
    {
      $currentYear = date('Y');
      $currentMonth = date('m');
      $data = Salary::where(function ($query) use ($currentYear, $currentMonth) {
        $query->whereYear('created_at', '<>', $currentYear)
          ->orWhere(function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('created_at', '<>', $currentYear)
                ->orWhere(function ($query) use ($currentMonth) {
                    $query->whereMonth('created_at', '<>', $currentMonth);
                });
         });
      });
      $count = $data->count();
      $old = $data->paginate(10);
      $data = $data->get();
    //  return view('salaries.old', compact('old', 'count'));
    }
    
    public function DeleteOldSalary(){
      $currentYear = date('Y');
      $currentMonth = date('m');
      Salary::where(function ($query) use ($currentYear, $currentMonth) {
        $query->whereYear('created_at', '<>', $currentYear)
        ->orWhere(function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('created_at', '<>', $currentYear)
                ->orWhere(function ($query) use ($currentMonth) {
                    $query->whereMonth('created_at', '<>', $currentMonth);
                });
        });
      })
        ->delete();
        return redirect()->route('salary_paid');
    }
    
    public function store(Request $request)
    {
      $salary = new Salary([
          'emp_id' => $request->emp_id,
          'job_id' => $request->job_id,
          'salary' => $request->salary,
          'ratio' => $request->ratio
      ]);
      $salary->save();
      return redirect()->route('salary_unpaid')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $Salary = Salary::find($id);
        if (!$Salary) {
            return response()->json([
              "ok"=>false,
              "message"=>"ID : $id Not Found",
              "data"=>""
            ],404);
        }
        return response()->json([
            "ok"=>true,
            "message"=>"Data Is Found",
            "data"=>$Salary
          ]);
    }

    public function destroy(string $id)
    {
        Salary::destroy($id);
        return redirect()->route('salary_paid');
    }
    
    public function PaidSalary(Request $request)
    {
      $currentYear = date('Y');
      $currentMonth = date('m');
      
      if ($request->has('search')) {
          $salariesQuery = Salary::whereHas('employee', function ($query) use ($request) {
              $query->where('emp_name', 'like', '%' . $request->input('search') . '%');
          })->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
          $paid = $salariesQuery->paginate(10);
          $count = $paid->total();
      } else {
          $salariesQuery = Salary::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
          $paid = $salariesQuery->paginate(10);
          $count = $paid->total();
      }
      $totalPaidSalaries = $paid->sum('salary'); 
    //  return view('salaries.paid', compact('paid', 'count', 'totalPaidSalaries'));
    }
    
    public function UnPaidSalary(Request $request)
    {
      $currentYear = date('Y');
      $currentMonth = date('m');
      $salarysThisMonth = Salary::whereYear('created_at', $currentYear)
          ->whereMonth('created_at', $currentMonth)
          ->pluck('emp_id'); 
   /*
      $data = Employee::whereNotIn('id', $salarysThisMonth)->get();
      $count = count($data);
      $unpaid = Employee::whereNotIn('id', $salarysThisMonth)->paginate(10);
  */    
      if ($request->has('search')) {
          $unpaidQuery = Employee::where('emp_name', 'like', '%' . $request->input('search') . '%')
              ->whereNotIn('id', $salarysThisMonth);
      } else {
          $unpaidQuery = Employee::whereNotIn('id', $salarysThisMonth);
      }
      $unpaid = $unpaidQuery->paginate(10);
      $count = $unpaid->total();
            
      // return view('salaries.unpaid', compact('unpaid','count'));
    }

}
