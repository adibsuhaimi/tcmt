<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\UserProject;
use App\Requirement;
use App\Testcase;
use App\User;
use DB;
use Illuminate\Support\facades\Auth;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                                Session::flash('error', 'There is no data! Please inform project manager to add you in project'); 
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
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projectmanager.project.createproject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'projectname'=>'required'
        ]);

        $project = new Project([
            'projectid' => rand(),
            'projectname' => $request->get('projectname'),
        ]);
        $project->save();

        $a = ($project->projectid);
        
        $userprojects = new UserProject([
            'id' => Auth::user()->id,
            'projectid' => $a,
        ]);
        $userprojects->save();


        return redirect('/projects')->with('success', 'Project saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $project = Project::find($id);

        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            
            if($user)
            {
                $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('*')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get()->first();

                $req = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->select('requirements.reqid', 'requirements.projectid', 'requirements.reqtitle', 'requirements.reqreference')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();
                
                        if($req->isEmpty())
                        {
                            if(auth()->user()->role == "Project Manager")
                            {
                                Session::flash('error', 'There is no data! Please add project requirement');  
                            }
                            else if(auth()->user()->role == "Tester")
                            {
                                Session::flash('error', 'There is no data! Please add project requirement'); 
                            }
                            else if(auth()->user()->role == "Developer")
                            {
                                Session::flash('error', 'There is no data! Please inform project manager/tester to add project requirement'); 
                            }
                        }

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
                        ->select('testresults.testresultreference', 'testresults.testresultid', 'testresults.testcaseid','testresults.testresultstatus', 'testresults.testresultcomment', 'testresults.testresultfile', 'testresults.testresultvisible')
                        ->where('users.id', '=', Auth::user()->id)
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();

                $noresult = DB::table('projects')
                        ->join('requirements', 'projects.projectid', '=', 'requirements.projectid')
                        ->join('testcases', 'testcases.reqid', '=', 'requirements.reqid')
                        ->whereNotIn('testcaseid', function($q)
                            {$q->select('testcaseid')->from('testresults')->where('testresultvisible', '=', 1); })
                        ->where('projects.projectid', '=', $project->projectid)
                        ->get();
                        //dd($noresult);
                        
                        //dd($testcase);
                        $request->session()->put('id', $project);
                        $info = $request->session()->get('id');
                        
                        

                        if(auth()->user()->role == "Project Manager")
                        {
                            return view('projectmanager.project.project', compact('data', 'req', 'testcase', 'testresult', 'info'));
                        }
                        else if(auth()->user()->role == "Tester")
                        {
                            return view('tester.project.project', compact('data', 'req', 'testcase', 'testresult', 'info', 'noresult'));
                        }
                        else if(auth()->user()->role == "Developer")
                        {
                            return view('developer.project.project', compact('data', 'req', 'testcase', 'testresult', 'info'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projectmanager.project.editproject', compact('project')); 
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
            'projectname'=>'required',
        ]);

        $project = Project::find($id);
        $project->projectname =  $request->get('projectname');

        $project->save();

        return redirect('/projects')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listteamproject(Request $request, $id)
    {
        $project = Project::find($id);

        $data = DB::table ('users')
                        ->join('userprojects', 'users.id', '=', 'userprojects.id')
                        ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                        ->select('users.id', 'users.name', 'users.email', 'users.role')
                        ->where('projects.projectid', '=', $project->projectid)
                        ->orderBy('users.role')
                        ->get();

                        $request->session()->put('id', $project);
                        $info = $request->session()->get('id');

        return view('projectmanager.project.listteamproject', compact('data', 'info')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editteamproject(Request $request, $id)
    {
        $project = Project::find($id);

        $request->session()->put('id', $project);
        $info = $request->session()->get('id');

        return view('projectmanager.project.editteamproject', compact('info')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateteamproject(Request $request, $id)
    {
        // session project
        $project = Project::find($id);
        $request->session()->put('id', $project);
        $info = $request->session()->get('id');

        $request->validate([
            'email'=>'required', 'email',
        ]);

        $email =$request->input('email');
        $data = User::where('email',$email)->first();

        
        //('id', $data->id)('projectid', $info->projectid);
        
        if($data)
        {
           
            $d = UserProject::where('id', $data->id)
                ->where('projectid', $info->projectid)
                ->first();

            if($d)
            {
                $request->session()->flash('error', 'Email address is already in  team member');
                return redirect()->back();
            }
            else
            {
                $userprojects = new UserProject([
                    'id' => $data->id,
                    'projectid' => $info->projectid,
                ]);

                $userprojects->save();

                $data = DB::table ('users')
                    ->join('userprojects', 'users.id', '=', 'userprojects.id')
                    ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                    ->select('users.id','users.name', 'users.email', 'users.role')
                    ->where('projects.projectid', '=', $project->projectid)
                    ->orderBy('users.role')
                    ->get();

                $request->session()->flash('success', 'Team Member have now been updated');
                //return $this->sendRequest($listteamproject(compact('info')));
                return view('projectmanager.project.listteamproject', compact('info', 'data')); 
            }
            
        }
        else
        {
            $request->session()->flash('error', 'Email address is not found');
            return redirect()->back();

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project -> delete();
        return redirect()->back()->with('success', 'Project deleted!');
    }

    public function destroymember($project,$id)
    {
        $info = Project::find($project);
        //dd($userproject);

        $up = DB::table ('users')
                    ->join('userprojects', 'users.id', '=', 'userprojects.id')
                    ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                    ->select('users.id', 'projects.projectid')
                    ->where('projects.projectid', '=', $info->projectid)
                    ->where('users.id', '=', $id)
                    ->get()->first();
                    //dd($data);

        UserProject::where('id',$up->id)->where('projectid', $up->projectid)->delete();

        $data = DB::table ('users')
                    ->join('userprojects', 'users.id', '=', 'userprojects.id')
                    ->join('projects', 'projects.projectid', '=', 'userprojects.projectid')
                    ->select('users.id','users.name', 'users.email', 'users.role')
                    ->where('projects.projectid', '=', $info->projectid)
                    ->orderBy('users.role')
                    ->get();

                //$request->session()->flash('success', 'Team Member have now been updated');
                //return $this->sendRequest($listteamproject(compact('info')));
                return view('projectmanager.project.listteamproject', compact('info', 'data'))->with('success', 'Member removed!');
        //return redirect()->back()->with('success', 'Member removed!');
    }

       
}
