<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Body;

class BodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodies = Body::orderBy('id','desc')->paginate(5);
        return view('body.list',['bodies'=>$bodies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('body.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = new Body;
        $body->name = $request->name;
        $body->level = $request->level;
        $body->save();

        return redirect('bodies')->with(['status'=>'success','status_string'=>'Added '.$body->name.'!']);;

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
        $body = Body::find($id);
        return view('body.create',['body'=>$body]);
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
        $body = Body::find($id);
        $body->name = $request->name;
        $body->level = $request->level;
        $body->save();

        return redirect('bodies')->with(['status'=>'success','status_string'=>'Updated '.$body->name.' !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $body = Body::find($id);
        $streams=$body->streams()->get();
        if($streams->count()>0){
            // cannot delete
            return redirect('bodies')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$body->name.' ! Has some dependecy.']);
        }else{
            $body->delete();
            return redirect('bodies')->with(['status'=>'success','status_string'=>'Deleted '.$body->name.' !']);
        }
    }
}
