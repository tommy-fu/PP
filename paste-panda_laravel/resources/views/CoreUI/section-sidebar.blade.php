<brand-menu-slider inline-template>
    <div class="px-16 py-32" v-click-outside="hide" style="background: #1C1C1C; width: 400px; height: 100vh; border-left: 1px solid #262626;">
        <div class="is-flex is-justify-content-space-between pb-24" style="color: #FFF; border-bottom: 1px solid #EAEAEA;">
            <div class="is-48x48 is-flex is-align-items-center is-justify-content-center" style="background: #2c2c2c; border-radius: 4px;">S</div>
            <div class="is-48x48 is-flex is-align-items-center is-justify-content-center" style="background: #2c2c2c; border-radius: 4px;">Tt</div>
            <div class="is-48x48 is-flex is-align-items-center is-justify-content-center" style="background: #2c2c2c; border-radius: 4px;">C</div>
        </div>
{{--       <select-style-card></select-style-card>--}}

{{--        <apply-style-card></apply-style-card>--}}
        <div class="">
            <div class="brandsMenu"
                 v-click-outside="hide"
                 style="position: absolute; top: 0; bottom: 0; background: #1E1E1E;
                 z-index: 4;
box-shadow: -10px 0px 15px rgba(0, 0, 0, 0.25); width: 900px; max-width: 100%; padding: 32px; overflow-y: scroll;"
                 :class="{'brandSlide' : getShowBrandsSidebar}">
                <div class="mb-56 is-flex is-justify-content-space-between">
                    <div>
                        <h3 class="mb-4">Styles</h3>
                        <p class="mb-0">Apply a style to your section library</p>
                    </div>
                    <img class="is-16x16" src="/icons/Union.svg" alt="" @click="setShowBrandsSidebar(false)">
                </div>

                <div class="columns is-multiline">
                    @foreach(\App\Domain\Brand\Models\Brand::all() as $brand)

                        <div class="column is-12 mb-40">
                            <img class="mb-16" src="/Beanpanda.png" alt=""
                                 style="width: 100%; height: 400px; object-fit: cover;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 class="mb-4">{{$brand->name}}</h4>
                                    <p style="margin-top: 0 !important; margin-bottom: 0;">{{$brand->colorSchemeSets()->first() ? $brand->colorSchemeSets()->first()->name : 'Nameless'}}</p>
                                </div>

                                <div class="is-flex is-justify-content-space-between" style="width: 300px;">
                                    <div class="is-32x32 is-flex is-align-items-center is-justify-content-center"
                                         style="background: #2D2D2D;">
                                        <img src="/icons/arrow-left.svg" alt="">
                                    </div>

                                    <div class="is-flex">
                                        <div class="is-flex is-justify-content-space-between">
                                            <div class="is-32x32 has-background-primary is-rounded"
                                                 style="border: 1px solid rgba(1, 1, 1, 0.1)"></div>
                                            <div class="is-32x32 has-background-secondary is-rounded ml-8"
                                                 style="border: 1px solid rgba(1, 1, 1, 0.1)"></div>
                                            <div class="is-32x32 has-background-tertiary is-rounded ml-8"
                                                 style="border: 1px solid rgba(1, 1, 1, 0.1)"></div>
                                            <div class="is-32x32 has-background-quaternary is-rounded ml-8"
                                                 style="border: 1px solid rgba(1, 1, 1, 0.1)"></div>
                                        </div>

                                        <div class="is-32x32 is-flex is-align-items-center is-justify-content-center"
                                             style="background: #2D2D2D;">
                                            <img src="/icons/arrow-right.svg" alt="">
                                        </div>
                                    </div>

                                    <div>
                                        <p>1 of {{$brand->colorSchemeSets()->count()}}</p>
                                    </div>
                                </div>
                                {{--                                    <a href="">--}}


                                @if($brand->id == Auth::user()->brand->id)
                                    <button class="button is-primary">Current Style</button>
                                @else
                                    <form method="POST" action="{{route('user-brands.update', [$brand->id])}}">
                                        {{ method_field('PUT') }}
                                        {{csrf_field()}}
                                        <input type="hidden" name="color_scheme_set_id"
                                               value="{{ $brand->colorSchemeSets()->count() > 0 ? $brand->colorSchemeSets()->first()->id : ''}}">
                                        <button class="button">Apply style</button>

                                    </form>
                                @endif

                                {{--                                    </a>--}}
                            </div>

                        </div>


                    @endforeach
                </div>
            </div>


{{--            <div class="is-flex is-justify-content-space-between mb-24">--}}
{{--                <div class="button is-32x32 is-flex is-align-items-center is-justify-content-center"--}}
{{--                     style="background: #2D2D2D; padding: 0;">--}}
{{--                    <img src="/icons/arrow-left.svg" alt="">--}}
{{--                </div>--}}
{{--                <div class="is-flex">--}}
{{--                    @foreach(Auth::user()->colorTheme->colorSchemes as $scheme)--}}
{{--                        <a class="ml-8" href="{{route('user-color-schemes.show', $scheme->id)}}">--}}
{{--                            <div class="is-flex mb-12 is-align-items-center">--}}
{{--                                <div>--}}
{{--                                    <div class="is-32x32 is-rounded" style="background: {{$scheme->colors['background']}};"></div>--}}
{{--                                </div>--}}
{{--                                --}}{{--                            <h5 class="mb-0 ml-12" style="color: #FFF;">{{$scheme->name}}</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="button is-32x32 is-flex is-align-items-center is-justify-content-center"--}}
{{--                     style="background: #2D2D2D; padding: 0;">--}}
{{--                    <img src="/icons/arrow-right.svg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <hr class="mb-24" style=" border: none;--}}
{{--    height: 1px; background: #262626;">--}}

            <a href="/sections" class="is-flex is-justify-content-space-between py-12 px-12 has-background-primary sidebar-item {{Request()->category == '' ? 'is-active' : ''}}">
                <div>All sections</div>
                <div>{{$all_sections_count}}</div>
            </a>

            @foreach($categories as $category)
                <a href="{{route('sections_library.index', ['category' => $category->slug])}}"
                   class="is-flex is-justify-content-space-between py-12 px-12 sidebar-item {{Request()->category == $category->slug ? 'is-active' : ''}}">
                    <div class="">{{$category->name}}</div>
                    <div class="">{{$category->sections_count}}</div>
                </a>
            @endforeach
        </div>
    </div>
</brand-menu-slider>

