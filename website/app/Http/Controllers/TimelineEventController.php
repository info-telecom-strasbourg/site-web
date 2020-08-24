<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimelineEvent;
use App\Pole;
use App\Projet;

/**
 * Controller linked to timeline events.
 */
class TimelineEventController extends Controller
{
	/**
	 * Store the event. It's called when an event is created.
	 *
	 * @param id: the id of the pole/project the events belongs to.
	 * @return the view of the pole/project the events belongs to.
	 */
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

	/**
	 * Update an event.
	 *
	 * @param step: the event to update.
	 * @return the view of the pole/project the events belongs to.
	 */
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

	/**
	 * Delete an event.
	 *
	 * @param step: the event to delete.
	 * @return the view of the pole/project the events belongs to.
	 */
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

	/**
	 * Validate a request (a description, a date, a reference id and a type:
	 * pole/project).
	 *
	 * @return an array corresponding to the validated request.
	 */
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
