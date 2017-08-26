<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::orderBy('id','desc')->paginate(5);
        return view('college.list',['colleges'=>$colleges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('college.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $college = new College;
        $college->name = $request->name;
        $college->code = $request->code;
        $college->save();

        return redirect('colleges')->with(['status'=>'success','status_string'=>'Added '.$college->name.'!']);;

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
        $college = College::find($id);
        return view('college.create',['college'=>$college]);
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
        $college = College::find($id);
        $college->name = $request->name;
        $college->code = $request->code;
        $college->save();

        return redirect('colleges')->with(['status'=>'success','status_string'=>'Updated '.$college->name.' !']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $college = College::find($id);
        // $events=$college->events()->get();
        //
        // if($events->count()>0 || $notifications->count()>0){
        //     // cannot delete
        //     return redirect('colleges')->with(['status'=>'danger','status_string'=>'Cannot Delete '.$college->name.' ! Has some dependecy.']);
        // }else{
            $college->delete();
            return redirect('colleges')->with(['status'=>'success','status_string'=>'Deleted '.$college->name.' !']);
        //}
    }
}
