<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PositionHolder;
use Carbon\Carbon;
use App\Repositories\Dropbox;
use Illuminate\Support\Facades\File;

class PositionHolderController extends Controller
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
        $position_holders = PositionHolder::orderBy('id','desc')->paginate(5);
        return view('position_holder.list',['position_holders'=>$position_holders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position_holder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position_holder = new PositionHolder;
        $position_holder->name = $request->name;
        $position_holder->position = $request->position;
        $position_holder->level = $request->level;
        $position_holder->email = $request->email;
        $position_holder->contact = $request->contact;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"position_holder".$request->email.Carbon::now()->timestamp.".jpg","/PositionHolders/");
            $position_holder->image = $url;
        }else{
            $position_holder->image = "";
        }

        $position_holder->save();

        return redirect('position_holders')->with(['status'=>'success','status_string'=>'Added '.$position_holder->name.'!']);;

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
        $position_holder = PositionHolder::find($id);
        return view('position_holder.create',['position_holder'=>$position_holder]);
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
        $position_holder = PositionHolder::find($id);
        $position_holder->name = $request->name;
        $position_holder->position = $request->position;
        $position_holder->level = $request->level;
        $position_holder->email = $request->email;
        $position_holder->contact = $request->contact;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = $this->getDropboxLink($image,"position_holder".$request->email.Carbon::now()->timestamp.".jpg","/PositionHolders/");
            $position_holder->image = $url;
        }else{
            $position_holder->image = "";
        }

        $position_holder->save();
        return redirect('position_holders')->with(['status'=>'success','status_string'=>'Updated '.$position_holder->name.' !']);
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
        $position_holder = PositionHolder::find($id);
        $streams=$position_holder->streams()->get();
        if($streams->count()>0){
            // cannot delete
            return redirect('position_holders')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$position_holder->name.' ! Has some dependecy.']);
        }else{
            $position_holder->delete();
            return redirect('position_holders')->with(['status'=>'success','status_string'=>'Deleted '.$position_holder->name.' !']);
        }
    }
}
