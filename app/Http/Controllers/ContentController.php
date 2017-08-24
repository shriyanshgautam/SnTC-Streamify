<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Notification;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        return view('content.list',['contents'=>$contents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = new Content;
        $content->title = $request->title;
        $content->text = $request->text;
        $content->type = $request->type;
        $content->url = $request->url;
        $content->save();

        return redirect('contents')->with(['status'=>'success','status_string'=>'Added '.$content->name.'!']);;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::find($id);
        return view('content.create',['content'=>$content]);
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
        if(Notification::find($request->notification_id)==null){
            return back()->withErrors(['Notification not found.', 'Notification not found.'])->withInput();
        }

        $content = Content::find($id);
        $content->title = $request->title;
        $content->text = $request->text;
        $content->type = $request->type;
        $content->url = $request->url;
        $content->notification_id = $request->notification_id;
        $content->save();

        return redirect('contents')->with(['status'=>'success','status_string'=>'Updated '.$content->name.'!']);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        $content->delete();
        return redirect('contents')->with(['status'=>'success','status_string'=>'Deleted '.$content->name.' !']);


    }
}
