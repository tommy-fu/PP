@extends('Guest.layout.master')

@section('content')
<section id="section-273" class="section is-relative py-64 py-96-tablet py-144-desktop scheme-1268 is-fullheight"  style="background: #171717;">
    <div class="container">
        <div class="column is-12 is-10-landscape is-offset-1-landscape is-6-desktop is-offset-3-desktop">
            <div class="is-flex is-flex-direction-column is-justify-content-space-between is-align-items-center">
                <div class="is-flex is-justify-content-center mb-40 mb-48-landscape mb-56-tablet mb-64-desktop"
                     style="width: 100%;">
                    <div class="logo-block is-flex is-align-items-center is-justify-content-center has-background-gradient">
                        <img class="logo-img"
                             src="https://res.cloudinary.com/dyfkrtheb/image/upload/v1621589654/black_kitspring_buw98v.svg"/>
                    </div>
                </div>
                <h1 id="signup__heading" class="mega mb-32 mb-40-tablet mb-56-desktop pb-12 has-text-centered">
                    You're all signed up.
                </h1>
                <p class="body-xl has-text-centered">
                    We’ll be in touch with more details soon, so keep an eye on your inbox <span class="has-text-muted">(including the spam folder).</span>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .logo-block {
        height: 96px;
        width: 96px;
        border-radius: 4px;
        /*border-radius: 32px;*/
    }

    .logo-img {
        height: 48px;
        width: 48px;
    }

    @media only screen and (min-width: 992px) {
        .logo-block {
            height: 144px;
            width: 144px;
        }
        .logo-img {
            height: 72px;
            width: 72px;
        }
    }
</style>
