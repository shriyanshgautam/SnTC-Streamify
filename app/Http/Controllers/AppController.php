<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;
use App\AppUser;
use App\Notification;
use App\Feedback;
use App\AppPost;
use Carbon\Carbon;
use App\Event;
use App\AppFeedback;

class AppController extends Controller
{
    //
    //
    public function get_streams(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';


        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $user_streams = (AppUser::with('streams')->find($app_user->id)->toArray())["streams"];
        $streams = Stream::with(['author','positionHolders' => function ($q) {
                    $q->orderBy('level', 'asc');
                    },'bodies'])->get();
        for($i=0;$i<count($streams);$i++){
            $streams[$i]['is_subscribed']=false;
            for($j=0;$j<count($user_streams);$j++){
                if($user_streams[$j]["id"]==$streams[$i]["id"]){
                    $streams[$i]['is_subscribed']=true;
                }
            }
        }
                // Example of eager loading https://laravel.com/docs/5.0/eloquent#querying-relations
        $success_response['status']='OK';
        $success_response['data']['streams'] = $streams;
        return response($success_response);
    }

    public function get_events(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('last_event_id')){
            $error_response['status']='Error : last event id not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $app_streams = (AppUser::with('streams.events')->find($app_user->id)->toArray())["streams"];
        if($app_streams==null){
            $error_response['status']='Error : User Streams not found.';
            return response($error_response);
        }
        $events_ids = array();
        for($i=0;$i<count($app_streams);$i++){
            $events = $app_streams[$i]["events"];
            for($j=0;$j<count($events);$j++){
                if($events[$j]["id"]>$request->last_event_id){
                    array_push($events_ids,$events[$j]["id"]);
                }
            }
        }

        $insertedEvents = Event::with(['author','stream','tag','location'])->findMany($events_ids);

        for($i=0;$i<count($insertedEvents);$i++){
            $insertedEvents[$i]["is_user_attending"]=3;//FOR NEUTRAL
            //TODO
            $insertedEvents[$i]["attending_count"]=0;
        }
        $success_response['data']['events'] = $insertedEvents;
        $success_response['status']='OK';

        return response($success_response);
    }

    public function get_notifications(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('last_notification_id')){
            $error_response['status']='Error : last notification id not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $app_streams = (AppUser::with('streams.notifications')->find($app_user->id)->toArray())["streams"];
        if($app_streams==null){
            $error_response['status']='Error : User Streams not found.';
            return response($error_response);
        }
        $notifications_ids = array();
        for($i=0;$i<count($app_streams);$i++){
            $notifications = $app_streams[$i]["notifications"];
            for($j=0;$j<count($notifications);$j++){
                if($notifications[$j]["id"]>$request->last_notification_id){
                    array_push($notifications_ids,$notifications[$j]["id"]);
                }
            }
        }

        $insertedNotification = Notification::with(['author','stream','tag','contents'])->findMany($notifications_ids);

        for($i=0;$i<count($insertedNotification);$i++){
            $insertedNotification[$i]["user_like_type"]=3;//FOR NEUTRAL
            //TODO
            $insertedNotification[$i]["likes"]=0;
            $insertedNotification[$i]["dislikes"]=0;
        }
        $success_response['data']['notifications'] = $insertedNotification;
        $success_response['status']='OK';

        return response($success_response);
    }

    public function subscribe(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('stream_id')){
            $error_response['status']='Error : stream_id not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $stream = Stream::find($request->stream_id);
        if($stream==null){
            $error_response['status']='Error : Stream not found.';
            return response($error_response);
        }
        //Sync not attach because sync will check if exists then take action. attach will simply attach
        // resulting in redundancy of record
        $app_user->streams()->syncWithoutDetaching([$request->stream_id]);
        $success_response['status']='OK';
        $success_response['data']=AppUser::with('streams')->find($app_user->id);

        return response($success_response);
    }

    public function unsubscribe(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('stream_id')){
            $error_response['status']='Error : stream_id not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $stream = Stream::find($request->stream_id);
        if($stream==null){
            $error_response['status']='Error : Stream not found.';
            return response($error_response);
        }
        //Sync not attach because sync will check if exists then take action. attach will simply attach
        // resulting in redundancy of record
        $app_user->streams()->detach($request->stream_id);
        $success_response['status']='OK';
        $success_response['data']=AppUser::with('streams')->find($app_user->id);

        return response($success_response);
    }

    public function feedback(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';


        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        if(!$request->has('stream_id')){
            $error_response['status']='Error : stream_id not received.';
            return response($error_response);
        }

        $stream = Stream::find($request->stream_id);
        if($stream==null){
            $error_response['status']='Error : Stream not found.';
            return response($error_response);
        }

        if(!$request->has('text')){
            $error_response['status']='Error : no feedback text received.';
            return response($error_response);
        }

        $feedback = new Feedback();
        $feedback->app_user_id = $app_user->id;
        $feedback->stream_id = $request->stream_id;
        $feedback->text = $request->text;
        $feedback->save();

        $success_response["status"]="OK";
        return response($success_response);

    }

    public function app_feedback(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';


        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        if(!$request->has('text')){
            $error_response['status']='Error : no feedback text received.';
            return response($error_response);
        }

        $app_feedback = new AppFeedback();
        $app_feedback->app_user_id = $app_user->id;
        $app_feedback->text = $request->text;
        $app_feedback->save();

        $success_response["status"]="OK";
        return response($success_response);

    }

    public function app_post(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';


        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        if(!$request->has('title')){
            $error_response['status']='Error : no post title received.';
            return response($error_response);
        }

        if(!$request->has('type')){
            $error_response['status']='Error : no post type received.';
            return response($error_response);
        }

        if(!$request->has('content')){
            $error_response['status']='Error : no post content received.';
            return response($error_response);
        }

        $app_post = new AppPost();
        $app_post->app_user_id = $app_user->id;
        $app_post->title = $request->title;
        $app_post->type = $request->type;
        $app_post->content = $request->content;
        $app_post->time = Carbon::now();
        $app_post->save();

        $success_response["status"]="OK";
        return response($success_response);

    }
}
