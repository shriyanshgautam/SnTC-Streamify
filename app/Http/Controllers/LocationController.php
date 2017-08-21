<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return view('location.list',['locations'=>$locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location;
        $location->name = $request->name;
        $location->address = $request->address;
        $location->description = $request->description;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->zoom = $request->zoom;
        $location->save();

        return redirect('locations')->with(['status'=>'success','status_string'=>'Added '.$location->name.'!']);;

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
        $location = Location::find($id);
        return view('location.create',['location'=>$location]);
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
        $location = Location::find($id);
        $location->name = $request->name;
        $location->address = $request->address;
        $location->description = $request->description;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->zoom = $request->zoom;
        $location->save();

        return redirect('locations')->with(['status'=>'success','status_string'=>'Updated '.$location->name.' !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $events=$location->events()->get();
        if($events->count()>0){
            // cannot delete
            return redirect('locations')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$location->name.' ! Has some dependecy.']);
        }else{
            $location->delete();
            return redirect('locations')->with(['status'=>'success','status_string'=>'Deleted '.$location->name.' !']);
        }
    }
}