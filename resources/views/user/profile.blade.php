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
          <li class="nav-item"><b><a class="nav-link" href="/projects">Dashboard</a></b></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<body id="page-top">
    <br>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid" style="width: 750px;">
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col" style="width: 632px;">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">User Information</p>
                                </div>
                                <div class="card-body">
                                    <form >
                                    @csrf

                                    @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('success')}}
                                    </div>
                                    @endif
                                            <div class="form-row">
                                    <div class="col">
                                    <div class="form-group"><label for="name"><strong>Name</strong></label>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user['name'] }}" autofocus readonly>
                                    </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="name"><strong>Role</strong></label>
                                        <input id="role" type="text" class="form-control" name="role" value="{{ $user['role'] }}" autofocus readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label>
                                        <input id="email" type="text" class="form-control" name="email" value="{{ $user['email'] }}" autofocus readonly>
                                    </div>
                                </div></div>

                                    </div>
                                </div>
                                
                                </form>
                            </div>
                            
</body>

@endsection