<template>
	<div v-if="loaded" v-hotkey="keymap">
		
		<!-- Two-way Data-Binding -->
		<codemirror ref="editor" v-model="html"
		            :changes="changes"
		            :options="cmOptions"
		            
		/>
<!--		@cursorActivity="autoComplete"-->
		<!--		/>-->
		
	</div>
</template>

<script>
    import Tree from 'vuejs-tree'

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
        props: ['id'],
        components: {
            SectionBuilderTreeView,
            'Tree': Tree,
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
	            loaded: false,
                html: "",
            }
        },
        computed: {
            keymap () {
                return {
                    'command + s': this.updateNodeInServer,
                    'enter': {
                        alt: () => {console.log("Test")},
                        keyup: () => {console.log("Test")}
                    }
                }
            }
        },
        methods: {
            changes(){
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
                console.log("Updating in server...");
                // console.log(this.htmls);

                this.html = beautify_html(this.html, {indent_size: 2});
                if (this.loaded) {
                    axios.put('/api/html-nodes/' + this.id, {
                        json: this.htmls,
                        html: this.html,
                    }).then(() => {
                        axios.get('/api/html-nodes/' + this.id).then(response => {
                            // this.html = response.data.html;
                        });
                    })
                }
            }, 1000)
	        
        },
        watch: {
            html(newValue, oldValue) {
	            this.updateNodeInServer();
            }
        },
        created() {
	        
            axios.get('/api/html-nodes/' + this.id + '/edit?svg-section-footer=' + this.svgSectionFooter).then(response => {
                this.htmls = response.data.json;
                this.previewHtml = response.data.htmls;
                this.html = response.data.html;
                this.loaded = true;
            });
	        
        },
    }
</script>


<style>
	.CodeMirror {
		
		
		/* Set height, width, borders, and global font properties here */
		/*font-family: monospace;*/
		height: 100vh;
		
	}
</style>

<!--<style>-->
<!--	-->
<!--	.accordion-toggle.active .accordion-icon {-->
<!--		transform: rotate(90deg);-->
<!--	}-->
<!--</style>-->
