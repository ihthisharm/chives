<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::query();
        $result = $users->orderBy('name')->paginate(5);
        return view('users.index')->with('users', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = 'https://robohash.org/' . $request->id_card . '.png';
        $encryptedpassword = Hash::make($request->password);
        $date = date("Y/m/d H:i:s");
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encryptedpassword,
            'birthday' => $request->birthday,
            'id_card' => $request->id_card,
            'phone' => $request->phone,
            'title' => $request->title,
            'level' => $request->level,
            'salary' => $request->salary,
            'employed' => 1,
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Staff record for ' . $request->name . ' created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->id_card = $request->id_card;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->title = $request->title;
        $user->level = $request->level;
        $user->salary = $request->salary;
        $user->save();

        return redirect()->back()->with('success', 'Staff record for ' . $request->name . ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Change user employed status to 0.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fire(User $user)
    {
        if (!$user->employed) {
            $user->employed = 1;
            $message = $user->name . ' has been re-employed.';
        } else {
            $user->employed = 0;
            $message = $user->name . ' has been fired.';
        }
        $user->save();
        return redirect()->back()->with('success', $message);
    }

    /**
     * Show the payslips belonging to the specific user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payslips(User $user)
    {
        return view('users/payslips')->with('user', $user);
    }
}
