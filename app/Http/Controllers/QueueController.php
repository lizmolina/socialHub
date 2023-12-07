<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
	{
		return view('queue.show', [
		'queues' => Queue::where(function ($query) {
			$query->where('user_id', request()->user()->id);
		})->paginate(30)
		]);
	}
}
