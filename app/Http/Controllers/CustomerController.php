<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $customers = Customer::orderBy('name')->paginate();
        return view('customers.index')->with('customers', $customers);
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
        Customer::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'credit' => $request->credit,
            'account' => $request->account
        ]);

        return redirect()->back()->with('success', $request->name . ' registered as a credit customer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->contact = $request->contact;
        $customer->credit = $request->credit;
        $customer->account = $request->account;
        $customer->save();

        return redirect()->back()->with('success', 'Information of ' . $request->name . ' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', $customer->name . ' has been removed from databse.');
    }

    /**
     * Change user employed status to 0.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clear(Customer $customer)
    {
        $customer->credit = 0;
        $customer->save();
        return redirect()->back()->with('success', 'Credit of ' . $customer->name . ' has been set to MVR 0.00.');
    }
}
