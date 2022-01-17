@section('title', 'Cobrança | Dashboard')
@extends ('layouts.app')
@section('content_header')
<ul class="nav nav-tabs nav-sm nav-light mb-25" role="tablist">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left active" data-toggle="tab" href="#tabs-1" role="tab"><i class="zmdi zmdi-apps"></i>Dashboard</a>
    </li>
    
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left"  href="#" role="tab"><i class="zmdi zmdi-trending-up"></i>Graficos de Cobrança</a>
    </li>
</ul>
@stop

@section('content')
<div class="tab-content">
	<div class="tab-pane active" id="tabs-1" role="tabpanel">
		<!-- Row -->
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">	
						@foreach($typereleases as $type)						
						<div class="col-md-3">
							<div class="card card-sm">
									<div class="card-body">
										<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">{{$type->name}}</span>
										<div class="d-flex align-items-end justify-content-between">
											<div>
												<span class="d-block">
													<span class="display-6 font-weight-400 text-dark">{{ number_format($type->releases->sum('amount'), 2, ',','.') }}</span>
													<small>Lanç.</small>
												</span>
											</div>											
											<div>
												<span class="text-danger font-11 font-weight-600">{{round(100 * $type->releases->count() / $totalReleases)}}%</span>
											</div>
										</div>										
										<div class="progress progress-bar-xs mt-30">
											<div class="progress-bar bg-{{$type->color}} w-{{round(100 * $type->releases->count() / $totalReleases / 5) * 5}}" role="progressbar" aria-valuenow="500" aria-valuemin="0" aria-valuemax="{{ $totalReleases }} "></div>
										</div>
									</div>
								</div>
								</div>
							@endforeach	
							<div class="col-md-6">
								<div class="card">
									<div class="card-header card-header-action">
										<h6>Total Sales</h6>
										
									</div>
									<div class="card-body">
										<div class="d-flex align-items-start justify-content-between mb-5">
											<div class="display-5 text-dark">$40,630</div>
											<div class="font-16 text-green font-weight-500">
												<i class="ion ion-md-arrow-up mr-5"></i>
												<span>5.12%</span>
											</div>
										</div>
										<div id="e_chart_10" class="echart" style="height:220px;"></div>
										<div class="hk-legend-wrap mt-10">
											<div class="hk-legend">
												<span class="d-10 bg-green rounded-circle d-inline-block"></span><span>Today</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-green-light-1 rounded-circle d-inline-block"></span><span>Yesterday</span>
											</div>
										</div>
									</div>
								</div>								
							</div>
							<div class="col-md-6">
								<div class="card card-refresh">
									<div class="refresh-container">
										<div class="loader-pendulums"></div>
									</div>
									<div class="card-header card-header-action">
										<h6>Monthly Subscribers</h6>
										<div class="d-flex align-items-center card-action-wrap">
											<a href="#" class="inline-block refresh mr-15">
												<i class="ion ion-md-radio-button-off"></i>
											</a>
											<div class="inline-block dropdown">
												<a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="#">Separated link</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="hk-legend-wrap mb-20">
											<div class="hk-legend">
												<span class="d-10 bg-success rounded-circle d-inline-block"></span><span>Desktop</span>
											</div>													
											<div class="hk-legend">
												<span class="d-10 bg-green-light-1 rounded-circle d-inline-block"></span><span>Mobile</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-green-light-2 rounded-circle d-inline-block"></span><span>Ipad</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-green-light-3 rounded-circle d-inline-block"></span><span>Referral</span>
											</div>
										</div>
										<div id="e_chart_5" class="echart" style="height: 240px;"></div>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								<div class="card card-refresh">
									<div class="refresh-container">
										<div class="loader-pendulums"></div>
									</div>
									<div class="card-header card-header-action">
										<h6>Cobrança de Clientes </h6>
										<div class="d-flex align-items-center card-action-wrap">
											<a href="#" class="inline-block refresh mr-15">
												<i class="ion ion-md-radio-button-off"></i>
											</a>
											<div class="inline-block dropdown">
												<a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-md-more"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#">Action</a>
													<a class="dropdown-item" href="#">Another action</a>
													<a class="dropdown-item" href="#">Something else here</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="#">Separated link</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="hk-legend-wrap mb-20">
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>Franquia</th>                                
																<th>CNPJ</th>
																<th>Valor</th>
																<th>Status</th>
																<th>Ações</th>
															</tr>
														</thead>
														<tbody>														
															@foreach($releases as $release)
																<tr>
																	<td>@if($release->client_id){{$release->client->name}}  @else SEM CADASTRO  @endif</td>
																	<td>{{$release->cnpj}}</td>
																	<td>{{$release->amount}}</td>
																	<td>@if($release->status_id)
																		<span class="badge badge-{{$release->status->color}}">{{$release->status->name}}</span>
																		@endif</td>
																	<td>
																	<a href="{{route('client.releases', $release->client_id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-arrow-alt-circle-down"></i></a>
																	</td>
																</tr>
															@endforeach														
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>					
				</div>
			</div>
		</div>
		<!-- /Row -->
	</div>
</div>
@stop
