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

class TestresultController extends Controller
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
        //
    }

    public function createtr($id)
    {
        $tc = Testcase::find($id);
        //dd($tc->testcaseid);

        $info = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('requirements.projectid')
                        ->where('testcases.testcaseid', '=', $tc->testcaseid)
                        ->get()->first();
                        //dd($info->projectid);

        return view('tester.testresult.createtestresult', compact('tc', 'info')); 
    }

    public function storetr(Request $request, $id)
    {
        $info = Testcase::find($id);
        //dd($info);

        $request->validate([
            'testresultreference'=>'required',
            'testresultstatus'=>'required',
            'testresultstart'=>'required',
        ]);

        $time = strtotime($request->get('testresultstart'));
        $new_time = date('Y-m-d H:i:s', $time);
        //dd($new_time);
        

        $data = DB::table ('projects')
                ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                ->select('requirements.projectid')
                ->where('testcases.testcaseid', '=', $info->testcaseid)
                ->get()->first();

        $a = ($data->projectid);
        //dd($data);

        $data = User::where('name',$request->get('testcaseassign'))->first();
        
        //dd($data->id);

        $update = Testresult::where('testcaseid',$id)->where('testresultvisible',1)->first();
        //dd($update);

        if($update)
        {
            $update->testresultvisible = 0;
            $update->save();
        }
        
        

        $testresult = new Testresult([
            'testresultid' => rand(),
            'testcaseid' => $info->testcaseid,
            'testresultreference'=> $request->get('testresultreference'),
            'testresultstatus'=> $request->get('testresultstatus'),
            'testresultcomment'=>$request->get('testresultcomment'),
            'testresultvisible' => 1,
        ]);

        if($file = $request->hasFile('testresultfile'))
        {
            $file = $request->file('testresultfile');
            $filename = $file->getClientOriginalName() ;
            $file->move('uploads/testresultfile/', $filename);
            $testresult->testresultfile = $filename;
        }

        $testresult->save();

        $b = ($testresult->testresultid);
        $tr = Testresult::find($b);
        $start_time = \Carbon\Carbon::parse($new_time);
        $finish_time = \Carbon\Carbon::parse($tr->created_at);
        $result = $start_time->diffInSeconds($finish_time, false);
        
        $tr->testresultduration =  $result;
        $tr->save();
        //dd($result);
        
        return redirect('projects/'.$a)->with('success', 'Test Result saved!');
        
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
        $tr = Testresult::find($id);
        //dd($tr->testcaseid);

        // search projectid
        $info = DB::table ('projects')
                ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                ->select('requirements.projectid')
                ->where('testcases.testcaseid', '=', $tr->testcaseid)
                ->get()->first();

        
        $tc = Testcase::find($tr->testcaseid);
        //dd($tr->testresultcomment);

                        if(auth()->user()->role == "Project Manager")
                        {
                            return view('projectmanager.testresult.viewtestresult', compact('tr', 'tc', 'info')); 
                        }
                        else if(auth()->user()->role == "Tester")
                        {
                            return view('tester.testresult.viewtestresult', compact('tr', 'tc', 'info')); 
                        }
                        else if(auth()->user()->role == "Developer")
                        {
                            return view('developer.testresult.viewtestresult', compact('tr', 'tc', 'info')); 
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
        $tr = Testresult::find($id);

        $tc = Testcase::where('testcaseid',$tr->testcaseid)->first();
        //dd($tc);

        $info = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('requirements.projectid')
                        ->where('testresults.testresultid', '=', $tr->testresultid)
                        ->get()->first();
                        //dd($info->projectid);


                        if(Auth::user()->role === "Tester")
                        {
                            return view('tester.testresult.edittestresult', compact('tr', 'info','tc')); 
                        }
                        else if(Auth::user()->role === "Developer")
                        {
                            return view('developer.testresult.edittestresult', compact('tr', 'info','tc')); 
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
            'testresultreference'=>'required',
            'testresultstatus'=>'required',
        ]);

        
        $tr = Testresult::find($id);
        //dd($tr);

        $data = DB::table ('projects')
                ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                ->select('requirements.projectid')
                ->where('testresults.testresultid', '=', $tr->testresultid)
                ->get()->first();
        
        $a = ($data->projectid);
        
        $time = strtotime($request->get('testresultstart'));
        if($time)
        {
            $new_time = date('Y-m-d H:i:s', $time);
            
            date_default_timezone_set('Singapore');
            $date = now();
            $date2 = strtotime($date);
            $finish_time = date('Y-m-d H:i:s', $date2);
            //dd($new_time);
            //dd($finish_time);


            $start_time = \Carbon\Carbon::parse($new_time);
            $finish_time = \Carbon\Carbon::parse($finish_time);
            $result = $start_time->diffInSeconds($finish_time, false);
            
            $tr->testresultfixdefect =  $result;
            $tr->save();

            $update = Testresult::where('testcaseid',$tr->testcaseid)->where('testresultvisible',1)->first();
            //dd($update);

            if($update)
            {
                $update->testresultvisible = 0;
                $update->save();
            }
            return redirect('projects/'.$a)->with('success', 'Test Case Defect fixed!');
        }

        
        

        

                //dd($data);


        $tr->testresultreference =  $request->get('testresultreference');
        $tr->testresultcomment =  $request->get('testresultcomment');
        

        if($file = $request->hasFile('testresultfile'))
        {
            $file = $request->file('testresultfile');
            $filename = $file->getClientOriginalName() ;
            $file->move('uploads/testresultfile/', $filename);
            $tr->testresultfile = $filename;
        }

        $tr->save();

        
        return redirect('projects/'.$a)->with('success', 'Test Result detail updated!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$update = Testresult::where('testresultid',$id)->where('testresultvisible',1)->first();


        $tr = Testresult::find($id);
        
        
        if($tr->testresultvisible == 0)
        {
            Testresult::where('testresultid',$tr->testresultid)->delete();
            $tr -> delete();
            return redirect()->back()->with('success', 'Test Result deleted!');
        }
        elseif ($tr->testresultvisible == 1)
        {
            $tr -> delete();
            return redirect()->back()->with('success', 'Test Result deleted!');
        }
        
    }
}
