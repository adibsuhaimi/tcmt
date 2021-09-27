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
use Illuminate\Support\Facades\Response;
use Image;
use Session;


class TestcaseController extends Controller
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

    public function createtc($id)
    {
        $info = Requirement::find($id);
        //dd($info);
        
        // to search tester in a project
        $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('users.name')
                        ->where('projects.projectid', '=', $info->projectid)
                        ->where('users.role', '=', 'Tester')
                        ->get();
        //dd($data);
        if(auth()->user()->role == "Project Manager")
        {
            if($data->isEmpty())
            {
                Session::flash('error', 'Please add tester before creating the test case!');  
            }
            return view('projectmanager.testcase.createtestcase', compact('info', 'data')); 
        }
        else if(auth()->user()->role == "Tester")
        {
            return view('tester.testcase.createtestcase', compact('info', 'data')); 
        }

        
    }

    public function storetc(Request $request, $id)
    {
        $info = Requirement::find($id);
        //dd($info->reqid);

        $request->validate([
            'testcasereference'=>'required',
            'testcasetitle'=>'required',
            'testcaseprecondition'=>'required',
            'testcasestep'=>'required',
            'testcaseexpresult'=>'required',
            'testcasepriority'=>'required',
            'testcaseassign'=>'required',
            'testcaseexptime'=>'numeric|required',
        ]);

        $a = ($info->projectid);

        $data = User::where('name',$request->get('testcaseassign'))->first();
        
        //dd($data->id);

        $testcase = new Testcase([
            'testcaseid' => rand(),
            'reqid' => $info->reqid,
            'id' => $data->id,
            'testcasereference'=> $request->get('testcasereference'),
            'testcasetitle'=> $request->get('testcasetitle'),
            'testcaseprecondition'=>$request->get('testcaseprecondition'),
            'testcasestep'=>$request->get('testcasestep'),
            'testcaseexpresult'=>$request->get('testcaseexpresult'),
            'testcasepriority'=>$request->get('testcasepriority'),
            'testcaseassign'=>$request->get('testcaseassign'),
            'testcaseexptime'=>$request->get('testcaseexptime') * 60,
        ]);

        if($file = $request->hasFile('testcasefile'))
        {
            $file = $request->file('testcasefile');
            $filename = $file->getClientOriginalName() ;
            $file->move('uploads/testcasefile/', $filename);
            $testcase->testcasefile = $filename;
        }
        
        
        
        $testcase->save();

        //dd($testcase);
        
        return redirect('projects/'.$a)->with('success', 'Test Case saved!');
        
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
        $tc = Testcase::find($id);
        //dd($tc->testcaseid);

        $info = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid')
                        ->where('testcases.testcaseid', '=', $tc->testcaseid)
                        ->where('users.role', '=', 'Tester')
                        ->get()->first();
                        //dd($info->projectid);
        
        $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('users.name')
                        ->where('projects.projectid', '=', $info->projectid)
                        ->where('users.role', '=', 'Tester')
                        ->get();
                        //dd($data);

                        if(auth()->user()->role == "Project Manager")
                        {
                            return view('projectmanager.testcase.viewtestcase', compact('tc', 'info', 'data')); 
                        }
                        else if(auth()->user()->role == "Tester")
                        {
                            return view('tester.testcase.viewtestcase', compact('tc', 'info', 'data')); 
                        }
                        else if(auth()->user()->role == "Developer")
                        {
                            return view('developer.testcase.viewtestcase', compact('tc', 'info', 'data')); 
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
        $tc = Testcase::find($id);
        //dd($tc);

        $info = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid')
                        ->where('testcases.testcaseid', '=', $tc->testcaseid)
                        ->where('users.role', '=', 'Tester')
                        ->get()->first();
                        //dd($info->projectid);
        
        $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('users.name')
                        ->where('projects.projectid', '=', $info->projectid)
                        ->where('users.role', '=', 'Tester')
                        ->get();
                        //dd($data);

        if(auth()->user()->role == "Project Manager")
        {
            return view('projectmanager.testcase.edittestcase', compact('tc', 'info', 'data')); 
        }
        else if(auth()->user()->role == "Tester")
        {
            return view('tester.testcase.edittestcase', compact('tc', 'info', 'data')); 
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
            'testcasereference'=>'required',
            'testcasetitle'=>'required',
            'testcaseprecondition'=>'required',
            'testcasestep'=>'required',
            'testcaseexpresult'=>'required',
            'testcasepriority'=>'required',
            'testcaseassign'=>'required',
            'testcaseexptime'=>'integer|required',
        ]);

        $tc = Testcase::find($id);

        $info = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid')
                        ->where('testcases.testcaseid', '=', $tc->testcaseid)
                        ->get()->first();

        
        $data = User::where('name',$request->get('testcaseassign'))->first();
        //dd($info->projectid);

  
        $tc->testcasereference =  $request->get('testcasereference');
        $tc->testcasetitle =  $request->get('testcasetitle');
        $tc->testcaseprecondition =  $request->get('testcaseprecondition');
        $tc->testcasestep =  $request->get('testcasestep');
        $tc->testcaseexpresult =  $request->get('testcaseexpresult');
        $tc->testcasepriority =  $request->get('testcasepriority');
        $tc->testcaseassign =  $request->get('testcaseassign');
        $tc->testcaseexptime = $request->get('testcaseexptime') * 60;
        $tc->id = $data->id;

        if($file = $request->hasFile('testcasefile'))
        {
            $file = $request->file('testcasefile');
            $filename = $file->getClientOriginalName() ;
            $file->move('uploads/testcasefile/', $filename);
            $tc->testcasefile = $filename;
        }

        $tc->save();

        return redirect('projects/'.$info->projectid)->with('success', 'Test Case detail updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tc = Testcase::find($id);
        Testresult::where('testcaseid',$tc->testcaseid)->delete();
        $tc -> delete();
        return redirect()->back()->with('success', 'Test Case deleted!');
    }



    public function listtestrun($id)
    {
        $info = Project::find($id);

       // to search tester in a project
        $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('users.id','users.name')
                        ->where('projects.projectid', '=', $info->projectid)
                        ->where('users.role', '=', 'Tester')
                        ->get();
        
        $count = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('testcases.id', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $info->projectid)
                        ->groupBy('testcases.id')
                        ->get();
                        //dd($count);
                        //->pluck('total','testcases.id')->all();


        if($count->isEmpty())
        {
            if(auth()->user()->role == "Project Manager")
            {
                Session::flash('error', 'There is no data! Please add test case in Project Page');  
            }
            else if(auth()->user()->role == "Tester")
            {
                Session::flash('error', 'There is no data! Please add test case in Project Page'); 
            }
            else if(auth()->user()->role == "Developer")
            {
                Session::flash('error', 'There is no data! Please inform project manager/tester to add test case'); 
            }
        }
                        

        $alltc = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('testcases.id', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $info->projectid)
                        ->groupBy('testcases.id')
                        ->get();

                        //dd($alltc);
                        
        $aa = array();

                        foreach($alltc as $alltcs)
                        {
                            $yesexecute = DB::table ('projects')
                                    ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                                    ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                                    ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                                    ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                                    ->where('projects.projectid', '=', $info->projectid)
                                    ->where('testcases.id', '=', $alltcs->id)
                                    ->where('testresults.testresultvisible', '=', 1)
                                    ->groupBy('projects.projectid')
                                    ->get()->first();
    
                            $totalexecute = DB::table ('projects')
                                    ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                                    ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                                    ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                                    ->where('projects.projectid', '=', $info->projectid)
                                    ->where('testcases.id', '=', $alltcs->id)
                                    ->groupBy('projects.projectid')
                                    ->get()->first();
                                    //dd($totalexecute->total);

                                    if(is_null($yesexecute) && is_null($totalexecute))
                                    {
                                        $exe = 0;
                                    }
                                    else if(is_null($yesexecute))
                                    {
                                        $exe = 0;
                                    }
                                    else 
                                    {
                                        $exe = round((($yesexecute->total / $totalexecute->total)*100), -0.1);
                                    }

                                    $aa[] = array("id" => $alltcs->id, "total" => $exe);
                        }

                        //dd($aa);

                        
                        



                        if(auth()->user()->role == "Project Manager")
                        {
                            return view('projectmanager.testrun.listtestrun', compact('info', 'data', 'count', 'aa')); 
                        }
                        else if(auth()->user()->role == "Tester")
                        {
                            return view('tester.testrun.listtestrun', compact('info', 'data', 'count', 'aa')); 
                        }
                        else if(auth()->user()->role == "Developer")
                        {
                            return view('developer.testrun.listtestrun', compact('info', 'data', 'count', 'aa')); 
                        }

        //return view('projectmanager.testrun.listtestrun', compact('info', 'data', 'count', 'aa')); 


        
    }


    public function testrun($project, $id)
    {
        $info = Project::find($project);

        $tc = DB::table ('projects')
            ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
            ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
            ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
            ->select('*')
            ->where('projects.projectid', '=', $info->projectid)
            ->where('testcases.id', '=', $id)
            ->where('testresults.testresultvisible', '=', 1)
            //->groupBy('testcases.id')
            ->get();
            //dd($tc);

        $noresult = DB::table('projects')
            ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
            ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
            ->whereNotIn('testcaseid', function($q)
                {$q->select('testcaseid')->from('testresults')->where('testresultvisible', '=', 1); })
            ->where('projects.projectid', '=', $info->projectid)
            ->where('testcases.id', '=', $id)
            ->get();
            //dd($noresult);

        $count = DB::table ('projects')
            ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
            ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
            ->select('testcases.id', DB::raw('count(testcases.testcaseid) as total'))
            ->where('projects.projectid', '=', $info->projectid)
            ->where('testcases.id', '=', $id)
            //->where('users.role', '=', 'Tester')
            ->groupBy('testcases.id')
            ->get()->first();
            //dd($count);
            
        $pass = DB::table ('projects')
            ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
            ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
            ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
            ->select('testcases.id', DB::raw('count(testcases.testcaseid) as total'))
            ->where('projects.projectid', '=', $info->projectid)
            ->where('testresults.testresultstatus', '=', 'Pass')
            ->where('testresults.testresultvisible', '=', 1)
            ->where('testcases.id', '=', $id)
            ->groupBy('testcases.id')
            ->get()->first();
            //dd($pass);

        $fail = DB::table ('projects')
            ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
            ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
            ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
            ->select('testcases.id', DB::raw('count(testcases.testcaseid) as total'))
            ->where('projects.projectid', '=', $info->projectid)
            ->where('testresults.testresultstatus', '=', 'Fail')
            ->where('testresults.testresultvisible', '=', 1)
            ->where('testcases.id', '=', $id)
            ->groupBy('testcases.id')
            ->get()->first();

            if (is_null($pass) && is_null($fail))
            {
                $totalcount = $count->total;
                $totalfail = 0;
                $totalpass = 0;
                $totalpending = 100;

                if(auth()->user()->role == "Project Manager")
                {
                    return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Tester")
                {
                    return view('tester.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Developer")
                {
                    return view('developer.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                //return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
            }
            else if (is_null($pass))
            {
                $totalcount = $count->total;
                $fail1 = $fail->total;
                $totalfail = round((($fail1 / $count->total)*100), -0.1);
                $totalpass = 0;
                $pending = $totalcount - $totalpass - $fail1;
                $totalpending = round((($pending / $count->total)*100), -0.1);

                if(auth()->user()->role == "Project Manager")
                {
                    return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Tester")
                {
                    return view('tester.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Developer")
                {
                    return view('developer.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                //return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
            }
            else if (is_null($fail)) 
            {
                $totalcount = $count->total;
                $totalfail = 0;
                $pass1 = $pass->total;
                $totalpass = round((($pass1 / $count->total)*100), -0.1);
                //dd($totalpass);
                $pending = $totalcount - $pass1 - $totalfail;
                $totalpending = round((($pending / $count->total)*100), -0.1);
                //dd($totalpending);

                if(auth()->user()->role == "Project Manager")
                {
                    return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Tester")
                {
                    return view('tester.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Developer")
                {
                    return view('developer.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                //return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
            }
            else
            {
                $totalcount = $count->total;
                $fail1 = $fail->total;
                $totalfail = round((($fail1 / $count->total)*100), -0.1);
                $pass1 = $pass->total;
                $totalpass = round((($pass1 / $count->total)*100), -0.1);
                $pending = $totalcount - $pass1 - $fail1;
                $totalpending = round((($pending / $count->total)*100), -0.1);

                if(auth()->user()->role == "Project Manager")
                {
                    return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Tester")
                {
                    return view('tester.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                else if(auth()->user()->role == "Developer")
                {
                    return view('developer.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
                }
                //return view('projectmanager.testrun.testrun', compact('info', 'noresult', 'tc', 'totalpass', 'totalfail', 'totalpending'));
            }

    }
}
