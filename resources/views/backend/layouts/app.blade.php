<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
        <meta name="author" content="ParkerThemes">
        @yield('meta')

		<link rel="shortcut icon" href="/img/fav.png" />

		<!-- Title -->
		<title>@yield('title', env('APP_NAME'))</title>


		@stack('before-styles')		
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
		<!-- Icomoon Font Icons css -->
		<link rel="stylesheet" href="{{ asset('/fonts/style.css') }}">
		<!-- Main css -->
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
        <link rel="stylesheet" href="{{ asset('/less/styles.css') }}">		
        
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">		

		<!-- DateRange css -->
        <link rel="stylesheet" href="/vendor/daterange/daterange.css" />
		@stack('after-styles')
                

	</head>

	<body>

		<!-- Loading starts -->
		<div id="loading-wrapper">
			<div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<!-- Loading ends -->


		<!-- Page wrapper start -->
		<div class="page-wrapper">
			
			<!-- Sidebar wrapper start -->
			<nav id="sidebar" class="sidebar-wrapper">
				
				<!-- Sidebar brand start  -->
				<div class="sidebar-brand">
					<a href="{{route('admin.dashboard')}}" class="logo">
						<h3 class="text-white text-center"><span style="color:gold">e</span>Parenting</h3><br/>
					</a>
				</div>
				<!-- Sidebar brand end  -->

				<!-- Sidebar content start -->
				<div class="sidebar-content">

					<!-- sidebar menu start -->
					<div class="sidebar-menu">
                        @include('backend.includes.sidebar')
					</div>
					<!-- sidebar menu end -->

				</div>
				<!-- Sidebar content end -->
				
			</nav>
			<!-- Sidebar wrapper end -->

			<!-- Page content start  -->
			<div class="page-content">

				<!-- Header start -->
				<header class="header">
					<div class="toggle-btns">
						<a id="toggle-sidebar" href="#">
							<i class="icon-list"></i>
						</a>
						<a id="pin-sidebar" href="#">
							<i class="icon-list"></i>
						</a>
					</div>
					<div class="header-items">
						<!-- Custom search start -->
						{{-- <div class="custom-search">
							<input type="text" class="search-query" placeholder="Search here ...">
							<i class="icon-search1"></i>
						</div> --}}
						<!-- Custom search end -->

						<!-- Header actions start -->
						<ul class="header-actions">
							{{-- <li class="dropdown">
								<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
									<i class="icon-box"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
									<div class="dropdown-menu-header">
										Tasks (05)
									</div>	
									<ul class="header-tasks">
										<li>
											<p>#20 - Dashboard UI<span>90%</span></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
													<span class="sr-only">90% Complete (success)</span>
												</div>
											</div>
										</li>
										<li>
											<p>#35 - Alignment Fix<span>60%</span></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
													<span class="sr-only">60% Complete (success)</span>
												</div>
											</div>
										</li>
										<li>
											<p>#50 - Broken Button<span>40%</span></p>
											<div class="progress">
												<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li class="dropdown">
								<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
									<i class="icon-bell"></i>
									<span class="count-label">8</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
									<div class="dropdown-menu-header">
										Notifications (40)
									</div>
									<ul class="header-notifications">
										<li>
											<a href="#">
												<div class="user-img away">
													<img src="/img/user21.png" alt="User">
												</div>
												<div class="details">
													<div class="user-title">Abbott</div>
													<div class="noti-details">Membership has been ended.</div>
													<div class="noti-date">Oct 20, 07:30 pm</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="user-img busy">
													<img src="/img/user10.png" alt="User">
												</div>
												<div class="details">
													<div class="user-title">Braxten</div>
													<div class="noti-details">Approved new design.</div>
													<div class="noti-date">Oct 10, 12:00 am</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="user-img online">
													<img src="/img/user6.png" alt="User">
												</div>
												<div class="details">
													<div class="user-title">Larkyn</div>
													<div class="noti-details">Check out every table in detail.</div>
													<div class="noti-date">Oct 15, 04:00 pm</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</li>							 --}}
							<li class="dropdown">
								<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
									<span class="user-name">{{ Auth::user()->name }}</span>
									<span class="avatar">
										<img src="{{ asset(Auth::user()->avatar_location) }}" alt="avatar">
										{{-- <span class="status busy"></span> --}}
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
									<div class="header-profile-actions">
										<div class="header-user-profile">
											<div class="header-user">
												<img src="{{ asset(Auth::user()->avatar_location) }}" alt="Admin Template">
											</div>
											<h5>{{ Auth::user()->name }}</h5>
											<p>{{Auth::user()->roles[0]->name}}</p>
										</div>
										<a href="{{route('frontend.user.account')}}"><i class="icon-user1"></i> My Profile</a>										
										<!-- <a href="login.html"><i class="icon-log-out1"></i> Sign Out</a> -->
										<x-utils.link											
											class="dropdown-item"
											onclick="event.preventDefault();document.getElementById('logout-form').submit();">
											<x-slot name="text">
												<i class="icon-log-out1"></i>
												Sign Out
												<x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
											</x-slot>
										</x-utils.link>
									</div>
								</div>
							</li>
						</ul>						
						<!-- Header actions end -->
					</div>
				</header>
				<!-- Header end -->
                
                <div class="page-header">                    
					@include('backend.includes.breadcrumbs')       
					@yield('page-header-content')             					
                </div>

                <div class="main-container">   
					@include('includes.partials.messages')                
                    @yield('content')						
                </div>

			</div>
			<!-- Page content end -->

		</div>
        <!-- Page wrapper end -->


		@stack('before-scripts')
		<script src="/js/jquery.min.js"></script>

    	<livewire:scripts />
		
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="/js/bootstrap.bundle.min.js"></script>
		<script src="/js/moment.js"></script>

		<!-- Slimscroll JS -->
		<script src="/vendor/slimscroll/slimscroll.min.js"></script>
		<script src="/vendor/slimscroll/custom-scrollbar.js"></script>

		<!-- Daterange -->
		<script src="/vendor/daterange/daterange.js"></script>
		<script src="/vendor/daterange/custom-daterange.js"></script>

		<!-- Polyfill JS -->
		<script src="/vendor/polyfill/polyfill.min.js"></script>

		<!-- Apex Charts -->
		<!-- <script src="/vendor/apex/apexcharts.min.js"></script>
		<script src="/vendor/apex/admin/visitors.js"></script>
		<script src="/vendor/apex/admin/deals.js"></script>
		<script src="/vendor/apex/admin/income.js"></script>
        <script src="/vendor/apex/admin/customers.js"></script> -->
        
        <script src="/js/fontawesome.js"></script>

		<!-- Main JS -->
		<script src="/js/main.js"></script>
    	@stack('after-scripts')	

	</body>
</html>