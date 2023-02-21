<div class="sidebar">
	<div class="sidebar--top">
		<div class="sidebar-profile-container">
			<div class="name-container">
				<div class="profile-block">
					<div class="dropdowntext">{{Auth::user()->getNameInitials()}}</div>
				</div>
				<div class="text-container">
					<h4 class="h4">{{Auth::user()->getShortName()}}</h4>
					<div class="text-icon-container">
						<div class="body-14">Early Access User</div>
						<img src="/dashboard/images/star.svg" alt="" class="ea-star"></div>
				</div>
			</div>
			<div data-w-id="26d7d466-0ac8-9dec-6c87-a99a5d9b435c" class="hamburger-container">
				<div style="color:rgb(255,255,255)" class="stripe"></div>
				<div style="color:rgb(255,255,255)" class="stripe"></div>
				<div style="color:rgb(255,255,255)" class="stripe"></div>
				<div style="opacity:0;-webkit-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);height:0PX;display:none"
				     class="dropdowncontentservice">
					<a href="https://spectrum.chat/pastepanda" class="dropdownlinkblock w-inline-block" target="_blank">
						<div class="dropdownlinktext">Talk to us on Spectrum.chat</div>
					</a>
					<a href="{{route('account.settings')}}" class="dropdownlinkblock w-inline-block">
						<div class="dropdownlinktext">Account settings</div>
					</a>
					<a href="{{route('users.sign_out')}}" class="dropdownlinkblock w-inline-block">
						<div class="dropdownlinktext">Sign out</div>
					</a>
					<div class="tooltiparrow tooltiparrowregmenu"></div>
				</div>
			</div>
		</div>
		<ul role="list" class="nav-list w-list-unstyled">
			<li class="list-item"><img src="/dashboard/images/house.svg" alt="" class="nav-icon">
				<a href="{{route('rewards.show')}}"><div class="nav-body-16">Home</div></a>
			</li>
			<li class="list-item list-item--locked"><img src="/dashboard/images/mdi_home.svg" alt=""
			                                             class="nav-icon">
				<div class="nav-body-16 nav-body-14--locked">Browse library</div>
				<img src="/dashboard/images/mdi_lock.svg" alt="" class="list-item-lock"></li>
		</ul>
	</div>
	<div class="sidebar--bot">
		<img src="/dashboard/images/Vector-65.svg" alt="" class="spectrum-logo">
		<h5 class="h5 h5--bot-margin">Help us help you!</h5>
		<div class="body-14">Help us build Pastepanda to your needs by asking questions, sharing feature requests or
			just hanging out.
		</div>
		<div class="cta-text cta-text--no-bg"><a href="https://spectrum.chat/pastepanda" class="cta-text cta-text--no-bg" target="_blank">Join us on Spectrum.chat →</a></div>
	</div>
</div>
