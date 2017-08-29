<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;
use App\AppUser;
use App\Notification;

class AppController extends Controller
{
    //
    //
    public function get_streams(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';


        if(!$request->has('user_id')){
            $error_response['status']='Error : user_id not received.';
            return response($error_response);
        }

        $app_user = AppUser::find($request->user_id);
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $user_streams = $app_user->streams();
        $streams = Stream::with(['author','positionHolders','bodies'])->get();
        foreach($streams as $stream){
            $stream['is_subscribed']=false;
            foreach($user_streams as $user_stream){
                if($user_stream->id==$stream->id){
                    $stream['is_subscribed']=true;
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

        if(!$request->has('user_id')){
            $error_response['status']='Error : user_id not received.';
            return response($error_response);
        }

        $app_user = AppUser::find($request->user_id);
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $events = AppUser::with('streams.events')->find($request->user_id);
        $success_response['data']['events'] = $events;
        $success_response['status']='OK';
        return response($success_response);
    }

    public function get_notifications(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('user_id')){
            $error_response['status']='Error : user_id not received.';
            return response($error_response);
        }

        $app_user = AppUser::find($request->user_id);
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $insertedNotification = Notification::with(['author','stream','tag','contents'])->find(1);
        $success_response['data']['notification'] = $insertedNotification;
        $success_response['status']='OK';
        $success_response['data']["notification"]["user_like_type"]=3;//FOR NEUTRAL
        //TODO
        $success_response['data']["notification"]["likes"]=0;
        $success_response['data']["notification"]["dislikes"]=0;
        return response($success_response);
    }
}
