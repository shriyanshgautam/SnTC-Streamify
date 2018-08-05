<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Dropbox;
use App\Repositories\FirebaseCloudMessaing;
use App\AppUser;

class RegistrationController extends Controller{

    /**
     * register - description
     *
     * @param  {type} Request $request description
     * @return {type}                  description
     */
    public function register(Request $request){

        $appUser = new AppUser();

        $appUser->name = $request->name;
        $appUser->email = $request->email;
        $appUser->contact = $request->contact;
        $appUser->fcmToken = $request->fcmToken;
        $appUser->rollNo = $request->rollNo;
        $appUser->year = 0;
        $appUser->branch = "";

        $appUser->save();

        $response["status"] = "OK";
        $response["data"]["id"]= $appUser->id;
        $response["data"]["name"]= $appUser->name;
        $response["data"]["email"]= $appUser->email;
        $response["data"]["contact"]= $appUser->contact;
        $response["data"]["id"]= $appUser->fcmToken;
        $response["data"]["rollNo"]= $appUser->rollNo;

        return response()->json([
            "status"=>"OK",
            "data"=>[
            'id'=> $appUser->id,
            'name' => $appUser->name,
            'email' => $appUser->email,
            'contact'=>$appUser->contact,
            'rollNo'=>$appUser->rollNo,
            'fcmToken'=>$appUser->fcmToken]]);
    }

    public function updateFcmToken(Request $request){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }
}
