<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Storage;


class AdminActualitesController extends Controller
{
    /**
    * Get the ressources required for the admin page.
    *
    * @return the admin page.
    */
    public function getRessources()
    {
		$allNews = News::orderBy('position')->get();
        return view('page-admin/actualites', compact('allNews'));
    }

	//   Title/desc/image/link/button
	public function update(News $news, Request $request)
	{
		$validatedNews = $this->validateUpdate($request);
		if(array_key_exists('image', $validatedNews))
		{
			unlink(storage_path('app/public/' . $news->image));
			$validatedNews['image'] = $this->saveImage($validatedNews);
		}
		$this->sortNews($news, $validatedNews['position']);
		$news->update($validatedNews);


		if($request->has('links-nullable'))
			$news->update($this->validateLinks($request));
		else
			$news->update(['link' => null , 'button' => null]);

		return redirect('/page-admin/actualites');
	}

	public function sortNews(News $initNews, int $finalPos)
	{
		$allNews = News::all();
		foreach($allNews as $news)
		{
			if($news->id == $initNews->id) continue;

			if($news->position < $initNews->position && $news->position < $finalPos) continue;
			if($news->position > $initNews->position && $news->position > $finalPos) continue;

			if($news->position > $initNews->position && $news->position <= $finalPos)
				$news->update(['position' => ($news->position - 1)]);
			else
				$news->update(['position' => ($news->position + 1)]);
		}
	}

	public function validateUpdate(Request $request)
	{
		if(!$request->has('image'))
			return $request->validate([
				'title' => ['required', 'string', 'max:255', 'min:1'],
				'desc' => ['required', 'min:1'],
				'position' => ['required'],
			]);
		else
			return $request->validate([
				'title' => ['required', 'string', 'max:255', 'min:1'],
				'desc' => ['required', 'min:1'],
				'position' => ['required'],
				'image' => ['mimes:jpeg,jpg,png,gif'],
			]);
	}

	public function validateLinks(Request $request)
	{
		return $request->validate([
			'link' => ['required', 'string', 'max:255', 'min:1'],
			'button' => ['required', 'string', 'max:255', 'min:1'],
		]);
	}

	/**
     * Save an image given by the user in the public storage folder.
     *
     * @param request: the request of the user.
     * @return the path to find the image.
     */
    public function saveImage(array $validatedRequest)
    {
        $path = Storage::putFile('public/images/news', $validatedRequest['image'], 'private');
        return substr($path, 7);
    }

	public function store(Request $request)
	{
		$validatedRequest = $this->validateCreate($request);
		$validatedRequest['image'] = saveImage($validatedRequest);
		$news = News::create($validatedRredirectequest);
		$news->update(['position' => News::all()->count()]);
		$this->sortNews($news, $validatedRequest['position']);
		$news->update(['position' => $validatedRequest['position']]);
		return redirect('/page-admin/actualites');
	}

	public function validateCreate(Request $request)
	{
		if($request->has('links-nullable'))
			return $request->validate([
				'title' => ['requires', 'string', 'max:255', 'min:1'],
				'desc' => ['required', 'min:1'],
				'image' => ['required', 'mimes:jpeg,jpg,png,gif'],
				'position' => ['required'],
			]);
		else
			return $request->validate([
				'title' => ['requires', 'string', 'max:255', 'min:1'],
				'desc' => ['required', 'min:1'],
				'image' => ['mimes:jpeg,jpg,png,gif'],
				'position' => ['required'],
				'link' => ['required', 'string', 'max:255', 'min:1'],
				'button' => ['required', 'string', 'max:255', 'min:1'],
			]);
	}

	public function destroy(News $news)
	{
		unlink(storage_path('app/public/' . $news->image));
		$this->sortNews($news, News::all()->count());
		$news->delete();
		return redirect('/page-admin/actualites');
	}
}