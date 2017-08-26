<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Stream;
use Carbon\Carbon;
use App\Repositories\Dropbox;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = Author::orderBy('id','desc')->paginate(5);
        return view('author.list',['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $author = new Author;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->contact = $request->contact;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"author".$request->email.Carbon::now()->timestamp.".jpg","/Authors/");
            $author->image = $url;
        }else{
            $author->image = "";
        }

        $author->save();

        return redirect('authors')->with(['status'=>'success','status_string'=>'Added '.$author->name.'!']);;
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
        $author = Author::find($id);
        return view('author.create',['author'=>$author]);
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
        $author = Author::find($id);
        $author->name = $request->name;
        $author->email = $request->email;
        $author->contact = $request->contact;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"author".$request->email.Carbon::now()->timestamp.".jpg","/Authors/");
            $author->image = $url;
        }else{
            $author->image = "";
        }
        $author->save();

        return redirect('authors')->with(['status'=>'success','status_string'=>'Updated '.$author->name.' !']);;
    }

    public function getDropboxLink($file,$fileName,$directory){
        $dropbox = new Dropbox();
        return $dropbox->uploadAndObtainSharableLink($file,$fileName,$directory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $author = Author::find($id);
        $streams=$author->streams()->get();
        $streams=$author->events()->get();
        $streams=$author->notifications()->get();
        if($streams->count()>0){
            // cannot delete
            return redirect('authors')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$author->name.' ! Has some dependecy.']);
        }else{
            $author->delete();
            return redirect('authors')->with(['status'=>'success','status_string'=>'Deleted '.$author->name.' !']);
        }


    }
}
