<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUser;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_users = AppUser::paginate(30);
        return view('app_user.list',['app_users'=>$app_users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //TODO test this method
        $app_user = AppUser::find($id);
        $streams=$app_user->streams()->get();
        $notifications=$app_user->notifications()->get();
        $app_posts=$app_user->appPosts()->get();
        $feedback=$app_user->feedback()->get();
        if($streams->count()>0 || $notifications->count()>0 || $app_posts->count()>0 || $feedback->count()>0){
            // cannot delete
            return redirect('app_users')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$app_user->name.' ! Has some dependecy.']);
        }else{
            $app_user->delete();
            return redirect('app_users')->with(['status'=>'success','status_string'=>'Deleted '.$app_user->name.' !']);
        }
    }
}
