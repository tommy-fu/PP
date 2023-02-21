{{--
  Template Name: Custom Template Blog
--}}


@extends('layouts.app')

@section('content')

<div class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-6-tablet">
				<h1 class="heading-1 mb-160">Nyheter och tips angående meditationens olika fördelar i skolmiljön</h1>

				<div>
					<div class="card mb-32" style="height: 200px;"></div>

					<h4 class="heading-4 mb-8">Vulputate sit est</h4>

					<p class="description mb-12">Tellus penatibus viverra nibh massa blandit felis, mattis mattis. Adipiscing
						turpis pharetra tincidunt semper vestibulum libero est. Blandit penatibus nunc egestas dui vitae
						aliquam risus. </p>

					<div class="is-flex mb-32" style="align-items: center;">
						<div style="width: 24px; height: 24px; background: #EAEAEA; border-radius: 100%;"></div>
						<h6 class="blog-author-text">
							<span class="ml-8">Jessica Olafsdottir</span> <span class="ml-4">·</span> <span
									class="ml-4">Aug 13, 2020</span>
						</h6>
					</div>


					<button class="submit-button">Ladda fler artiklar</button>
				</div>
			</div>

			<div class="column is-5-tablet is-offset-1-tablet">
				<div class="mb-96">
					<div class="card mb-32" style="height: 200px;"></div>

					<p class="mb-12">Rekommenderat</p>

					<h6 class="heading-5 mb-12">
						Hur Stillins meditationsprogram hjälpte Eketånga högstadieskola gå från C till B+ i snitt på ett
						år.
					</h6>
				</div>

				<div>
					<span class="caption mb-24">Senaste bloggartiklar</span>
					<div class="is-flex mb-24" style="align-items: center;">
						<div style="width: 50px; height: 50px; background: #EAEAEA; border-radius: 4px"></div>
						<p class="ml-8">Tellus penatibus viverra nibh massa blandit felis, mattis mattis.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
