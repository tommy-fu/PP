@extends('layouts.layout_dashboard')


@section('content')
	<div>
		<h1 class="h1">Share Pastepanda → Earn Rewards</h1>
		<div style="height: 400px;">
			@include('partials.dashboard.swiper')
		</div>
		<div class="">
			<div class="referral-counter-container">
				<div class="counter-container">
					<h2 class="h2">{{Auth::user()->verified_referrals->count()}}</h2>
					{{--						<div class="referrals-counter-text"> / 10 referrals</div>--}}
					<div class="referrals-counter-text has-text-weight-bold"> referrals</div>
				</div>
				<div class="body-14 body-14--referral-notice">You’re only <span
							class="dynamic-value has-text-weight-bold">{{Auth::user()->getNextReferralReward()->referrals_needed - Auth::user()->verified_referrals()->count()}} referral</span>
					away from receiving <span
							class="dynamic-value has-text-weight-bold">{{Auth::user()->getNextReferralReward()->name}}</span>! 🚀
				</div>
			</div>
			<div class="body-12">You need to be on desktop to retrieve your rewards.</div>
			
			<div class="card mb-24 mt-24">
				<div class="card-content">
					<h5 class="h5 h5--bot-margin">Share your link</h5>
					<div class="body-14">Gather referrals by sharing your personal referral link with others:</div>
					<div class="form-block w-form">
						<form class="form">
							<input type="input" autocomplete="off" class="input w-input"
							       placeholder="{{(Auth::user()->getReferralLink())}}"
							       readonly
							       value="{{(Auth::user()->getReferralLink())}}">
							<input type="button" @click="copyLink('{{Auth::user()->getReferralLink()}}')"
							       value="Copy link" class="cta w-button">
						</form>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-content">
					<h5 class="h5 h5--bot-margin">Share via email</h5>
					<div class="body-14">Gather referrals through your email network. We will add your link
						automatically!
					</div>
					<div class="form-block w-form">
						
						<input type="email" class="input w-input" name="email-2"
						       placeholder="To: (your contact’s email)" v-model="recipient">
						<div class="body-14 body-14--fineprint">Separate multiple emails with commas.</div>
						<textarea
								rows="7"
								style="resize: none;"
								spellcheck="false"
								maxlength="5000" ref="mailbody" id="field" name="field" class="textarea w-input">Hey! I think this Pastepanda service might be something you want to check out. It’s a library of ready-built web design sections to help us get rid of tedious design tasks in our development workflow. You just browse sections and then copy-paste the code straight into your own code editor. Also, apart from pasting standard flexbox-based HTML5 and CSS/SASS code, you can paste code from the major JS libraries (React and Vue) and CSS frameworks (Bootstrap, Bulma and Flex). You can get Early Access through my personal referral link! {{Auth::user()->getReferralLink()}}</textarea>
						<a :href="mailto" value="Send email"
						   class="button is-primary is-fullwidth">Send email</a>
						{{--														<a href="mailto:info@viman.digital,vi.man93@gmail.com" class="cta button">Send email</a>--}}
					
					</div>
				</div>
			</div>
			
{{--			@include('partials.dashboard.share_social_card')--}}
		</div>
	</div>
	<image-preview :show.sync="showPreviewImage" :image="previewImageUrl"
	               @close="showPreviewImage = false;"></image-preview>

@endsection
