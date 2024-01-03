@extends('Dashboard.layouts.master2')
@section('css')
<style>
	.loginform{
		display: none;
	}
</style>
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{trans("Dashboard/login_trans.Welcome_back")}}</h2>
												@if ($errors->any())
																<div class="alert alert-danger">
																	<ul>
																		@foreach ($errors->all() as $error)
																						<li>{{ $error }}</li>
																		@endforeach
																	</ul>
																</div>
												@endif
												<div class="form-group">
													<label for="sectionChooser">{{trans("Dashboard/login_trans.select_enter")}}</label>
													<select name="" id="sectionChooser" class="form-control">
														<option value="" selected disabled>{{trans("Dashboard/login_trans.choose_list")}}</option>
														<option value="user">{{trans("Dashboard/login_trans.user")}}</option>
														<option value="doctor">{{trans("Dashboard/login_trans.doctor")}}</option>
														<option value="ray_employee">{{trans("Dashboard/login_trans.ray_employee")}}</option>
														<option value="laboratory_employee">{{trans("Dashboard/login_trans.laboratory_employee")}}</option>
														<option value="admin">{{trans("Dashboard/login_trans.admin")}}</option>
													</select>
												</div>
												{{-- User Form --}}
												<div class="loginform" id="user">
													<h5 class="font-weight-semibold mb-4">{{trans("Dashboard/login_trans.user")}}</h5>
													<form  method="POST" action="{{ route('login.patient') }}">
														@csrf					
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.email")}}</label> <input class="form-control"  name="email" placeholder="{{trans("Dashboard/login_trans.email")}}" type="email" required autofocus :value="old('email')">
														</div>
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.password")}}</label> <input class="form-control" name="password" required placeholder="{{trans("Dashboard/login_trans.password")}}" type="password" autocomplete="current-password">
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans("Dashboard/login_trans.signin")}}</button>
														<div class="row row-xs">
															<div class="col-sm-6">
																<button class="btn btn-block"><i class="fab fa-facebook-f"></i> {{trans("Dashboard/login_trans.facebook")}}</button>
															</div>
															<div class="col-sm-6 mg-t-10 mg-sm-t-0">
																<button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> {{trans("Dashboard/login_trans.twitter")}}</button>
															</div>
														</div>
													</form>
													<div class="main-signin-footer mt-5">
														<p><a href="">{{trans("Dashboard/login_trans.forgot")}}</a></p>
														<p>{{trans("Dashboard/login_trans.dont_have_account")}} <a href="{{ url('/' . $page='signup') }}"> {{trans("Dashboard/login_trans.create_account")}}</a></p>
													</div>
											 </div>
												{{-- Doctor Form --}}
												<div class="loginform" id="doctor">
													<h5 class="font-weight-semibold mb-4">{{trans("Dashboard/login_trans.doctor")}}</h5>
													<form  method="POST" action="{{ route('login.doctor') }}">
														@csrf					
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.email")}}</label> <input class="form-control"  name="email" placeholder="{{trans("Dashboard/login_trans.email")}}" type="email" required autofocus :value="old('email')">
														</div>
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.password")}}</label> <input class="form-control" name="password" required placeholder="{{trans("Dashboard/login_trans.password")}}" type="password" autocomplete="current-password">
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans("Dashboard/login_trans.signin")}}</button>
													</form>
													<div class="main-signin-footer mt-5">
														<p><a href="">{{trans("Dashboard/login_trans.forgot")}}</a></p>
													</div>
											 </div>
												{{-- Ray_employee Form --}}
												<div class="loginform" id="ray_employee">
													<h5 class="font-weight-semibold mb-4">{{trans("Dashboard/login_trans.ray_employee")}}</h5>
													<form  method="POST" action="{{ route('login.ray_employee') }}">
														@csrf					
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.email")}}</label> <input class="form-control"  name="email" placeholder="{{trans("Dashboard/login_trans.email")}}" type="email" required autofocus :value="old('email')">
														</div>
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.password")}}</label> <input class="form-control" name="password" required placeholder="{{trans("Dashboard/login_trans.password")}}" type="password" autocomplete="current-password">
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans("Dashboard/login_trans.signin")}}</button>
													</form>
													<div class="main-signin-footer mt-5">
														<p><a href="">{{trans("Dashboard/login_trans.forgot")}}</a></p>
													</div>
											 </div>
												{{-- laboratory_employee Form --}}
												<div class="loginform" id="laboratory_employee">
													<h5 class="font-weight-semibold mb-4">{{trans("Dashboard/login_trans.laboratory_employee")}}</h5>
													<form  method="POST" action="{{ route('login.laboratory_employee') }}">
														@csrf					
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.email")}}</label> <input class="form-control"  name="email" placeholder="{{trans("Dashboard/login_trans.email")}}" type="email" required autofocus :value="old('email')">
														</div>
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.password")}}</label> <input class="form-control" name="password" required placeholder="{{trans("Dashboard/login_trans.password")}}" type="password" autocomplete="current-password">
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans("Dashboard/login_trans.signin")}}</button>
													</form>
													<div class="main-signin-footer mt-5">
														<p><a href="">{{trans("Dashboard/login_trans.forgot")}}</a></p>
													</div>
											 </div>
												{{-- Admin Form --}}
												<div class="loginform" id="admin">
													<h5 class="font-weight-semibold mb-4">{{trans("Dashboard/login_trans.admin")}}</h5>
													<form  method="POST" action="{{ route('login.admin') }}">
														@csrf					
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.email")}}</label> <input class="form-control"  name="email" placeholder="{{trans("Dashboard/login_trans.email")}}" type="email" required autofocus :value="old('email')">
														</div>
														<div class="form-group">
															<label>{{trans("Dashboard/login_trans.password")}}</label> <input class="form-control" name="password" required placeholder="{{trans("Dashboard/login_trans.password")}}" type="password" autocomplete="current-password">
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans("Dashboard/login_trans.signin")}}</button>
													</form>
													<div class="main-signin-footer mt-5">
														<p><a href="">{{trans("Dashboard/login_trans.forgot")}}</a></p>
													</div>
											 </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
<script>
	$("#sectionChooser").change(function() {
		var myId = $(this).val();
		$(".loginform").each(function() {
			myId === $(this).attr('id') ? $(this).show() : $(this).hide();
		})
	});
</script>
@endsection