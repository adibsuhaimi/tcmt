@extends('layouts.app')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap2.min.css') }}">
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'>
<link rel="stylesheet" href="{{ asset('assets/css/tree.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    
</head>

<header class="header-2 skew-separator">
  <nav class="navbar navbar-expand-lg bg-white navbar-absolute">
    <div class="container">
      <div class="collapse navbar-collapse" id="example-header-2">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-close text-right">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-header-2" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span></button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><b><a class="nav-link" href="/projects/{{$info->projectid}}" >Project</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/testruns/{{$info->projectid}}">Test Run</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/projects/team/{{$info->projectid}}">Team Member</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/summary/{{$info->projectid}}">Summary</a></b></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<br>
<div id="wrapper">

<input name="invisible" type="hidden" value="{{$info->projectid}}">

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid" style="width: 1000px;">
                    <h3 class="text-dark mb-4">Project</h3>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">List of requirements</p>
                        </div>
                        <div class="card-body">

                        @if(session('success'))
                          <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{session('success')}}
                          </div>
                        @endif
                        @if (Session::has('success'))
                          {{ Session::forget('success') }}
                          {{ Session::save() }}
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert">×</button>	
                              {{session('error')}}
                            </div>
                        @endif
                        @if (Session::has('error'))
                          {{ Session::forget('error') }}
                          {{ Session::save() }}
                        @endif

                        <div id="collapseDVR3" class="panel-collapse collapse in">
                          <div class="tree ">
                            
                            <ul>
                              <li><span><b> PROJECT REQUIREMENTS</b></span>&nbsp;
                                  <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown">+</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="{{route('requirements.createreq', $info->projectid)}}">Add Requirement</a>
                                  </div>
                                  <ul>
                                  @foreach($req as $req)
                                  
                                    <li><span>{{$req->reqreference}} &nbsp; {{\Illuminate\Support\Str::limit($req->reqtitle, 80, '...')}}</span>&nbsp;
                                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown">+</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="/requirements/{{$req->reqid}}">View Requirement</a>
                                          <a class="dropdown-item" href="/requirements/{{$req->reqid}}/edit">Update Requirement</a>
                                          <a class="dropdown-item" href="/requirements/destroy/{{$req->reqid}}" onclick="return confirm('Are you sure to delete {{$req->reqreference}} ?')">Delete Requirement</a>
                                          <a class="dropdown-item" href="{{route('testcases.createtc', $req->reqid)}}">Add Test Case</a>
                                        </div>

                                        <ul>

                                        @foreach($testcase as $tc)
                                          @if($tc->reqid == $req->reqid)

                                          <li><span>{{$tc->testcasereference}} &nbsp; {{\Illuminate\Support\Str::limit($tc->testcasetitle, 80, '...')}}</span>&nbsp;
                                            <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown">+</button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/testcases/{{$tc->testcaseid}}">View Test Case</a>
                                                <a class="dropdown-item" href="/testcases/{{$tc->testcaseid}}/edit">Update Test Case</a>
                                                <a class="dropdown-item" href="/testcases/destroy/{{$tc->testcaseid}}" onclick="return confirm('Are you sure to delete {{$tc->testcasereference}} ?')">Delete Test Case</a>
                                              </div>

                                              <ul>
                                              @foreach($testresult as $tr)
                                                @if($tr->testcaseid == $tc->testcaseid)

                                                <li><span>{{$tr->testresultreference}} &nbsp; {{$tr->testresultstatus}}</span>&nbsp;
                                                  <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown">+</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="/testresults/{{$tr->testresultid}}">View Test Result</a>
                                                    </div>

                                                @endif
                                              @endforeach

                                              </ul>

                                          @endif
                                        @endforeach

                                        </ul>

                                  @endforeach
                                  </ul>

                              </li>
                            </ul>
            
                          </div>
                        </div>

                        </div>
                        
                </div>
            </div>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js'></script><script  src="{{ asset('assets/js/tree.js') }}"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
@endsection

