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

<script>
window.onload = function () {
	
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	
	title:{
		text:"Fortune 500 Companies by Country"
	},
	axisX:{
		interval: 1
	},
	axisY2:{
		interlacedColor: "rgba(1,77,101,.2)",
		gridColor: "rgba(1,77,101,.1)",
		title: "Number of Companies"
	},
	data: [{
		type: "bar",
		name: "companies",
		axisYType: "secondary",
		color: "#014D65",
		dataPoints: [
			{ y: 3, label: "Sweden" },
			{ y: 7, label: "Taiwan" },
			{ y: 5, label: "Russia" },
		]
	}]
});
chart.render();

}
</script>

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
        <li class="nav-item"><b><a class="nav-link" href="/projects/{{$data->projectid}}">Project</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/testruns/{{$data->projectid}}">Test Run</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/projects/team/{{$data->projectid}}">Team Member</a></b></li>
          <li class="nav-item"><b><a class="nav-link" href="/summary/{{$data->projectid}}">Summary</a></b></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<br>
<body id="page-top">
<body>


<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            
            <div class="container-fluid" style="width: 977px;">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Summary</h3><a class="btn btn-success btn-sm d-none d-sm-inline-block" role="button" href="" onclick="window.print()"><i class="fa fa-download fa-sm text-white-1000"></i>&nbsp;Generate Report</a></div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Requirements</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countreq}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Test Cases</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$counttc}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Test Results</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$counttr}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Team Member</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countmember}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Summary</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>Test Result</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Passed</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countpass}}&nbsp;&nbsp;&nbsp;&nbsp;({{$totalpass}}%)</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>Failed</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countfail}}&nbsp;&nbsp;&nbsp;&nbsp;({{$totalfail}}%)</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Pending</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countpending}}&nbsp;&nbsp;&nbsp;&nbsp;({{$totalpending}}%)</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="row">
                <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Test Result by Month</p>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height: 270px;">
                                <canvas data-bs-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:
                                [
                                    @foreach($graph1 as $graph1)
                                    @if ($graph1 != $last)
                                    &quot;{{$graph1->month}}/{{$graph1->year}}&quot;,
                                    @endif
                                    @endforeach
                                    @if ($last==false)
                                    &quot;0/0&quot;
                                    @else
                                    &quot;{{$last->month}}/{{$last->year}}&quot;
                                    @endif
                                ],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Test Result&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:
                                [
                                    @foreach($graph2 as $graph2)
                                    @if ($graph2 != $last)
                                    &quot;{{$graph2->data}}&quot;,
                                    @endif
                                    @endforeach
                                    @if ($last==false)
                                    &quot;0&quot;
                                    @else
                                    &quot;{{$last->data}}&quot;
                                    @endif
                                ]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Test Case Result (%)</p>
                            </div>
                            <div class="card-body">
                            <div class="chart-area" style="height: 225px;"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Passed&quot;,&quot;Failed&quot;,&quot;Pending&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#DC3545&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{$totalpass}} &quot;,&quot;{{$totalfail}} &quot;,&quot;{{$totalpending}} &quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                                <div class="text-center small mt-4"><span class="mr-2"><i class="fa fa-circle text-info"></i>&nbsp;Pending</span><span class="mr-2"><i class="fa fa-circle text-danger"></i>&nbsp;Failed</span><span class="mr-2"><i class="fa fa-circle text-success"></i>&nbsp;Passed</span></div>
                            
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Average Test Effort</p>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height: 270px;">
                                <canvas data-bs-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:
                                [
                                    @foreach($aa as $aa)
                                    @if ($aa != $last2)
                                        &quot; {{$aa['name']}} &quot;,
                                    @else
                                        &quot; {{$aa['name']}} &quot;
                                    @endif
                                    @endforeach

                                    @if ($last2==false)
                                        &quot; No Tester&quot;
                                    @endif
                                
                                ],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Average second(s) per test case&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:
                                [
                                    @if ($last2==false)
                                    &quot;0&quot;
                                    @else
                                        @foreach($aa2 as $aa2)
                                        @if ($aa2 != $last2)
                                            &quot; {{$aa2['total']}} &quot;,
                                        @else
                                            &quot; {{$last2['total']}} &quot;
                                        @endif
                                        @endforeach                          
                                    @endif
                                ]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Test Execution Completion (%)</p>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height: 225px;"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Tested&quot;,&quot;Untested&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#DC3545&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{$yexe}} &quot;,&quot;{{$nexe}} &quot;,&quot;&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                                <div class="text-center small mt-4"><span class="mr-2"><i class="fa fa-circle text-success"></i>&nbsp;Tested</span><span class="mr-2"><i class="fa fa-circle text-danger"></i>&nbsp;Untested</span></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid" style="width: 1000px;">
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

                        <div id="collapseDVR3" class="panel-collapse collapse in">
                          <div class="tree ">
                            
                            <ul>
                              <li><span><b> PROJECT REQUIREMENTS</b></span>&nbsp;
                                  <ul>
                                  @foreach($req as $req)
                                  
                                    <li><span>{{$req->reqreference}} &nbsp; {{$req->reqtitle}}</span>
                                        <ul>

                                        @foreach($testcase as $tc)
                                          @if($tc->reqid == $req->reqid)

                                          <li><span>{{$tc->testcasereference}} &nbsp; {{$tc->testcasetitle}}</span>
                                              <ul>
                                              @foreach($testresult as $tr)
                                                @if($tr->testcaseid == $tc->testcaseid)

                                                <li><span>{{$tr->testresultreference}} &nbsp; {{$tr->testresultstatus}}</span>

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


<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>

</body>

@endsection

