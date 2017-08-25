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

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::paginate(6);;
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

        $this->sendFcmNotification($notification);




        /******************
         * Request Format
         ********************/
        // https://fcm.googleapis.com/fcm/send
        // Content-Type:application/json
        // Authorization:key=AAAA3kKi_TA:APA91bGkb_OjJjdVD317ENl2qUlqs_vcCK69b-2nJVTuzLDZBAVwzaSKXAqKca7zLiT_f6aLKPRg57pLZhaW1OLpmr5z3WyPdqR4yVkB-JADAd4cKUZp3WaTtnlWKGNIDhl3GCE_fWA6
        //
        // { "data": {
        //     "score": "5x1",
        //     "time": "15:10"
        //   },
        //   "to" : "bk3RNwTe3H0:CI2k_HHwgIpoDKCIZvvDMExUdFQ3P1..." //for only single
        //   "registration_ids" :["id1","id2",.....] //for single and multiple
        // }
         /******************
         * Response Format
         ********************/
        //  { "multicast_id": 108,
        //       "success": 1,
        //       "failure": 0,
        //       "canonical_ids": 0,
        //       "results": [
        //         { "message_id": "1:08" }
        //       ]
        //     }
        // Dropbox Access Token V7NUPdUxgsAAAAAAAAAAByKFsZ-C7xzRduweUVJVtv8sqvQhjbOj7nvlMBh--kxp
        //
        // Dropbox Upload API
        //
        // URL  :https://content.dropboxapi.com/2/files/upload
        // HEADER
        // Authorization: Bearer V7NUPdUxgsAAAAAAAAAAEOmijsBhn3vEs2rFFtzDUeLjq8TOGrMMxZXdfqrNpSfJ
        // Dropbox-API-Arg: {\"path\": \"/Homework/math/Matrices.txt\",\"mode\": \"add\",\"autorename\": true,\"mute\": false}
        //
        // DATA
        //
        // binay file
        //
        // Dropbox Share Link API
        //
        // URl : https://api.dropboxapi.com/2/sharing/create_shared_link
        //
        // HEADER
        // Authorization: Bearer V7NUPdUxgsAAAAAAAAAAEOmijsBhn3vEs2rFFtzDUeLjq8TOGrMMxZXdfqrNpSfJ
        // Content-Type: application/json
        //
        // DATA
        //   {
        //        "path": "/Homework/Math/Prime_Numbers.txt",
        //        "short_url": false
        //    }
        //
        //
        // Dropbox replace www.dropbox.com with dl.dropboxusercontent.com to get the usable url for image




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
