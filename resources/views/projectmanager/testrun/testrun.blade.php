@extends('layouts.app')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    
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
<body id="page-top">
<div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid" style="width: 1000px;">
                    <h3 class="text-dark mb-4">Test Run </h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">List of Test Case</p>
                        </div>
                        <div class="card-body">
                            <div class="chart-area" style="width: 909px;height: 200px;"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Passed&quot;,&quot;Failed&quot;,&quot;Pending&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#DC3545&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{$totalpass}} &quot;,&quot;{{$totalfail}} &quot;,&quot;{{$totalpending}} &quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                            <div class="text-center medium mt-4">Test Run Result by Percentage (%)</div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tc as $tc)
                                        <tr>
                                            <td>{{$tc->testcasereference}}</td>
                                            <td>{{$tc->testcasetitle}}</td>
                                            <td>{{$tc->testresultstatus}}</td>
                                            <td><button class="btn btn-primary" type="button" onclick="document.location='/testresults/{{$tc->testresultid}}'">View</td>
                                        </tr>
                                    @endforeach
                                    @foreach ($noresult as $no)
                                        <tr>
                                            <td>{{$no->testcasereference}}</td>
                                            <td>{{$no->testcasetitle}}</td>
                                            <td>Pending</td>
                                            <td> </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                    <div class="card-header py-3">
                            
                            <button class="btn btn-primary" type="button" onclick="document.location='/testruns/{{$info->projectid}}'">Back</button>
                        </div>
                </div>
            </div>
        </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
@endsection

