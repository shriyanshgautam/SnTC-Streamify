<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Author;
use App\Location;
use App\Stream;
use App\Tag;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('event.list',['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $locations = Location::all();
        $streams = Stream::all();
        $tags = Tag::all();
        return view('event.create',['authors'=>$authors,'locations'=>$locations,'streams'=>$streams,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = Author::find($request->author_id);
        $location = Location::find($request->location_id);
        $stream = Stream::find($request->stream_id);
        $tag = Tag::find($request->tag_id);

        $event = new Event;
        $event->title = $request->title;
        $event->subtitle = $request->subtitle;
        $event->description = $request->description;
        // TODO file handling
        $event->image = '123.jpg';
        $event->time = Carbon::parse($request->time);
        $event->author_id=$request->author_id;
        $event->location_id = $request->location_id;
        $event->stream_id=$request->stream_id;
        $event->tag_id=$request->tag_id;
        $event->save();



        return redirect('events')->with(['status'=>'success','status_string'=>'Added '.$event->name.'!']);;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('event.detail',['event'=>$event]);
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
    public function update(Request $request, $id)
    {
        //
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
}
