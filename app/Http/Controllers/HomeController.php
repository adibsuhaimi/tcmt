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
use PDF;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Arr;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userhome()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);

            $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('projects.projectname', 'users.role', 'projects.projectid')
                        ->where('users.id', '=', Auth::user()->id)
                        ->get();

                        if($data->isEmpty())
                        {
                            if(auth()->user()->role == "Project Manager")
                            {
                                Session::flash('error', 'There is no data! Please add project');  
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                Session::flash('error', 'There is no data! Please inform project manager to add you in project'); 
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                Session::flash('error', 'There is no data! Please inform project manager to add you as in project'); 
                            }
                        }
            
                    // list of project
                    if($user && Auth::user()->role === "Project Manager")
                    {      
                        return view('projectmanager.project.listproject', compact('data'));
                    }
                    else if($user && Auth::user()->role === "Tester")
                    {
                        return view('tester.project.listproject', compact('data'));
                    }
                    else if($user && Auth::user()->role === "Developer")
                    {
                        return view('developer.project.listproject', compact('data'));
                    } 
        }
    }

    public function summary($id)
    {
        $project = Project::find($id);
        //dd($project->projectid);

        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            
            if($user)
            {
                $graph1 = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select(DB::raw('count(testresults.testresultid) as `data`'), DB::raw('YEAR(testresults.created_at) year, MONTH(testresults.created_at) month'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->groupBy('year','month')
                        ->get();

                $last = last(reset($graph1));
                        //dd($last);
                        
                $graph2 = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select(DB::raw('count(testresults.testresultid) as `data`'), DB::raw('YEAR(testresults.created_at) year, MONTH(testresults.created_at) month'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->groupBy('year','month')
                        ->get();
                        //dd($graph2);


                $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('*')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get()->first();

                $countreq = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->select('projects.projectid', DB::raw('count(requirements.reqid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($countreq);
                        if(is_null($countreq))
                        {
                            $countreq = 0;
                        }
                        else
                        {
                            $countreq = $countreq->total;
                        }
                

                $counttc = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($counttc);

                        if(is_null($counttc))
                        {
                            $counttc = 0;
                        }
                        else
                        {
                            $counttc = $counttc->total;
                        }
                
                $counttr = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('projects.projectid', DB::raw('count(testresults.testresultid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->where('testresults.testresultvisible', '=', 1)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($counttr);

                        if(is_null($counttr))
                        {
                            $counttr = 0;
                        }
                        else
                        {
                            $counttr = $counttr->total;
                        }
                
                $countmember = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('projects.projectid', DB::raw('count(users.id) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($countmember);

                        if(is_null($countmember))
                        {
                            $countmember = 0;
                        }
                        else
                        {
                            $countmember = $countmember->total;
                        }









                $count = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        //->where('users.role', '=', 'Tester')
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($count);

                $pass = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->where('testresults.testresultstatus', '=', 'Pass')
                        ->where('testresults.testresultvisible', '=', 1)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($pass);
            
                $fail = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->where('testresults.testresultstatus', '=', 'Fail')
                        ->where('testresults.testresultvisible', '=', 1)
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($fail);



                // project requirements
                $req = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->select('requirements.reqid', 'requirements.projectid', 'requirements.reqtitle', 'requirements.reqreference')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();

                $testcase = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('testcases.testcasereference','testcases.id','testcases.reqid','testcases.testcaseid', 'testcases.testcasetitle', 'testcases.testcaseprecondition', 'testcases.testcasestep', 'testcases.testcaseexpresult', 'testcases.testcasepriority', 'testcases.testcaseassign', 'testcases.testcasefile')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();
                
                $testresult = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('testresults.testresultreference', 'testresults.testresultid', 'testresults.testcaseid','testresults.testresultstatus', 'testresults.testresultcomment', 'testresults.testresultfile')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();


                // count total execution
                $yesexecute = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->where('testresults.testresultvisible', '=', 1)
                        ->groupBy('projects.projectid')
                        ->get()->first();

                $totalexecute = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->select('projects.projectid', DB::raw('count(testcases.testcaseid) as total'))
                        ->where('projects.projectid', '=', $project->projectid)
                        //->where('users.role', '=', 'Tester')
                        ->groupBy('projects.projectid')
                        ->get()->first();
                        //dd($totalexecute->total);

                // average test effort
                $sum = DB::table ('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->join('testresults', 'testcases.testcaseid', '=', 'testresults.testcaseid')
                        ->select('testcases.id', DB::raw('sum(testresults.testresultduration) as total'), DB::raw('count(testcases.testcaseid) as count'))
                        ->where('projects.projectid', '=', $project->projectid)
                        ->where('testresults.testresultvisible', '=', 1)
                        ->groupBy('testcases.id')
                        ->get();

                        //dd($tester);
                        //dd($sum);

                $aa = array();
                $aa2 = array();

                if($sum)
                {
                    foreach($sum as $s)
                    {
                        $avg = $s->total/$s->count;
                        $av = round($avg, -0.1);
                        $da = User::where('id',$s->id)->first();

                        $aa[] = array("id" => $s->id, "name" => $da->name, "total" => $av);
                        $aa2[] = array("id" => $s->id, "name" => $da->name, "total" => $av);
                    }

                    $last2 = last($aa);
  
                }

                //dd($aa2);

                        

                        if (is_null($pass) && is_null($fail) && is_null($count))
                        {
                            $countpass = 0;
                            $countfail = 0;
                            $countpending = 0;
                            $totalcount = 0;
                            $totalfail = 0;
                            $totalpass = 0;
                            $totalpending = 0;

                            $yexe = 0;
                            $nexe = 0;
                            

                            if(auth()->user()->role == "Project Manager")
                            {
                                return view('projectmanager.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                return view('tester.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                return view('developer.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                        }
                        else if (is_null($pass) && is_null($fail))
                        {
                            $countpass = 0;
                            $countfail = 0;
                            $countpending = $count->total;
                            $totalcount = $count->total;
                            $totalfail = 0;
                            $totalpass = 0;
                            $totalpending = 100;

                            $yexe = 0;
                            $nexe = 100;
                            

                            if(auth()->user()->role == "Project Manager")
                            {
                                return view('projectmanager.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                return view('tester.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                return view('developer.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                        }
                        else if (is_null($pass))
                        {
                            $countpass = 0;
                            $countfail = $fail->total;
                            $countpending = $count->total - $countfail;

                            $totalcount = $count->total;
                            $fail1 = $fail->total;
                            $totalfail = round((($fail1 / $count->total)*100), -0.1);
                            $totalpass = 0;
                            $pending = $totalcount - $totalpass - $fail1;
                            $totalpending = round((($pending / $count->total)*100), -0.1);

                            $yexe = round((($yesexecute->total / $totalexecute->total)*100), -0.1);
                            $not = $totalexecute->total - $yesexecute->total;
                            $nexe = round((($not / $totalexecute->total)*100), -0.1);
                            

                            if(auth()->user()->role == "Project Manager")
                            {
                                return view('projectmanager.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                return view('tester.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                return view('developer.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                        }
                        else if (is_null($fail)) 
                        {
                            $countpass = $pass->total;
                            $countfail = 0;
                            $countpending = $count->total - $countpass;

                            $totalcount = $count->total;
                            $totalfail = 0;
                            $pass1 = $pass->total;
                            $totalpass = round((($pass1 / $count->total)*100), -0.1);
                            //dd($totalpass);
                            $pending = $totalcount - $pass1 - $totalfail;
                            $totalpending = round((($pending / $count->total)*100), -0.1);

                            $yexe = round((($yesexecute->total / $totalexecute->total)*100), -0.1);
                            $not = $totalexecute->total - $yesexecute->total;
                            $nexe = round((($not / $totalexecute->total)*100), -0.1);
                            

                            if(auth()->user()->role == "Project Manager")
                            {
                                return view('projectmanager.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                return view('tester.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                return view('developer.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                        }
                        else
                        {
                            $countpass = $pass->total;
                            $countfail = $fail->total;
                            $countpending = $count->total - $countpass - $countfail;

                            $totalcount = $count->total;
                            $fail1 = $fail->total;
                            $totalfail = round((($fail1 / $count->total)*100), -0.1);
                            $pass1 = $pass->total;
                            $totalpass = round((($pass1 / $count->total)*100), -0.1);
                            $pending = $totalcount - $pass1 - $fail1;
                            $totalpending = round((($pending / $count->total)*100), -0.1);

                            $yexe = round((($yesexecute->total / $totalexecute->total)*100), -0.1);
                            $not = $totalexecute->total - $yesexecute->total;
                            $nexe = round((($not / $totalexecute->total)*100), -0.1);

                            if(auth()->user()->role == "Project Manager")
                            {
                                return view('projectmanager.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                return view('tester.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                return view('developer.summary.summary', compact('data', 'last', 'graph1', 'graph2', 'countreq', 'counttc', 'counttr', 'countmember', 'countpass', 'countfail', 'countpending', 'totalpass', 'totalfail', 'totalpending', 'req', 'testcase', 'testresult', 'yexe', 'nexe', 'last2', 'aa', 'aa2'));
                            }
                        }

            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
      

    

    
}
