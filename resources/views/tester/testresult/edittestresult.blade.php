@extends('layouts.app')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'>
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
          <li class="nav-item"><b><a class="nav-link" href="/projects/{{$info->projectid}}">Project</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/testruns/{{$info->projectid}}">Test Run</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/summary/{{$info->projectid}}">Summary</a></b></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<br>
<div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid" style="width: 1000px;">
                    <h3 class="text-dark mb-4">Update Test Result</h3>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Test Case Details</p>
                        </div>
                        <div class="card-body">
                        <div class="form-row">
                                <div class="col">
                                        <div class="form-group"><label for="testcasereference"><strong>ID</strong></label>
                                        <input id="testcasereference" type="text" class="form-control @error('testcasereference') is-invalid @enderror" name="testcasereference" value="{{ $tc->testcasereference}}" autofocus readonly>
                                    
                                    @error('testcasetreference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>
                                    
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="testcaseexptime"><strong>Expected Time Execuation (in minutes)</strong></label>
                                        <input id="testcaseexptime" type="text" class="form-control @error('testcaseexptime') is-invalid @enderror" name="testcaseexptime" value="{{ $tc->testcaseexptime/60}}" autofocus readonly>
                                        
                                        @error('testcasetreference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcasetitle"><strong>Title</strong></label>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input id="testcasetitle" type="text" class="form-control @error('testcasetitle') is-invalid @enderror" name="testcasetitle" value="{{ $tc->testcasetitle}}" autofocus readonly>
                                    </div>
                                </div>
                                @error('testcasetitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcaseprecondition"><strong>Precondition</strong></label>
                                        <textarea readonly class="form-control" rows="6" name="testcaseprecondition">{{ $tc->testcaseprecondition}}</textarea>
                                    </div>
                                </div>
                                @error('testcaseprecondition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>

                                    <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcasestep"><strong>Steps</strong></label>
                                        <textarea readonly class="form-control" rows="6" name="testcasestep">{{ $tc->testcasestep}}</textarea>
                                    </div>
                                </div>
                                @error('testcasestep')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>

                                    <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcaseexpresult"><strong>Expected Result</strong></label>
                                        <textarea readonly class="form-control" rows="4" name="testcaseexpresult">{{ $tc->testcaseexpresult}}</textarea>
                                    </div>
                                </div>
                                @error('testcaseexpresult')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>

                                    <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcasetitle"><strong>Priority</strong></label>
                                        <input id="testcasepriority" type="text" class="form-control @error('testcasetitle') is-invalid @enderror" name="testcasepriority" value="{{ $tc->testcasepriority}}" autofocus readonly>
                                    </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="testcasetitle"><strong>Assign To</strong></label>
                                        <input id="testcaseassign" type="text" class="form-control @error('testcasetitle') is-invalid @enderror" name="testcaseassign" value="Tester {{ $tc->testcaseassign}}" autofocus readonly>
                                    </div>
                                    </div>
                                </div>

                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testcasefile"><strong>File Attachment</strong></label><br>
                                        <a href="{{ asset('uploads/testcasefile/'. $tc->testcasefile) }}">{{ $tc->testcasefile }}</a>
                                        </div>
                                    </div>
                                </div>


                                    
                                        
                        
                        </div>
                        
                        
                    </div>
                </div>
            </div>

            <div id="content">
                <div class="container-fluid" style="width: 1000px;">
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Test Result Details</p>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="/testresults/{{$tr->testresultid}}" enctype="multipart/form-data">
                        @csrf
                                <div class="form-row">
                                    <div class="col">
                                    <div class="form-group"><label for="testresultstatus"><strong>Status</strong></label>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input id="testresultstatus" type="text" class="form-control @error('testresultstatus') is-invalid @enderror" name="testresultstatus" value="{{ $tr->testresultstatus}}" autofocus readonly>
                                    </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="testresultduration"><strong>Test Duration (in minutes)</strong></label>
                                        <input id="testresultduration" type="text" class="form-control @error('testresultstatus') is-invalid @enderror" name="testresultduration" value="{{ $tr->testresultduration/60}}" autofocus readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                    <div class="form-group"><label for="testresultreference"><strong>ID</strong></label>
                                        <input id="testresultreference" type="text" class="form-control @error('testresultreference') is-invalid @enderror" name="testresultreference" value="{{ $tr->testresultreference}}" autofocus>
                                    </div>
                                </div></div>
                                

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testresultcomment"><strong>Comment</strong></label>
                                        <textarea class="form-control" rows="6" name="testresultcomment">{{ $tr->testresultcomment}}</textarea>
                                    </div>
                                </div>
                                </div>

                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="testresultfile"><strong>File Attachment</strong></label><br>
                                        <a href="{{ asset('uploads/testresultfile/'. $tr->testresultfile) }}">{{ $tr->testresultfile }}</a><br>
                                        <input class="btn btn" type="file" placeholder="" name="testresultfile" value="{{$tr->testresultfile}}">
                                        </div>
                                    </div>
                                </div>
                                

                        

                            
                        </div>
                        <div class="card-header py-3">
                        <button class="btn btn-primary" type="submit">Save Test Result</button>
                            <button class="btn btn-danger" type="button" onclick="document.location='/projects/{{$info->projectid}}'">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection

