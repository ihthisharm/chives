<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\User;
use Illuminate\Http\Request;

class PayslipController extends Controller
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
        $payslips = Payslip::orderBy('paid_on', 'desc')->with('user:id,name,id_card,image')->paginate();
        return view('payslips.index')->with('payslips', $payslips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->where('employed', '=', 1)->get();
        return view('payslips.create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->paid_on != '') {
            $paid_on = $request->paid_on;
        } else {
            $paid_on = date('Y-m-d');
        }

        $total = $request->amount + $request->service_charge;

        Payslip::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'service_charge' => $request->service_charge,
            'total' => $total,
            'paid_on' => $paid_on,
            'remarks' => $request->remarks
        ]);

        return redirect()->back()->with('success', 'Payslip with total of MVR ' . $total . ' ceated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function show(Payslip $payslip)
    {

        return view('payslips.show')->with('payslip', $payslip);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function edit(Payslip $payslip)
    {
        $users = User::orderBy('name')->where('employed', '=', 1)->get();
        return view('payslips.edit')->with(['payslip' => $payslip, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payslip $payslip)
    {
        $payslip->user_id = $request->user_id;
        $payslip->amount = $request->amount;
        $payslip->service_charge = $request->service_charge;
        $payslip->total = $request->amount + $request->service_charge;
        if ($request->paid_on != '') {
            $payslip->paid_on = $request->paid_on;
        } else {
            $payslip->paid_on = date('Y-m-d');
        }
        $payslip->remarks = $request->remarks;
        $payslip->save();

        return redirect()->back()->with('success', 'Payslip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payslip  $payslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payslip $payslip)
    {
        $payslip->delete();
        return redirect('/payslips')->with('success', 'Payslip deleted successfully.');
    }
}
