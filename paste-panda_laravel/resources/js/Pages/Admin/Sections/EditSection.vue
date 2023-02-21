<template>
    <div>
        <div style="height: 58px;"></div>
        <div class="is-relative">
            <div v-hotkey="keymap">
                
                <!-- Two-way Data-Binding -->
                <!--			<div class="is-flex">-->
                <!--				<div style="width: 40%">-->
                <div v-html="section.rendered_html"></div>
                
                <div style="display: flex;">
                    <button @click="type = 'html'" style="padding: 8px 16px;">HTML</button>
                    <button @click="type = 'css'"  style="padding: 8px 16px;">CSS</button>
                    <button @click="type = 'js'"  style="padding: 8px 16px;">JS</button>
                </div>
                <button class="button" style="position: fixed; top: 20px; right: 20px; z-index: 99999999;"
                        @click="updateNodeInServer">Save
                </button>
                
                <codemirror ref="editor" v-model="section.html"
                            :changes="changes"
                            v-if="type == 'html'"
                            :options="cmOptions"
                
                />
   
                <codemirror ref="editor" v-model="section.css"
                            :changes="changes"
                            v-if="type == 'css'"
                            :options="cmCssOptions"
                />
    
                <codemirror ref="editor" v-model="section.javascript"
                            :changes="changes"
                            v-if="type == 'js'"
                            :options="cmJsOptions"
                />
                <!--				</div>-->
                <!--				<div style="width: 60%">-->
                <!--					<div v-html="section.rendered_html"></div>-->
                <!--				</div>-->
                <!--			</div>-->
                <!--		@cursorActivity="autoComplete"-->
                <!--		/>-->
            </div>
        </div>
    </div>
</template>

<script>
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
import 'codemirror/addon/hint/show-hint';
import 'codemirror/addon/search/searchcursor';
import 'codemirror/addon/search/search';
import 'codemirror/addon/display/placeholder';
import 'codemirror/addon/hint/sql-hint';
import 'codemirror/addon/hint/anyword-hint';
// require active-line.js
import 'codemirror/addon/selection/active-line.js'

var beautify_html = require('js-beautify').html;

// in your vue instance

export default {
    name: "panda-editor",
    props: {
        'section': Object
    },
    components: {
        codemirror
    },
    data() {
        return {
            cmOptions: {
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
                placeholder: "Please end with ';'",
            },
            cmJsOptions: {
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
            type: 'html',
            loaded: false,
            html: "",
            cmCssOptions: {
                // readOnly: true,
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
        }
    },
    computed: {
        keymap() {
            return {
                'command + s': this.updateNodeInServer,
                'enter': {
                    alt: () => {
                        console.log("Test")
                    },
                    keyup: () => {
                        console.log("Test")
                    }
                }
            }
        }
    },
    methods: {
        changes() {
            console.log("Changes");
        },
        codemirror() {
            return this.$refs.myCm.codemirror;
        },
        onCmReady(cm) {
            cm.on('keypress', () => {
                cm.showHint()
            })
        },
        autoComplete() {
            this.codemirror.showHint()
        },
        updateNodeInServer: _.debounce(function () {
            
            this.$inertia.put('/sections/' + this.section.id, {
                'html': this.section.html,
                'css': this.section.css,
                'javascript': this.section.javascript,
            }, {
                preserveScroll: true
            });
            // // console.log(this.htmls);
            //
            // this.html = beautify_html(this.html, {indent_size: 2});
            // if (this.loaded) {
            //     axios.put('/api/html-nodes/' + this.id, {
            //         json: this.htmls,
            //         html: this.html,
            //     }).then(() => {
            //         axios.get('/api/html-nodes/' + this.id).then(response => {
            //             // this.html = response.data.html;
            //         });
            //     })
            // }
        }, 1000)
        
    },
    watch: {
        'section.html'(newValue, oldValue) {
            //  this.updateNodeInServer();
        }
    },
}
</script>


<style>
.CodeMirror {
    height: 100vh;
    padding: 32px;
}
</style>
