<?php

namespace App\Http\Controllers;

use App\Models\Expens;
use Illuminate\Http\Request;

class ExpensController extends Controller
{
    private $remainingAmount;
    
    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        if ($request->has('search')) {
            $expensesQuery = Expens::whereYear('created_at', $currentYear)
              ->whereMonth('created_at', $currentMonth)
              ->where('reason', 'like', '%' . $request->input('search') . '%');
        } else {
            $expensesQuery = Expens::whereYear('created_at', $currentYear)
              ->whereMonth('created_at', $currentMonth);
        }
        $expenses = $expensesQuery->paginate(10);
        $count = $expenses->total();
        $totalQuery = clone $expensesQuery; 
        $total = $totalQuery->sum('expens');
        $remaining_amount = HomeController::getRemainingAmount() - $total;
        session(['remaining_amount'=>$remaining_amount]);
        return view('expenses.index', compact('expenses','count','total','remaining_amount'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'expens' => 'required',
          'reason' => 'required|max:200',
          'date_at' => 'required'
      ]);
      if ($request->expens > session('remaining_amount') ) {
          return redirect()->route('expenses.index')->with('warning', 'true');
      }
      $expens = new Expens([
          'expens' => $request->expens,
          'reason' => $request->reason,
          'date_at' => $request->date_at,
      ]);
      $expens->save();
      return redirect()->route('expenses.index')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $expens = Expens::find($id)->expens;
        $expenses = Expens::find($id)->expenses;
        return view('expenses.view', compact('expenses','expens'));
    }

    public function edit(string $id)
    {
        $expens = Expens::find($id);
        return view('expenses.edit', compact('expens'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
          'expens' => 'required',
          'reason' => 'required|max:200',
          'date_at' => 'required',
        ]);
        $expens = Expens::findOrFail($id);
        $expens->expens = $request->input('expens');
        $expens->reason = $request->input('reason');
        $expens->date_at = $request->input('date_at');
        $expens->save();
        return redirect()->route('expenses.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Expens::destroy($id);
        return redirect()->route('expenses.index');
    }
}
