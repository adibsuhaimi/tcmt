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
                    <h3 class="text-dark mb-4">Team Member</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">List of Team Member</p>
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
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Assign As</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $row)
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->email}}</td>
                                                <td>{{$row->role}}</td>
                                                @if($row->id === Auth::user()->id)
                                                <td></td>
                                                @else
                                                <td>
                                                  <a class="btn btn-danger" href="/projects/team/destroy/{{$info->projectid}}/{{$row->id}}"  onclick="return confirm('Are you sure to remove?')">Remove</a>
                                                </td>
                                                @endif
                                            </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-header py-3"><button class="btn btn-primary" type="button" onclick="document.location='/projects/team/edit/{{$info->projectid}}'">Add Member</button></div>
                    </div>
                </div>
            </div>

@endsection

