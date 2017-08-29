<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Author;
use App\Stream;
use App\Tag;
use App\Content;

use Carbon\Carbon;
use App\Repositories\FirebaseCloudMessaging;

use App\Repositories\Dropbox;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::orderBy('id','desc')->paginate(6);
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"notification".Carbon::now()->timestamp.".jpg","/Notifications/");
            $notification->image = $url;
        }else{
            $notification->image = "";
        }

        $notification->time = Carbon::parse($request->time);;
        $notification->author_id=$request->author_id;
        $notification->stream_id=$request->stream_id;
        $notification->tag_id=$request->tag_id;
        $notification->fcm_json_response = json_encode(["response"=>"null"]);
        $notification->save();

        if(isset($request->content_ids)){
            $notification->contents()->sync($request->content_ids);
        }

        //Data to Big only if error page goes as notification
        $insertedNotification = Notification::with(['author','stream','tag','contents'])->find($notification->id);
        $fcmData["type"]=1;
        $fcmData["notification"]=$insertedNotification;
        $fcmData["notification"]["user_like_type"]=3;//FOR NEUTRAL
        //TODO
        $fcmData["notification"]["likes"]=0;
        $fcmData["notification"]["dislikes"]=0;

        $response = $this->sendFcmNotification($fcmData);
        $notification->fcm_json_response = $response;

        $notification->save();



        return redirect('notifications')->with(['status'=>'success','status_string'=>'Added '.$notification->name.'!']);;

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
     * sendFcmNotification - description
     *
     * @param  {type} $data description
     * @return {type}       description
     */
    public function sendFcmNotification($data){
        $firebaseCloudMessaging = new FirebaseCloudMessaging();
        return $firebaseCloudMessaging->sendNotification($data,"DEBUG");
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
