<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('google_auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id','desc')->paginate(6);;
        return view('tag.list',['tags'=>$tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->level = $request->level;
        $tag->save();

        return redirect('tags')->with(['status'=>'success','status_string'=>'Added '.$tag->name.'!']);;

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
        $tag = Tag::find($id);
        return view('tag.create',['tag'=>$tag]);
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
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->level = $request->level;
        $tag->save();

        return redirect('tags')->with(['status'=>'success','status_string'=>'Updated '.$tag->name.' !']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $events=$tag->events()->get();
        $notifications=$tag->notifications()->get();
        if($events->count()>0 || $notifications->count()>0){
            // cannot delete
            return redirect('tags')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$tag->name.' ! Has some dependecy.']);
        }else{
            $tag->delete();
            return redirect('tags')->with(['status'=>'success','status_string'=>'Deleted '.$tag->name.' !']);
        }
    }
}
