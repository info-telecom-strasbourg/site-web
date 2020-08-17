<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Constructor.
     */
    public function __contruct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::latest()->paginate(10);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created topic in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        // save topic through the relationship 
        $topic = auth()->user()->topics()->create($data);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the specified topic.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        $topic->update($data);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        Topic::destroy($topic->id);

        return redirect('/topics');
    }
}