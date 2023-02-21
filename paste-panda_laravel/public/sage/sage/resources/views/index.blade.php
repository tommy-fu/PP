@extends('layouts.app')

@section('content')
	{{--  @include('partials.page-header')--}}
	<div>
		<div class="section hero-1__container">
			<div class="container">
				<div class="columns">
					<div class="column is-6">
						<h6 class="hero-1__subheading">
							Subheading above heading
						</h6>
						
						<h1 class="hero-1__title">The 2020 Tech Revolution Is Officially Here.</h1>
						
						<div class="hero-1__text-container">
							<p class="hero-1__description">Here’s some body text that also spans a couple of rows in
								order
								to make the text correspond to
								the
								design that has been chosen to represent Business.</p>
							
							<button class="hero-1__button">Get Started</button>
							
							<p class="hero-1__second-description">Smaller text explaining something fineprint worthy
								like
								Sign Up Terms</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="section">
			<div class="container">
				<div class="usp-1--title-container">
					<h4 class="usp-1--subheading">SUBHEADING ABOVE HEADING</h4>
					<h2 class="usp-1--title">H2 Heading S that spans a couple of rows easily.</h2>
				</div>
				<div class="columns">
					<div class="column">
						<div class="usp-1__item-container">
							<img src="@asset('images/usp-1.svg')" class="usp-1__item-icon">
							<h4 class="usp-1__item-title">Frontend-utveckling</h4>
							
							<p class="usp-1__item-description">
								Here’s some body text that also spans a couple of rows in order to make the text
								correspond
								to the design that has been chosen to represent Business.
							</p>
							
							<a href="#" class="usp-1__item-link">Get Started</a>
						</div>
					</div>
					
					<div class="column">
						<div class="usp-1__item-container">
							<img src="@asset('images/usp-1.svg')" class="usp-1__item-icon">
							<h4 class="usp-1__item-title">Backend-utveckling</h4>
							
							<p class="usp-1__item-description">
								Here’s some body text that also spans a couple of rows in order to make the text
								correspond
								to the design that has been chosen to represent Business.
							</p>
							
							<a class="usp-1__item-link">Get Started</a>
						</div>
					</div>
					
					<div class="column">
						<div class="usp-1__item-container">
							<img src="@asset('images/usp-1.svg')" class="usp-1__item-icon">
							<h4 class="usp-1__item-title">Konsultarbete</h4>
							
							<p class="usp-1__item-description">
								Here’s some body text that also spans a couple of rows in order to make the text
								correspond
								to the design that has been chosen to represent Business.
							</p>
							
							<a class="usp-1__item-link">Get Started</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="section">
			<div class="container">
				<div class="columns">
					<div class="column is-4">
						<div class="usp-2__title-container">
							<!--							<h4 class="usp-1&#45;&#45;subheading">SUBHEADING ABOVE HEADING</h4>-->
							<h2 class="usp-2__title">H2 Heading S that spans a couple of rows easily.</h2>
							
							<p class="usp-2__description">
								Here’s some body text that also spans a couple of rows in order to make the text
								correspond
								to the design that has been chosen to represent Business.
							</p>
							
							
							<a class="usp-2__button">Get Started</a>
						</div>
					</div>
					
					<div class="column is-7 is-offset-1">
						<div class="columns is-multiline">
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just A Service</h4>
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
							
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just Another Service</h4>
									
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
							
							
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just Another Service</h4>
									
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
							
							
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just Another Service</h4>
									
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
							
							
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just Another Service</h4>
									
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
							
							
							<div class="column is-6">
								<div class="usp-2__item-container">
									<img src="@asset('images/usp-1.svg')" class="usp-2__item-icon">
									<h4 class="usp-2__item-title">This Is Just Another Service</h4>
									
									<a href="#" class="usp-2__item-link">Get Started</a>
								</div>
							</div>
						
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{--  @if (!have_posts())--}}
	{{--    <div class="alert alert-warning">--}}
	{{--      {{ __('Sorry, no results were found.', 'sage') }}--}}
	{{--    </div>--}}
	{{--    {!! get_search_form(false) !!}--}}
	{{--  @endif--}}
	
	{{--  @while (have_posts()) @php the_post() @endphp--}}
	{{--    @include('partials.content-'.get_post_type())--}}
	{{--  @endwhile--}}
	
	{!! get_the_posts_navigation() !!}
@endsection
