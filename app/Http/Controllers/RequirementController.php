<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\UserProject;
use App\Requirement;
use App\Testcase;
use App\Testresult;
use App\User;
use DB;
use Illuminate\Support\facades\Auth;

class RequirementController extends Controller
{
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
        
    }

    public function createreq($id)
    {
        $info = Project::find($id);
        //dd($project);

        if(auth()->user()->role == "Project Manager")
        {
            return view('projectmanager.requirement.createrequirement', compact('info')); 
        }
        else if(auth()->user()->role == "Tester")
        {
            return view('tester.requirement.createrequirement', compact('info')); 
        }
        
    }

    public function storereq(Request $request, $id)
    {
        $info = Project::find($id);

        $request->validate([
            'reqreference'=>'required',
            'reqtitle'=>'required'
        ]);


        $a = ($info->projectid);
        $requirement = new Requirement([
            'reqid' => rand(),
            'projectid' => $a,
            'reqreference' => $request->get('reqreference'),
            'reqtitle' => $request->get('reqtitle'),
        ]);
        $requirement->save();
        
        return redirect('projects/'.$a)->with('success', 'Requirement saved!');
        
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
        $req = Requirement::find($id);
        //dd($req);

        if(auth()->user()->role == "Project Manager")
        {
            return view('projectmanager.requirement.viewrequirement', compact('req')); 
        }
        else if(auth()->user()->role == "Tester")
        {
            return view('tester.requirement.viewrequirement', compact('req'));
        }
        else if(auth()->user()->role == "Developer")
        {
            return view('developer.requirement.viewrequirement', compact('req'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $req = Requirement::find($id);
        //dd($req);
        if(auth()->user()->role == "Project Manager")
        {
            return view('projectmanager.requirement.editrequirement', compact('req')); 
        }
        else if(auth()->user()->role == "Tester")
        {
            return view('tester.requirement.editrequirement', compact('req')); 
        }
        
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
        $request->validate([
            'reqreference'=>'required',
            'reqtitle'=>'required',
        ]);

        $req = Requirement::find($id);
        
        $req->reqreference =  $request->get('reqreference');
        $req->reqtitle =  $request->get('reqtitle');
        
        $req->save();

        return redirect('projects/'.$req->projectid)->with('success', 'Requirement detail updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = Requirement::find($id);
        //$tc = Testcase::find($req->reqid);

        $tc = DB::table ('testcases')
                ->select('*')
                ->where('reqid', '=', $req->reqid)
                ->get();

        foreach ($tc as $tc)
        {
            Testresult::where('testcaseid',$tc->testcaseid)->delete();
        }
        
        
        Testcase::where('reqid',$req->reqid)->delete();

        $req -> delete();

        return redirect()->back()->with('success', 'Requirement deleted!');
    }
}
