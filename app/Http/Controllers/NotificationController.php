<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Author;
use App\Stream;
use App\Tag;
use App\Content;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('notification.list',['notifications'=>$notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $streams = Stream::all();
        $tags = Tag::all();
        $contents = Content::all();
        return view('notification.create',['authors'=>$authors,'streams'=>$streams,'tags'=>$tags,'contents'=>$contents]);

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
        $stream = Stream::find($request->stream_id);
        $tag = Tag::find($request->tag_id);

        $notification = new Notification;
        $notification->title = $request->title;
        $notification->subtitle = $request->subtitle;
        $notification->description = $request->description;
        $notification->link = $request->link;
        $notification->type = $request->type;
        // TODO file handling
        $notification->image = '123.jpg';
        $notification->time = Carbon::parse($request->time);;
        $notification->author_id=$request->author_id;
        $notification->stream_id=$request->stream_id;
        $notification->tag_id=$request->tag_id;
        $notification->save();

        if(isset($request->content_ids)){
            $notification->contents()->sync($request->content_ids);
        }




        return redirect('notifications')->with(['status'=>'success','status_string'=>'Added '.$notification->name.'!']);;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        return view('notification.detail',['notification'=>$notification]);
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
