@extends('layouts.layout_small')
@section('content')
	<div class="form-container">
		<div class="form-block w-form has-text-centered mb-24">
			<h1 class="h1 title is-size-2">One last thing...</h1>
			<div class="body-18 subtitle">In order to build a product you'll love, we need to know just a bit about you.</div>
		</div>
		<form action="{{route('onboarding_survey.store')}}" method="POST">
			{{csrf_field()}}
			<div>
				<div class="field">
					<div class="control">
						<div class="is-fullwidth is-primary">
							<select id="titleId" name="title_id" onchange="showDiv('custom-title-input', this)">
								<option value="">What&#x27;s your title?</option>

								@foreach($titles as $title)
										<option value="{{$title->id}}" {{old('title_id') == $title->id && old('title_id') != null ? 'selected' : ''}}>{{$title->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<p class="help is-danger" style="margin: 0;">{{$errors->first('title_id')}}</p>
				</div>
				<div class="field">
					<div class="control">
						<input id="custom-title-input" class="input" name="custom_title"
						       placeholder="Please enter your title"
						       style="margin-top: 8px; display: none;">
					</div>
					<p class="help is-danger" style="margin: 0;">{{$errors->first('custom_title')}}</p>
				</div>
				<div class="field">
					<div class="control">
{{--						<div class="select is-fullwidth">--}}
						<div class="is-fullwidth">
							<select name="website_type_id" class="select-field" id="webisteTypeId"
							        onchange="showDiv('custom-website-type-input', this)">
								<option value="">What websites do you build most frequently?</option>
								@foreach($website_types as $website)
									<option value="{{$website->id}}" {{old('website_type_id') == $website->id && old('website_type_id') != null ? 'selected' : ''}}>{{$website->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<p class="help is-danger" style="margin: 0;">{{$errors->first('website_type_id')}}</p>
				</div>
				<div class="field">
					<div class="control">
						<input id="custom-website-type-input" class="input w-input" name="custom_website_type"
						       placeholder="Please enter the type of website" style="margin-top: 8px; display: none;">
					</div>
					<p class="help is-danger" style="margin: 0;">{{$errors->first('custom_website_type')}}</p>
				</div>
				<div class="form-block w-form">
					<input type="submit"
					       value="Continue to Pastepanda"
					       class="button is-primary is-fullwidth">
				</div>
			</div>
		</form>
	</div>
@endsection



<script>
    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value == 0 ? 'block' : 'none';
    }

	window.onload = function() {

		var titleId = document.getElementById("titleId");
		if(titleId.value == 0 && titleId.value != '') {
			showDiv('custom-title-input', titleId);
		}

        var webisteTypeId = document.getElementById("webisteTypeId");
        if(webisteTypeId.value == 0 && webisteTypeId.value != '') {
            showDiv('custom-website-type-input', webisteTypeId);
        }

	};

	// var title_id_select = document.getElementById('title_id_select');
	// console.log(title_id_select);
	// showDiv('custom-title-input', title_id_select)
</script>

