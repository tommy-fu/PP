<swiper ref="mySwiper" :options="swiperOptions" style="position: absolute; left: 0; max-width: 1280px;">
	{{--<swiper ref="mySwiper" :options="swiperOptions">--}}
	@foreach(\App\Domain\ReferralSystem\Models\ReferralReward::orderBy('referrals_needed', 'asc')->get() as $reward)
		<swiper-slide>

			<div class="rewards-item-container">
				<div class="reward-img-container">

					<div class="button-container">
						<a href="#"
						   @click="setPreviewImage('{{$reward->getMedia('image')->count() > 0 ? $reward->getMedia('image')->first()->getUrl() : 'http://paste-panda-laravel.dew/Beanpanda.png'}}')"
						   class="button w-inline-block">
							<div class="cta-text">Preview</div>
						</a>
						@if(Auth::user()->verified_referrals()->count() >= $reward->referrals_needed)
							<a href="{{route('rewards.download', ['id' => $reward->id])}}"
							   class="button is-primary button--download">
								<div class="cta-text cta-text--download">Download</div>
								<img src="/dashboard/images/Arrow-1.svg" alt="" class="image">
							</a>
						@endif
					</div>

					@if(Auth::user()->verified_referrals()->count() >= $reward->referrals_needed)

						<div class="reward-img-overlay"></div>
					@else
						<div class="reward-img-overlay reward-img-overlay--locked-item">
							<div class="referral-number-tag referral-number-tag--gray">
								<h3 class="h3">{{$reward->referrals_needed}}</h3><img
										src="/dashboard/images/cjeck.svg" alt=""
										class="check-icon check-icon--disabled"></div>
						</div>
					@endif


					{{--					<img src="/dashboard/images/1-landing-page.png"--}}
					{{--					     srcset="/dashboard/images/1-landing-page-p-500.png 500w, /dashboard/images/1-landing-page.png 727w"--}}
					{{--					     sizes="(max-width: 479px) 370px, (max-width: 767px) 380px, 420px" alt=""--}}
					{{--					     class="reward-img">--}}

					@if($reward->getMedia('thumbnail')->count() > 0)
						<div class="reward-img" style="border-radius: 4px; overflow: hidden;">
							{{ $reward->getMedia('thumbnail')->first() }}
						</div>

					@else
						<img src="/dashboard/images/1-landing-page.png"
						     srcset="/dashboard/images/1-landing-page-p-500.png 500w, /dashboard/images/1-landing-page.png 727w"
						     sizes="(max-width: 479px) 370px, (max-width: 767px) 380px, 420px" alt=""
						     class="reward-img">
					@endif

				</div>

				{{--								<span style="color: #FFF;">Reward: {{ $reward->getMedia('image')->first() }}</span>--}}
				<div class="rewards-text-container">
					<div class="rewards-inner-container">
						<div class="rewards-top-text-container">
							<h5 class="h5">{{$reward->name}}</h5>
							@if($reward->referrals_needed == 0)
								<div class="free-tag">Free</div>
							@else

								@if(Auth::user()->verified_referrals()->count() >= $reward->referrals_needed)
									<div class="{{Auth::user()->verified_referrals()->count() >= $reward->referrals_needed ? 'referral-blue-14' : 'referral-gray-14'}}">{{$reward->referrals_needed}}
										of {{$reward->referrals_needed}} referrals
									</div>

								@else
									<div class="{{Auth::user()->verified_referrals()->count() >= $reward->referrals_needed ? 'referral-blue-14' : 'referral-gray-14'}}">{{Auth::user()->verified_referrals()->count()}}
										of {{$reward->referrals_needed}} referrals
									</div>
								@endif

								@if(Auth::user()->verified_referrals()->count() >= $reward->referrals_needed)
									<img src="/dashboard/images/mdi_check_circle.svg" alt=""
									     class="referral-icon">
								@else
									<img src="/dashboard/images/mdi_check_circle-gray.svg" alt=""
									     class="referral-icon">

								@endif
							@endif
						</div>
						<div class="body-14">{{$reward->description}}</div>
					</div>
					<a href="#"
					   @click="setPreviewImage('http://paste-panda_laravel.dew/Beanpanda.png')"
					   class="button button--gray w-inline-block">
						<div class="cta-text cta-text--white">Preview</div>
					</a>
				</div>
			</div>

		</swiper-slide>
	@endforeach

	<div class="swiper-pagination" slot="pagination"></div>
</swiper>

