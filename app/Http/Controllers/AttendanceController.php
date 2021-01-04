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
        $today = date('Y-m-d');
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

        foreach ($users as $user) {
            $attendance = Attendance::where(['user_id' => $user->id, 'date' => date('Y-m-d')])->first();
            if ($attendance) {
                if ($attendance->present && !$attendance->remarks) {
                    $user->status = 'Present';
                    $user->LED = 'bg-success';
                } elseif ($attendance->present && $attendance->remarks) {
                    $user->status = $attendance->remarks;
                    $user->LED = 'bg-info';
                } else {
                    $user->status = ($attendance->remarks) ? $attendance->remarks : 'Absent';
                    $user->LED = 'bg-warning';
                }
            } else {
                $user->status = 'Waiting...';
                $user->LED = 'bg-warning';
            }

            $user->earnings = Attendance::where(['user_id' => $user->id, 'present' => 1])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->get();
            $user->deductions = Attendance::where(['user_id' => $user->id, 'present' => 0])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->get();

            $payable = ((count($user->earnings) - count($user->deductions)) <= 0) ? 0 : count($user->earnings);
            $user->percentage = floor(($payable / $end_of_month) * 100);

            $user->payable = ($user->percentage / 100) * $user->salary;
        }

        return view('attendances.index')->with([
            'users' => $users,
            'holidays' => $holidays,
            'weeks' => $weeks,
            'today' => $today
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

        return redirect()
        ->back()
        ->with('success', 'Attendance Records for ' . $request->date . ' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $today = $attendance->date;

        $attendances = Attendance::where('date', '=', $attendance->date)->with('user:id,name,title,level,id_card,image')->get();

        foreach ($attendances as $attendance) {
            if ($attendance->present && !$attendance->remarks) {
                $attendance->status = 'Present';
                $attendance->LED = 'bg-success';
            }
            if ($attendance->present && $attendance->remarks) {
                $attendance->status = $attendance->remarks;
                $attendance->LED = 'bg-info';
            }
            if (!$attendance->present && $attendance->remarks) {
                $attendance->status = $attendance->remarks;
                $attendance->LED = 'bg-danger';
            }
            if (!$attendance->present && !$attendance->remarks) {
                $attendance->status = 'Absent';
                $attendance->LED = 'bg-danger';
            }
        }

        return view('attendances.show')->with([
            'attendance' => $attendance,
            'attendances' => $attendances,
            'today' => $today
        ]);
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
        $attendance = Attendance::where(['user_id' => $request->user_id, 'date' => $attendance->date])->first();

        $attendance->date = $request->date;
        $attendance->remarks =  $request->remarks;
        if ($request->present) {
            $attendance->present = 1;
        } else {
            $attendance->present = 0;
        }
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendances = Attendance::where(['date' => $attendance->date])->get();
        foreach ($attendances as $attendance) {
            $attendance->delete();
        }
        return redirect('/attendances')->with('success', 'Attendance Record for ' . date('d M Y', strtotime($attendance->date)) . ' deleted successfully');
    }
}
