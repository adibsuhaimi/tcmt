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
                    <h3 class="text-dark mb-4">Add Member</h3>
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Member Details</p>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="/projects/team/edit/{{ $info->projectid}}">
                        @csrf

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

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Email Address</strong></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus></div>
                                    </div>
                                </div>

                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror</div>

                        <div class="card-header py-3">
                            <button class="btn btn-primary" type="submit">Add Member</button>
                            <button class="btn btn-danger" type="button" onclick="document.location='/projects/team/{{$info->projectid}}'">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
@endsection

