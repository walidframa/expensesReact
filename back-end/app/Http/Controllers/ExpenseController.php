<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ExpenseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = Expense::where('user_id', Auth::id())->get();
        return response()->json($expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchByName()
    {
        $expenses = Expense::where('user_id', Auth::id())->orderBy('name', 'asc')->get();
        return response()->json($expenses);
    }

    public function fetchByCategory()
    {
        $expenses = Expense::where('user_id', Auth::id())->orderBy('category_id', 'asc')->get();
        return response()->json($expenses);
    }

    public function fetchByDate()
    {
        $expenses = Expense::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return response()->json($expenses);
    }

    public function fetchByAmount()
    {
        $expenses = Expense::where('user_id', Auth::id())->orderBy('amount', 'desc')->get();
        return response()->json($expenses);
    }


    public function fetchByFilterDate(Request $request)
    {   

        $startDate = $request->start_date;
            

        $endDate = $request->end_date;
            

        $expenses = Expense::where('user_id', Auth::id())->where('created_at','>=', $startDate)->where('created_at', '<=', $endDate)->get();
        return response()->json($expenses);
    }

    public function fetchFilterByCat(Request $request)
    {
        $category = $request->categoryId;
        $expenses = Expense::where('user_id', Auth::id())->where('category_id', '=', $category)->get();
        return response()->json($expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'amount' => 'required',
            'created_at' => 'required'
            
        ]);
        $expense = Expense::create($request->all());
        return response()->json(['message'=> 'expense created', 
        'expense' => $expense]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return $expense;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        
        $validatedAttributes = request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'category_id' => 'required' //optional if you want this to be required
        ]);
        $expense->update($validatedAttributes);
        
        return response()->json([
            'message' => 'expense updated!',
            'expense' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'message' => 'expense deleted'
        ]);
    }
}
