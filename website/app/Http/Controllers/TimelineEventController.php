<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimelineEvent;
use App\Pole;
use App\Projet;

class TimelineEventController extends Controller
{
	public function store($id)
	{
		$event = TimelineEvent::create($this->validateRequest());
		if($event->timeline_type == 'App\Pole')
		{
			$pole = Pole::where('id', $id)->first();
			return redirect('/poles/' . $pole->slug);
		}
		else
			return redirect('/projets/' . $event->reference_id);
	}

	public function update(TimelineEvent $step)
	{
		$step->update($this->validateRequest());
		if($step->timeline_type == 'App\Pole')
		{
			$pole = Pole::where('id', $step->reference_id)->first();
			return redirect('/poles/' . $pole->slug);
		}
		else
			return redirect('/projets/' . $step->reference_id);
	}

	public function destroy(TimelineEvent $step)
	{
		$refId = $step->reference_id;
		$isPole = ($step->timeline_type == 'App\Pole');
		$step->delete();
		if($isPole)
		{
			$pole = Pole::where('id', $refId)->first();
			return redirect('/poles/' . $pole->slug);
		}
		else
			return redirect('/projets/' . $refId);
	}

	public function validateRequest()
	{
		return request()->validate([
			'desc' => ['required'],
			'date' => ['required'],
			'reference_id' => ['required'],
			'timeline_type' => ['required', 'min:1', 'max:255'],
		]);
	}
}
