<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Create a new instance with auth as middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('date', 'desc')->orderBy('id', 'desc')->with('user:id,name,id_card')->paginate();
        $this_month = Transaction::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->get();
        $last_month = Transaction::whereMonth('date', '=', date('m', strtotime('last month')))->whereYear('date', '=', date('Y', strtotime('last month')))->get();

        return view('transactions.index')->with([
            'transactions' => $transactions,
            'this_month' => $this_month,
            'last_month' => $last_month
        ]);
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

        if ($request->type) {
            $income = $request->amount;
            $expense = 0;
        } else {
            $expense = $request->amount;
            $income = 0;
        }

        Transaction::create([
            'user_id' => Auth::user()->id,
            'reference_number' => $request->date . '/' . $request->amount,
            'date' => $request->date,
            'income' => $income,
            'expense' => $expense,
            'title' => $request->title,
            'remarks' => $request->remarks
        ]);

        return redirect()->back()->with('success', 'Transaction of MVR ' . $request->amount . ' has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
