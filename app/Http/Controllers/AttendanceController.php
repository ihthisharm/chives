<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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
        $weekday_of_first = date('w', strtotime(date('Y-m-01'))) + 1;
        $holidays = [5, 6, 12, 13, 19, 20, 26, 27, 33, 34, 40, 41];
        $weeks = [];
        $end_of_month = date('t');
        for ($i = 1; $i < $weekday_of_first; $i++) {
            array_push($weeks, '');
        }

        for ($i = 1; $i <= $end_of_month; $i++) {
            array_push($weeks, $i);
        }

        $weeks = array_chunk($weeks, 7, true);

        $users = User::orderBy('name')->where('employed', '=', 1)->get();

        // return $users;

        foreach ($users as $user) {
            $attendance = Attendance::where(['user_id' => $user->id, 'date' => date('Y-m-d')])->first();
            if ($attendance) {
                if ($attendance->present) {
                    $user->status = 'Present';
                } else {
                    $user->status = $attendance->remarks;
                }
            } else $user->status = 'Waiting...';

            $attendance = Attendance::where(['user_id' => $user->id, 'present' => 1])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->get();
            $user->percentage = floor((count($attendance) / $end_of_month) * 100);
            $user->payable = ($user->percentage / 100) * $user->salary;
        }

        return view('attendances.index')->with(['users' => $users, 'holidays' => $holidays, 'weeks' => $weeks]);
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
        // return $request->all();
        foreach ($request->user as $user) {
            if (array_key_exists('present', $user)) {
                $present = 1;
            } else {
                $present = 0;
            }
            Attendance::create([
                'user_id' => $user['user_id'],
                'date' => $request->date,
                'present' => $present,
                'remarks' => $user['remarks'],
            ]);
        }

        return redirect()->back()->with('success', 'Attendance Records for ' . $request->date . ' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
