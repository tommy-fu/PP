<!--  start -->
<div class="scheme-2 modal" id="signup-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="card mx-32 my-48 my-64-landscape my-96-desktop" style="background: #333333;">
            <div class="card-body is-flex is-flex-direction-column is-justify-content-space-between">
                <div class="column is-12 has-text-centered mb-32">
                    <h6 id="signup__badge" class="badge_sm mb-24">
                        Now enrolling beta group II
                    </h6>
                    <h2 id="signup__heading" class="h2 mb-32">
                        Apply today
                    </h2>
                    <p id="signup__description" class="body-lg">
                        Try Pastepanda before the masses and receive Early Bird perks and discounts for
                        being an early supporter.
                    </p>

                    <i class="icon-feature mb-24" style="font-size: 96px;"></i>

                    <h2 id="signup__text-done" class="h2 mb-32" style="opacity: 0;">
                        It is done. Now, we wait.
                    </h2>
                </div>
                <div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-flex-start">
                    <h6 class="caption-sm mb-8 signup__label">
                        Title
                    </h6><input id="signup__title-input" class="input_md mb-24"
                                placeholder="This should be a dropdown"/>
                    <h6 class="caption-sm mb-8 signup__label">
                        Email
                    </h6>
                    <input id="signup__email-input" class="input_md mb-8" placeholder="Email"/>
                    <button id="signup__button" class="button_md is-fullwidth">Apply</button>


                    <p id="signup__question" class="body-lg" style="opacity: 0;">
                        Any questions or thoughts?
                    </p>
                    <button id="signup__discord-button" class="button_md has-width-auto"
                            style="visibility: hidden;">Talk to us on Discord <i class="icon-feature"
                                                                                 style="font-size: 16px;"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-close" onclick="closeModal(this)">Close</div>
    {{--    <div class="columns is-justify-content-center">--}}
    {{--        <div class="column is-12 is-10-landscape is-offset-1-landscape is-8-tablet is-offset-2-tablet is-4-desktop is-offset-0-desktop">--}}
    {{--            <div class="is-relative card mx-32 my-48 my-64-landscape my-96-desktop" style="background: #333333;">--}}
    {{--                <div class="card mx-32 my-48 my-64-landscape my-96-desktop" style="background: #333333;">--}}
    {{--                    <div class="card-body is-flex is-flex-direction-column is-justify-content-space-between">--}}
    {{--                        <div class="column is-12 has-text-centered mb-32">--}}
    {{--                            <h6 id="signup__badge" class="badge_sm mb-24">--}}
    {{--                                Now enrolling beta group II--}}
    {{--                            </h6>--}}
    {{--                            <h2 id="signup__heading" class="h2 mb-32">--}}
    {{--                                Apply today--}}
    {{--                            </h2>--}}
    {{--                            <p id="signup__description" class="body-lg">--}}
    {{--                                Try Pastepanda before the masses and receive Early Bird perks and discounts for--}}
    {{--                                being an early supporter.--}}
    {{--                            </p>--}}

    {{--                            <i class="icon-feature mb-24" style="font-size: 96px;"></i>--}}

    {{--                            <h2 id="signup__text-done" class="h2 mb-32" style="opacity: 0;">--}}
    {{--                                It is done. Now, we wait.--}}
    {{--                            </h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-flex-start">--}}
    {{--                            <h6 class="caption-sm mb-8 signup__label">--}}
    {{--                                Title--}}
    {{--                            </h6><input id="signup__title-input" class="input_md mb-24"--}}
    {{--                                        placeholder="This should be a dropdown"/>--}}
    {{--                            <h6 class="caption-sm mb-8 signup__label">--}}
    {{--                                Email--}}
    {{--                            </h6>--}}
    {{--                            <input id="signup__email-input" class="input_md mb-8" placeholder="Email"/>--}}
    {{--                            <button id="signup__button" class="button_md is-fullwidth">Apply</button>--}}


    {{--                            <p id="signup__question" class="body-lg" style="opacity: 0;">--}}
    {{--                                Any questions or thoughts?--}}
    {{--                            </p>--}}
    {{--                            <button id="signup__discord-button" class="button_md has-width-auto"--}}
    {{--                                    style="visibility: hidden;">Talk to us on Discord <i class="icon-feature"--}}
    {{--                                                                                         style="font-size: 16px;"></i>--}}
    {{--                            </button>--}}

    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
<!--  end -->

<style>
    .modal {
        align-items: center;
        display: none;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        right: 0;
        left: 0;
        background: transparent;
        height: 100vh;
    }

    .modal.is-active {
        display: flex;
    }

    .modal-close {
        background: 0 0;
        height: 40px;
        position: fixed;
        right: 20px;
        top: 20px;
        width: 40px;
        z-index: 4000;
        color: #FFF;
    }

    .modal-background {
        background: rgba(0, 0, 0, 0.3);
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    .modal-content {
        margin: 0 auto;
        max-height: calc(100vh - 40px);
        width: 640px;
        overflow: auto;
        position: relative;
    }

</style>
@section('scripts')
    @parent
    <!-- The rest of your scripts -->
    <script>

        function openModal(id) {
            document.getElementById(id).classList.toggle('is-active')
        }

        function closeModal(el){
           el.closest('.modal').classList.remove('is-active');
        }

        // document.getElementById('modal-close').addEventListener('click', function () {
        //     document.getElementsByClassName('modal')[0].classList.toggle('is-active')
        // });

        document.getElementById('signup__button').addEventListener('click', function () {
            new TimelineLite().to('#signup__badge', {"duration": 0.25, "y": -8, "opacity": 0})
            new TimelineLite().to('#signup__heading', {"duration": 0.25, "delay": 0.1, "y": -12, "opacity": 0})
            new TimelineLite().to('#signup__description', {"duration": 0.25, "delay": 0.2, "y": -12, "opacity": 0})

            new TimelineLite().to('.signup__label', {"duration": 0.25, "delay": 0.3, "y": -12, "opacity": 0})
            new TimelineLite().to('#signup__title-input', {"duration": 0.25, "delay": 0.4, "y": -12, "opacity": 0})
            new TimelineLite().to('#signup__email-input', {"duration": 0.25, "delay": 0.4, "y": -12, "opacity": 0})
            new TimelineLite().to('#signup__button', {"duration": 0.25, "delay": 0.4, "y": -12, "opacity": 0})


            new TimelineLite().to('#signup__text-done', {
                "duration": 0.25,
                "delay": 0.85,
                "y": 0,
                "opacity": 1,
                "autoAlpha": 1
            })
            new TimelineLite().to('#signup__question', {
                "duration": 0.25,
                "delay": 0.95,
                "y": 0,
                "opacity": 1,
                "autoAlpha": 1
            })
            new TimelineLite().to('#signup__discord-button', {
                "duration": 0.25,
                "delay": 0.95,
                "y": 0,
                "opacity": 1,
                "autoAlpha": 1
            })
        });

    </script>

@endsection
