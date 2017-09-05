<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Notification;
use Carbon\Carbon;
use App\Repositories\Dropbox;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
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
        $contents = Content::orderBy('id','desc')->paginate(5);
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

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'size:50',
            ]);
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"content".Carbon::now()->timestamp.".jpg","/Contents/");
            $content->image = $url;
        }else{
            $content->image = "";
        }

        $content->video_id = $request->video_id;
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
        $content = Content::find($id);
        $content->title = $request->title;
        $content->text = $request->text;
        $content->type = $request->type;

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'size:50',
            ]);
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"content".Carbon::now()->timestamp.".jpg","/Contents/");
            $content->image = $url;
        }else{
            $content->image = "";
        }

        $content->video_id = $request->video_id;
        $content->url = $request->url;
        $content->save();

        return redirect('contents')->with(['status'=>'success','status_string'=>'Updated '.$content->name.'!']);;

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
        $content = Content::find($id);
        $notifications = $content->notifications()->count();
        if($notifications>0){
            return redirect('contents')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$content->title.' ! Has some dependecy.']);
        }else{
            $content->delete();
            return redirect('contents')->with(['status'=>'success','status_string'=>'Deleted '.$content->name.' !']);

        }


    }
}
