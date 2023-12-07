<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario;

class ScheduleController extends Controller
{
    public function index()
	{
		return view('schedule.show', [
		'calendarios' => Calendario::where(function ($query) {
			$query->where('user_id', request()->user()->id);
		})->paginate(50)
		]);
	}

	public function create()
	{
		return view('schedule.create');
	}

    public function edit($id)
    {
        $schedule = Calendario::find($id);
        return view('schedule.edit')->with('schedule', $schedule);
    }

    public function store(Request $request)
	{
        $schedule = new Calendario();

        $schedule->date = $request->get('date');
        $schedule->time = $request->get('time');
		$schedule->user_id = request()->user()->id;
        $schedule->status = 'true';

        $schedule->save();

		return redirect('schedule');
	}

    public function update(Request $request, $id)
	{
        $schedule = Calendario::find($id);

        $schedule->date = $request->get('date');
        $schedule->time = $request->get('time');

        $schedule->save();

		return redirect('schedule');
	}

    public function destroy($id)
    {
        $schedule = Calendario::find($id);
        $schedule->delete();

        return redirect('schedule');
    }
}
