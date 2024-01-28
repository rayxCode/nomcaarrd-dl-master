<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class ApptController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $appointment = Appointments::query();
        if ($search) {
            $appointment->where('name', 'like', '%' . $search . '%');
        }
        else
        {
            $appointment->where('status', 0);
        }
        $appointments = $appointment->paginate(10);

        return view('admin.admin_appointments', compact('appointments', 'search'));
    }

    //
    public function store(Request $request){
        $appointment = Appointments::create([
            'name' => $request->input('name'),
            'time' => $request->input('schedule'),
            'status' => 0,
        ]);
        return back()->with('success', 'Successfully filed a schedule for a library visit.');
    }

    public function index()
    {
        $appointments = Appointments::where('status', 0)->whereDate('time', now()->toDateString())->paginate(10);

        return view('admin.admin_appointments', compact('appointments'));
    }


    public function completed(Request $request){
        $appointment = Appointments::findOrFail($request->input('id'));
        $appointment->status = 1;
        $appointment->update();

        return redirect()->back()->with('success', 'Scheduled appointment is now complete');
    }
}
