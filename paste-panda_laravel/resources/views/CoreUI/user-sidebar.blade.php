{{--<user-dropdown-test inline-template>--}}
<div class="px-16 py-32 is-flex is-justify-content-space-between is-align-items-center"
     style="background: #1C1C1C; width: 70px; height: 100vh; display: flex; flex-direction: column; align-items: center;">

    <div>
        <div class="is-flex mb-32 is-clickable">
            <div style="width: 40px; height: 40px; border-radius: 8px; background: #F7ECDB; display: flex; justify-content: center; align-items: center;"
                 @click="setShowBrandsSidebar(!getShowBrandsSidebar)">
                {{substr(Auth::user()->brand->name, 0, 2)}}
            </div>
        </div>
    </div>

    <div class="mb-32">
        <a href="{{route('accounts.edit')}}">
            <div style="background-color:rgb(30,30,30)"
                 class="is-48x48 is-flex is-align-items-center is-justify-content-center">
                <div style="color:rgb(255,255,255)"
                     class="dropdowntext">{{Auth::user()->getNameInitials()}}</div>
            </div>
        </a>
    </div>
{{--    <div class="mb-32" v-click-outside="hide" style="position: relative;">--}}
{{--        <div class=""--}}
{{--             @click="isActive = !isActive">--}}
{{--            <div style="background-color:rgb(30,30,30)"--}}
{{--                 class="is-48x48 is-flex is-align-items-center is-justify-content-center">--}}
{{--                <div style="color:rgb(255,255,255)"--}}
{{--                     class="dropdowntext">{{Auth::user()->getNameInitials()}}</div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div style="opacity:1;-webkit-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(-5PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);display:block; top:-70px;"--}}
{{--             class="card" v-if="isActive">--}}
{{--            <a href="#"--}}
{{--               class=""><img--}}
{{--                        src="images/Pro-Symbol.svg" alt="" class="image-5">--}}
{{--                <div class="">Go Pro</div>--}}
{{--            </a>--}}
{{--            <a href="#" class="">--}}
{{--                <div class="">Keyboard shortcuts</div>--}}
{{--            </a>--}}
{{--            <a href="#"--}}
{{--               class="">--}}
{{--                <div class="">Restart onboarding</div>--}}
{{--            </a>--}}
{{--            <a href="{{route('users.sign_out')}}" class=" w-inline-block">--}}
{{--                <div class="dropdownlinktext">Log out</div>--}}
{{--            </a>--}}
{{--            <div class="tooltiparrow tooltiparrowregmenu"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
{{--</user-dropdown-test>--}}
