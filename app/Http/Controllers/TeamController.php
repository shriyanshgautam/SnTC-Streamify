<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Http\Request;
use App\AppUser;
use App\Team;


class TeamController extends Controller
{
    public function create_team(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('team_name')){
            $error_response['status']='Error : team_name not received.';
            return response($error_response);
        }

        if(!$request->has('event_id')){
            $error_response['status']='Error : event id not received.';
            return response($error_response);
        }

        $app_user = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $team = new Team();
        $team->event_id = $request->event_id;
        $team->name = $request->team_name;

        $team->save();

        $team_member = new TeamMember();
        $team_member->rollNo = $request->rollNo;
        $team_member->team_id = $team->id;
        $team_member->is_creator = true;

        $team_member->save(); // save it

        return response()->json([
            "status" => "OK",
            "team_id" => $team->id
        ]);
    }

    public function add_members(Request $request){
        $error_response['status_code'] = '0';
        $success_response['status_code'] = '1';

        if(!$request->has('rollNo')){
            $error_response['status']='Error : rollNo not received.';
            return response($error_response);
        }

        if(!$request->has('team_id')){
            $error_response['status']='Error : team_id not received.';
            return response($error_response);
        }

        $appUser = AppUser::where('rollNo',$request->rollNo)->first();
        if($app_user==null){
            $error_response['status']='Error : User not found.';
            return response($error_response);
        }

        $team = Team::find($request->team_id);
        if($team==null){
            $error_response['status']='Error : Team with given ID not found.';
            return response($error_response);
        }

        $team_member = new TeamMember();
        $team_member->rollNo = $request->rollNo;
        $team_member->team_id = $team->id;
        $team_member->is_creator = false;

        $team_member->save(); // save it

        return response()->json([
            "status" => "OK"
        ]);
    }

    public function get_my_teams(Request $request){
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

        $results = TeamMember::where('rollNo','=',$request->rollNo)->get();
        if($results==null){
            $error_response['status']='Error : No results found.';
            return response($error_response);
        }

        return response($results);
    }
}
