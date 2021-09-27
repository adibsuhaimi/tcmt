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
<br>
<div id="content">
                <div class="container-fluid" style="width: 1000px;">
                    <h3 class="text-dark mb-4">Dashboard</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">List of Project</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                  
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
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Assign As</th>
                                            <th>Delete</th>
                                            <th>Update</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{$row->projectname}}</td>
                                                <td>{{$row->role}}</td>
                                                <td>
                                                  <form method="post" action="{{ route('projects.destroy', $row->projectid)}}">
                                                    {{ csrf_field() }}
                                                  <input type="hidden" name="_method" value="DELETE">
                                                  <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                                  </form></td>
                                                <td><button class="btn btn-primary" type="button" onclick="document.location='/projects/{{ $row->projectid}}/edit'">Update</td>
                                                <td><button class="btn btn-primary" type="button" onclick="document.location='/projects/{{$row->projectid}}'">View</td>
                                                
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        </form> 
                        <div class="card-header py-3"><button class="btn btn-primary" type="button" onclick="document.location='{{route('projects.create')}}'">Add New Project</button></div>
                    </div>
                </div>
            </div>
@endsection

