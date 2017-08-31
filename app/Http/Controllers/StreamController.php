<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;
use App\Author;
use App\Body;
use App\PositionHolder;
use App\Repositories\Dropbox;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $streams = Stream::orderBy('id','desc')->paginate(8);;
        return view('stream.list',['streams'=>$streams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $bodies = Body::all();
        $position_holders = PositionHolder::all();
        return view('stream.create',['authors'=>$authors,'bodies'=>$bodies,'position_holders'=>$position_holders]);
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

        $stream = new Stream;
        $stream->title = $request->title;
        $stream->subtitle = $request->subtitle;
        $stream->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"stream".Carbon::now()->timestamp.".jpg","/Streams/");
            $stream->image = $url;
        }else{
            $stream->image = "";
        }

        $stream->author_id=$request->author_id;
        $stream->save();

        //attached after insertion as before stream_id will not be available
        //use sync to remove old associations in pivot
        $stream->bodies()->sync($request->bodies);
        $stream->positionHolders()->sync($request->position_holders);

        return redirect('streams')->with(['status'=>'success','status_string'=>'Added '.$stream->name.'!']);;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stream = Stream::find($id);
        return view('stream.detail',['stream'=>$stream]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stream = Stream::find($id);
        $authors = Author::all();
        $bodies = Body::all();
        $position_holders = PositionHolder::all();
        return view('stream.create',['stream'=>$stream,'authors'=>$authors,'bodies'=>$bodies,'position_holders'=>$position_holders]);
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
        if($request->bodies==null|| $request->position_holders==null){
            return back()->withErrors(['Fields cannot be null.', 'Fields cannot be null.'])->withInput();
        }
        $author = Author::find($request->author_id);

        $stream = Stream::find($id);
        $stream->title = $request->title;
        $stream->subtitle = $request->subtitle;
        $stream->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"stream".Carbon::now()->timestamp.".jpg","/Streams/");
            $stream->image = $url;
        }else{
            $stream->image = "";
        }

        $stream->author_id=$request->author_id;
        $stream->save();

        //attached after insertion as before stream_id will not be available
        //use sync to remove old associations in pivot
        $stream->bodies()->sync($request->bodies);
        $stream->positionHolders()->sync($request->position_holders);

        return redirect('streams\\'.$id)->with(['status'=>'success','status_string'=>'Updated '.$stream->name.'!']);;

    }

    /**
     * getDropboxLink - description
     *
     * @param  {type} $file      description
     * @param  {type} $fileName  description
     * @param  {type} $directory description
     * @return {type}            description
     */
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
        //TODO test this method
        // $stream = Stream::find($id);
        // $positionHolders=$stream->positionHolders()->get();
        // $bodies=$stream->bodies()->get();
        // $appUsers=$stream->appUsers()->get();
        // $events=$stream->events()->get();
        // $notifications=$stream->notifications()->get();
        // $feedbacks=$stream->feedbacks()->get();
        //
        // if( $positionHolders->count()>0 || $bodies->count()>0 || $appUsers->count()>0 || $events->count()>0 || $notifications->count>0 || $feedbacks->count>0){
        //     return redirect('streams')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$stream->title.' ! Has some dependecy.']);
        // }else{
        //     $streams->delete();
        //     return redirect('streams')->with(['status'=>'success','status_string'=>'Deleted '.$stream->title.' !']);
        // }
        return response('Cannot delete any streams for now. Contact Administrator.');
    }
}
