<template>
    <div class="section-item">
        <div class="section-item-top">
            <div class="section-top-right">
                <!--				<a href="#" class="square-icon-btn mr-12 w-inline-block"><img src="/icons/expand.svg" loading="lazy"-->
                <!--				                                                              width="14" alt="" class="icon-expand"></a>-->
                <!--				<div class="body-lg color-a3a3a3">7 variations</div>-->
                <div v-if="$page.props.auth.user.show_edit_buttons" style="display: flex;">
                    <!--                    <a class="btn-outlined body-lg mr-12"-->
                    <!--                       style="opacity: 1">ID:{{ section.id }}</a>-->
                    <!--    -->
                    <a class="btn-outlined body-lg mr-12" :href="link.href" target="_blank"
                       v-for="link in links">{{ link.title }}</a>
                </div>
            
            
            </div>
            <div class="section-top-left">
                <SquaredButton @click="showCode = true"
                               icon="code-icon-2"
                               class="mr-12"
                               :active="showCode === true"></SquaredButton>
                <SquaredButton @click="showCode = false"
                               icon="sections"
                               :active="showCode === false"></SquaredButton>
                <div class="vertical-divider mr-20 ml-20"></div>
                <div class="btn-outlined" @click="copyHTML">
                    <div class="body-lg-2">Copy</div>
                </div>
            
            </div>
        </div>
        <div style="display: flex; width: 100%; align-items: center; justify-content: center;"
             v-if="showCode && (section.css_code.length > 0 || section.javascript_code.length > 0)">
            <div class="code-tab-item" :style="getCodeTabColor('html')" @click="codeType = 'html'">HTML</div>
            <div class="code-tab-item" v-if="section.css_code.length > 0" :style="getCodeTabColor('css')"
                 @click="codeType = 'css'">CSS
            </div>
            <div class="code-tab-item" v-if="section.javascript_code.length > 0" :style="getCodeTabColor('js')"
                 @click="codeType = 'js'">JavaScript
            </div>
        </div>
        
        <div class="section-item-content" style="overflow: hidden; overflow-y: scroll;">
            <div class="section-content-inner-container">
                <codemirror ref="editor" v-model="section.rendered_html"
                            :options="cmOptions"
                            style="width: 100%;"
                            v-if="showCode && codeType === 'html'"/>
                
                <codemirror ref="editor" v-model="section.javascript_code"
                            :options="cmJsOptions"
                            style="width: 100%;"
                            v-if="showCode && codeType === 'js'"/>
                
                <codemirror ref="editor" v-model="section.css_code"
                            :options="cmCssOptions"
                            style="width: 100%;"
                            v-if="showCode && codeType === 'css'"/>
                
                <iframe ref="iframe"
                        :id="'iframe-' + section.id"
                        class="has-no-scroll"
                        :srcdoc="'<html><head>' + cssDependencies + '</head><body>' + section.preview_html + '<script type=\'text/javascript\' src=\'https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.3/iframeResizer.contentWindow.js\'></script>' + jsDependencies + '<script>' + section.javascript_code + '</script><script type=\'text/javascript\' src=\'/sections.js\'></script><style>html, body {height: ' + calculatedMinHeight + ';}' + css  + section.css_code + '</style></html>'"
                        frameborder="0"
                        :style="viewportStyling"
                        style="width: 1px;
				        margin: 0 auto;
				        display: block;"
                        v-resize="resizeData"
                        v-show="!showCode">
                </iframe>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations} from "vuex";
import {codemirror} from 'vue-codemirror/src/index';
// import base style
import 'codemirror/lib/codemirror.css';
// language
import 'codemirror/mode/xml/xml.js'

import 'codemirror/theme/darcula.css';
import 'codemirror/theme/monokai.css';
import 'codemirror/theme/base16-dark.css';
import 'codemirror/addon/hint/show-hint.css';
import 'codemirror/lib/codemirror';
// import 'codemirror/mode/sql/sql';
// import 'codemirror/mode/html';
// import 'codemirror/mode/html/html.js'
// import 'codemirror/mode/html/javascript.js';
import 'codemirror/mode/javascript/javascript.js';
import 'codemirror/mode/css/css.js';
import 'codemirror/addon/hint/show-hint';
import 'codemirror/addon/search/searchcursor';
import 'codemirror/addon/search/search';
import 'codemirror/addon/display/placeholder';
import 'codemirror/addon/hint/sql-hint';
import 'codemirror/addon/hint/anyword-hint';
// require active-line.js
import 'codemirror/addon/selection/active-line.js'
import SquaredButton from "./Components/SquaredButton";


export default {
    name: "card-item",
    props: {
        requiresPro: {
            type: [Boolean, Number],
            default: false,
        },
        id: {
            type: Number,
            default: 1,
        },
        section: {
            type: Object,
            default: "",
        },
        imgUrl: {
            type: String,
            default: "/images/Placeholder-Image---Dark-UI.png",
        },
    },
    components: {
        SquaredButton,
        codemirror
    },
    data() {
        return {
            codeType: 'html',
            cmOptions: {
                readOnly: true,
                tabSize: 4,
                mode: 'text/html',
                lineNumbers: true,
                indentUnit: 2,
                autofocus: true,
                lineWrapping: true,
                styleActiveLine: true,
                styleActiveSelected: true,
                matchBrackets: true,
                theme: 'monokai',
                extraKeys: {
                    Ctrl: 'autocomplete',
                },
                foldGutter: true,
            },
            cmCssOptions: {
                readOnly: true,
                tabSize: 4,
                mode: 'text/css',
                lineNumbers: true,
                indentUnit: 2,
                autofocus: false,
                lineWrapping: true,
                styleActiveLine: false,
                styleActiveSelected: false,
                matchBrackets: true,
                theme: 'monokai',
                // extraKeys: {
                //     Ctrl: 'autocomplete',
                // },
                // foldGutter: true,
            },
            cmJsOptions: {
                readOnly: true,
                tabSize: 4,
                mode: 'text/javascript',
                lineNumbers: true,
                indentUnit: 2,
                autofocus: true,
                lineWrapping: true,
                styleActiveLine: true,
                styleActiveSelected: true,
                matchBrackets: true,
                theme: 'monokai',
                extraKeys: {
                    Ctrl: 'autocomplete',
                },
                foldGutter: true,
            },
            showButtons: true,
            showCode: false,
            loaded: false,
            deviceWidths: {
                mobile: '468px',
                tablet: '768px',
                desktop: '100%',
            }
        };
    },
    computed: {
        css(){
            return this.getUserCss;
        },
        ...mapGetters(['getUserCss']),
        links() {
            return [
                {
                    'title': 'ID:' + this.section.id,
                    'href': ''
                },
                {
                    'title': 'Edit HTML',
                    'href': '/sections/' + this.section.id + '/edit'
                },
                {
                    'title': 'Edit Style',
                    'href': '/styles/' + this.$page.props.auth.user.brand_id + '/edit'
                },
                {
                    'title': 'Edit Colors',
                    'href': '/color-schemes/' + this.$page.props.auth.user.color_scheme_id + '/edit'
                },
                {
                    'title': 'Duplicate',
                    'href': '/sections/' + this.section.id + '/duplicate'
                },
            ];
        },
        // getViewportMode() {
        //     return 'desktop'
        // },
        // ...mapGetters(["getBrandId", "$page.props.auth.user", "getViewportMode"]),
        ...mapGetters(["getViewportMode"]),
        cssDependencies() {
            var str = '';
            
            for (var i = 0; i < this.section.css_dependencies.length; i++) {
                str += this.section.css_dependencies[i];
            }
            
            return str;
        },
        jsDependencies() {
            var str = '';
            
            for (var i = 0; i < this.section.js_dependencies.length; i++) {
                str += this.section.js_dependencies[i];
            }
            
            return str;
        },
        resizeData() {
            
            return {
                log: false,
                // autoResize: true,
                autoResize: true,
                resizeFrom: 'child',
                sizeWidth: false,
                // sizeWidth: false,
                checkOrigin: false,
                // width: this.deviceWidths[this.getViewportMode],
                // minWidth: this.deviceWidths[this.getViewportMode],
                // minHeight: '100%',
                // minHeight: minHeight,
                // height: '100%',
                heightCalculationMethod: 'min'
            }
        },
        calculatedMinHeight() {
            
            
            if (this.getViewportMode === 'desktop' && this.section.desktop_preview_height) return this.section.desktop_preview_height + 'px';
            if (this.getViewportMode === 'tablet' && this.section.tablet_preview_height) return this.section.tablet_preview_height + 'px';
            if (this.getViewportMode === 'mobile' && this.section.mobile_preview_height) return this.section.mobile_preview_height + 'px';
            // }
            return 'inherit';
        },
        viewportStyling() {
            
            var res = {};
            
            if (this.getViewportMode === 'desktop') {
                res = {
                    // zoom: 0.45,
                    minWidth: '100%'
                }
                
                if (this.section.desktop_preview_height) {
                    res.height = this.section.desktop_preview_height + 'px';
                }
            }
            
            if (this.getViewportMode === 'tablet') {
                res = {
                    // zoom: 0.7,
                    minWidth: '768px',
                    borderRight: '1px solid #2f2f2f',
                    borderLeft: '1px solid #2f2f2f',
                }
                
                if (this.section.tablet_preview_height) {
                    res.height = this.section.tablet_preview_height + 'px';
                }
            }
            
            if (this.getViewportMode === 'mobile') {
                res = {
                    minWidth: '480px',
                    borderRight: '1px solid #2f2f2f',
                    borderLeft: '1px solid #2f2f2f',
                }
                
                if (this.section.mobile_preview_height) {
                    res.height = this.section.mobile_preview_height + 'px';
                }
            }
            
            
            return res;
        }
    },
    watch: {
        getViewportMode(newValue, oldValue) {
            
            // console.log(this.deviceWidths[newValue]);
            // this.$refs.iframe.iFrameResizer.resize(200, this.deviceWidths[newValue]);
            // this.$refs.iframe.srcdoc = this.$refs.iframe.srcdoc;
            
        }
    },
    methods: {
        getCodeTabColor(lang) {
            if (lang === this.codeType) {
                return {
                    'background': '#272829',
                    'color': '#8C8C8C'
                }
            }
            
            return {
                'background': '#222222',
                'color': '#8C8C8C'
            }
        },
        ...mapMutations(["setShowToast", "setShowPreviewImage"]),
        load() {
            this.loaded = true;
        },
        copyHTML() {
            axios.post("/api/html/", {
                section_id: this.section.id,
            })
                .then((response) => {
                    this.$copyText(response.data).then(
                        () => {
                            this.$notify({
                                group: "foo",
                                title: "Important message",
                                text: "Markup was copied to the clipboard!",
                            });
                        },
                        function (e) {
                            alert("Can not copy");
                            console.log(e);
                        }
                    );
                })
                .catch(function (error) {
                    alert("Well..?");
                    console.log(error);
                });
        },
        copyCSS() {
            this.$notify({
                group: "toast",
                title: "Important message",
                text: "CSS copied to clipboard!",
            });
            
            axios
                .get("/api/css/" + this.id + "/brands/11", {
                    params: {
                        // 'html': this.codeOutputValue
                    },
                })
                .then((response) => {
                    // console.log("Copied..?");
                    // console.log(response.data);
                    this.$copyText(response.data).then(
                        () => {
                            // this.show = true;
                        },
                        function (e) {
                            alert("Can not copy");
                            console.log(e);
                        }
                    );
                })
                .catch(function (error) {
                    alert("Well..?");
                    console.log(error);
                });
        },
    },
    mounted() {
        // console.log(this.$refs.editor);
        // this.$refs.editor.refresh();
        // this.$refs.iframe
        // console.log(this.section);
    },
};
</script>

<style>
.CodeMirror {
    height: 100%;
    padding: 32px;
}
</style>

<style scoped>
.card-item {
    /*width: 800px; height: 520px; border: 1px solid black;*/
    
    /*-ms-zoom: 0.5;*/
    /*-moz-transform: scale(0.7);*/
    /*-moz-transform-origin: 0 0;*/
    /*-o-transform: scale(0.7);*/
    /*-o-transform-origin: 0 0;*/
    /*-webkit-transform: scale(0.7);*/
    /*-webkit-transform-origin: 0 0;*/
    
    /*width: 142.857143%;*/
    
    /*max-height: 300px;*/
    /*width: 166.7%;*/
    /*width: 250%;*/
}


* {
    box-sizing: border-box;
}

body {
    background-color: #262626;
    font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
    color: #333;
    font-size: 14px;
    line-height: 20px;
}

a {
    text-decoration: underline;
}

.section {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 100vh;
    padding-top: 0px;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    background-color: #262626;
}

.body-sm {
    font-family: Inter, sans-serif;
    font-size: 12px;
    text-align: left;
    text-decoration: none;
}

.body-sm.color-fff {
    color: #fff;
}

.btn-outlined {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: auto;
    height: 40px;
    padding-right: 16px;
    padding-left: 16px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #383838;
    border-radius: 6px;
    background-color: #212121;
    -webkit-transition: color 100ms ease-in, border-color 100ms ease-in;
    transition: color 100ms ease-in, border-color 100ms ease-in;
    font-family: Inter, sans-serif;
    color: #a3a3a3;
    text-decoration: none;
    cursor: pointer;
}

.btn-outlined:hover {
    background-color: #2d2d2d;
    color: #fff;
}

.color-a3a3a3 {
    color: #a3a3a3;
}

.color-636363 {
    color: #636363;
}

.body-lg {
    font-family: Inter, sans-serif;
    font-size: 14px;
    line-height: 22px;
    text-align: left;
    text-decoration: none;
}

.body-lg.color-a3a3a3 {
    text-decoration: none;
}

.body-lg.color-fff {
    color: #fff;
}

.body-lg.no-wrap {
    white-space: nowrap;
}

.mr-12 {
    margin-right: 12px;
}

.mt-24 {
    margin-top: 24px;
}

.color-d1d1d1 {
    color: #d1d1d1;
}

.color-555555 {
    color: #555;
}

.top-bar {
    position: fixed;
    left: 0px;
    top: 0px;
    right: 0px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 64px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #1c1c1c;
}

.top-bar-menu {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 284px;
    height: 100%;
    min-width: 284px;
    padding-right: 20px;
    padding-left: 20px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.avatar-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100px;
    height: 100%;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.menu-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.avatar-circle {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 32px;
    height: 32px;
    min-height: 32px;
    min-width: 32px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 16px;
    background-color: #1592ff;
}

.avatar-circle.mr-12 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}

.vertical-divider {
    width: 1px;
    height: 24px;
    background-color: #262626;
}

.vertical-divider.full-height {
    height: 100%;
}

.icon-menu {
    width: 16px;
    height: 16px;
}

.top-bar-settings {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 100%;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.top-bar-settings--left {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: auto;
    height: 100%;
    padding-left: 20px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.top-bar-settings--right {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 300px;
    height: 100%;
    padding-right: 20px;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.outlined-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: auto;
    height: 40px;
    padding-right: 16px;
    padding-left: 16px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #2e2e2e;
    border-radius: 6px;
    -webkit-transition: border-color 100ms ease-in-out;
    transition: border-color 100ms ease-in-out;
    text-decoration: none;
}

.outlined-btn:hover {
    border-color: #4d4d4d;
}

.outlined-btn:focus {
    background-color: #262626;
}

.outlined-btn.mr-12:hover {
    border-color: #4d4d4d;
}

.search-input {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 180px;
    height: 40px;
    padding-right: 16px;
    padding-left: 16px;
    -webkit-box-pack: start;
    -webkit-justify-content: flex-start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #242424;
    border-radius: 6px;
    background-color: #242424;
}

.search-input:active {
    border: 1px solid #383838;
}

.filters-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: auto;
    height: 40px;
    padding-right: 16px;
    padding-left: 16px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #2e2e2e;
    border-radius: 6px;
    -webkit-transition: border-color 100ms ease-in-out;
    transition: border-color 100ms ease-in-out;
    text-decoration: none;
}

.filters-btn:hover {
    border-color: #4d4d4d;
}

.number-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 18px;
    height: 18px;
    padding-right: 1px;
    padding-bottom: 1.5px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #1592ff;
    border-radius: 4px;
}

.body-xs {
    font-family: Inter, sans-serif;
    font-size: 10px;
}

.body-xs.color-1592ff {
    color: #1592ff;
}

.square-icon-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 40px;
    height: 40px;
    min-height: 40px;
    min-width: 40px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #2e2e2e;
    border-radius: 6px;
    -webkit-transition: color 100ms ease-in, border-color 100ms ease-in;
    transition: color 100ms ease-in, border-color 100ms ease-in;
    font-family: Inter, sans-serif;
    color: #a3a3a3;
    text-decoration: none;
}

.square-icon-btn:hover {
    border-color: #4d4d4d;
    color: #fff;
}

.square-icon-btn.square-icon-btn--active {
    background-color: #2e2e2e;
}

.square-icon-btn.square-icon-btn--active:hover {
    border-color: #383838;
}

.square-icon-btn._48x48 {
    width: 48px;
    height: 48px;
}

.square-icon-btn.square-icon-btn--active-blue {
    border-color: #1592ff;
}

.square-icon-btn.square-icon-btn--disabled {
    opacity: 0.25;
    cursor: not-allowed;
}

.square-icon-btn.square-icon-btn--disabled._48x48:hover {
    border-color: #2e2e2e;
}

.mr-20 {
    margin-right: 20px;
}

.ml-20 {
    margin-left: 20px;
}

.icon-desktop {
    width: 26px;
    height: 18px;
}

.icon-tablet {
    height: 18px;
}

.icon-mobile {
    height: 14px;
}

.icon-stacked {
    height: 16px;
}

.icon-grid {
    height: 14px;
}

.left-bar {
    position: fixed;
    top: 64px;
    width: 284px;
    height: 100%;
    min-width: 284px;
    border-top: 1px solid #262626;
    background-color: #1c1c1c;
}

.tab-container {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 72px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    border-bottom: 1px solid #262626;
}

.tab-item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 33.33%;
    height: 100%;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.icon-code {
    width: 22px;
}

.tab-underline {
    position: absolute;
    bottom: 0px;
    width: 100%;
    height: 1px;
    background-color: #262626;
}

.tab-underline.tab-underline--active {
    right: 66.66%;
    z-index: 2;
    width: 33.33%;
    background-color: #fff;
}

.accordion-view-item {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 64px;
    padding-right: 20px;
    padding-bottom: 12px;
    padding-left: 20px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: end;
    -webkit-align-items: flex-end;
    -ms-flex-align: end;
    align-items: flex-end;
    border-bottom: 1px solid #262626;
    text-decoration: none;
}

.icon-arrow-right {
    margin-bottom: 4px;
}

.icon-arrow-down-active {
    margin-bottom: 4px;
}

.label-container {
    padding: 0px 6px;
    border-radius: 3px;
    background-color: #1f2d45;
}

.title-label-wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.body-uppercase {
    font-family: Inter, sans-serif;
    font-size: 8px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.body-uppercase.color-1592ff {
    color: #1592ff;
    font-size: 9px;
    font-weight: 500;
}

.accordion-view-item-wrapper {
    width: 100%;
}

.primary-input {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 40px;
    padding-right: 12px;
    padding-left: 12px;
    -webkit-box-pack: start;
    -webkit-justify-content: flex-start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #242424;
    border-radius: 6px;
    background-color: #242424;
}

.primary-input:active {
    border: 1px solid #4d4d4d;
}

.primary-input.min-width-160 {
    min-width: 160px;
}

.primary-input.min-width-160.mr-12:focus {
    border-color: #4d4d4d;
}

.accordion-items {
    width: 100%;
    padding-top: 16px;
    padding-right: 20px;
    padding-left: 20px;
}

.color-pick {
    width: 12px;
    height: 12px;
    margin-bottom: 1px;
    border-radius: 2px;
    background-color: #2f2f2f;
}

.mb-8 {
    margin-bottom: 8px;
}

.color {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    overflow: hidden;
    width: 28px;
    height: 28px;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    border-radius: 3px;
    background-color: #2f2f2f;
}

.palette-wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 52px;
    height: 52px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border: 1px solid #383838;
    border-radius: 6px;
    -webkit-transition: border-color 50ms ease-in;
    transition: border-color 50ms ease-in;
}

.palette-wrapper:hover {
    border-color: #4d4d4d;
}

.palette-wrapper.palette-wrapper--active {
    border-color: #1592ff;
}

.colortheme-bottom {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.colortheme-item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-justify-content: space-around;
    -ms-flex-pack: distribute;
    justify-content: space-around;
}

.mt-12 {
    margin-top: 12px;
}

.sections-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    height: 100%;
    margin-top: 64px;
    margin-left: 284px;
    padding-right: 20px;
}

.section-item {
    /*width: 50%;*/
    /*height: 50%;*/
    /*min-height: 600px;*/
    /*height: 100%;*/
    /*margin-top: 20px;*/
    /*margin-left: 20px;*/
    border: 1px solid #2f2f2f;
    border-radius: 6px;
    background-color: #202020;
    margin-bottom: 20px;
    overflow: hidden;
}

.section-item-top {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    /*height: 64px;*/
    height: 72px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    grid-auto-columns: 1fr;
    -ms-grid-columns: 1fr 1fr;
    grid-template-columns: 1fr 1fr;
    -ms-grid-rows: auto auto;
    grid-template-rows: auto auto;
    border-bottom: 1px solid #2f2f2f;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    background-color: #1c1c1c;
}

.section-item-content {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    /*height: 536px;*/
    /*-webkit-box-pack: center;*/
    /*-webkit-justify-content: center;*/
    /*-ms-flex-pack: center;*/
    /*justify-content: center;*/
    /*-webkit-box-align: center;*/
    /*-webkit-align-items: center;*/
    /*-ms-flex-align: center;*/
    /*align-items: center;*/
}

.section-top-left {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 50%;
    height: 100%;
    padding-right: 16px;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.section-top-right {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 50%;
    height: 100%;
    padding-left: 16px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.body-lg-2 {
    font-family: Inter, sans-serif;
    font-size: 14px;
    line-height: 22px;
    text-align: center;
    text-decoration: none;
}

.icon-code-small {
    width: 16px;
}

.icon-sections {
    width: 16px;
}

.icon-expand {
    width: 16px;
}

.section-content-inner-container {
    width: 100%;
    /*border-top: 1px solid #2f2f2f;*/
    /*border-bottom: 1px solid #2f2f2f;*/
    background-color: #1e1e1e;
    display: flex;
}

.img-section {
    /*-ms-zoom: 0.5;*/
    /*-moz-transform: scale(0.5);*/
    /*-moz-transform-origin: 0 0;*/
    /*-o-transform: scale(0.5);*/
    /*-o-transform-origin: 0 0;*/
    /*-webkit-transform: scale(0.5);*/
    /*-webkit-transform-origin: 0 0;*/
    
    /*width: 142.857143%;*/
    /*width: 200%;*/
    /*width: 100%;*/
    /*height: 100%;*/
    /*width: 150%;*/
    /*width: 166.7%;*/
    /*width: 250%;*/
    margin: 0 auto;
}

.body-md.color-fff {
    color: #fff;
}

.code-items {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    padding-top: 16px;
    padding-right: 20px;
    padding-left: 20px;
}

.code-title-item {
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    height: 64px;
    margin-left: 20px;
    padding-right: 20px;
    padding-bottom: 12px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: end;
    -webkit-align-items: flex-end;
    -ms-flex-align: end;
    align-items: flex-end;
    border-bottom: 1px solid #262626;
    text-decoration: none;
}

.link-md {
    font-family: Inter, sans-serif;
    text-decoration: none;
}

.link-md.color-1592ff {
    color: #1592ff;
}

.icon-html {
    width: 22px;
}

.icon-react {
    width: 26px;
}

.icon-vue {
    width: 24px;
}

.icon-css {
    width: 22px;
}

.icon-sass {
    width: 28px;
}

.menu {
    position: absolute;
    left: 500px;
    width: 224px;
    height: auto;
    padding-top: 8px;
    padding-bottom: 8px;
    border-radius: 8px;
    background-color: #262626;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
}

.menu-item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    padding: 8px 12px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 4px;
    -webkit-transition: background-color 50ms ease-in;
    transition: background-color 50ms ease-in;
    cursor: pointer;
}

.menu-item:hover {
    background-color: #2d2d2d;
}

.count-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 32px;
}

.mr-16 {
    margin-right: 16px;
}

.menu-2 {
    position: absolute;
    left: 814px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 730px;
    height: auto;
    padding: 8px;
    border-radius: 8px;
    background-color: #262626;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
}

.section-alternatives-container {
    width: 30%;
}

.section-alternatives-container.mr-8 {
    margin-right: 8px;
}

.preview-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 70%;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 4px;
    background-color: #242424;
}

.menu-3 {
    position: absolute;
    left: 497px;
    top: 60px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 232px;
    height: auto;
    padding: 8px;
    border-style: solid;
    border-width: 1px;
    border-color: #2d2d2d;
    border-radius: 8px;
    background-color: #262626;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
}

.sections-alternatives {
    width: 100%;
}

.menu-4 {
    position: absolute;
    left: 241px;
    top: 48px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 232px;
    height: auto;
    padding: 8px;
    border: 1px solid #2d2d2d;
    border-radius: 8px;
    background-color: #262626;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.25), 0 8px 16px 0 rgba(0, 0, 0, 0.25);
}

.icon-info.mr-8 {
    margin-right: 8px;
    margin-bottom: 2px;
}

.code-tab-item {
    flex: 1;
    text-align: center;
    padding-top: 8px;
    padding-bottom: 8px;
    font-family: Inter;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 20px;
    cursor: pointer;
    letter-spacing: -0.01em;
}
</style>
