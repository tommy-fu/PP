<template>
    <div class="section pt-40">
        <div style="position: fixed; width: 100%; background: #fff; border-bottom: 1px solid #EAEAEA;">
            
            <!--			<h1 class="h4">{{brand.name}}</h1>-->
            <!--			<button class="button" v-for="style in responsiveStyles" @click="responsiveType = style"-->
            <!--			        :class="{'is-active': responsiveType === style}">{{style}}-->
            <!--			</button>-->
            <!--			-->
            
            
            <div class="py-8" style="border-bottom: 1px solid #F3F3F3;">
                
                <select class="input" style="width: 300px;" v-model="type">
                    <option :value="type" v-for="type in types">{{ type }}</option>
                </select>
                
                <select class="input" style="width: 300px;" v-model="page">
                    <option :value="page" v-for="page in pages">{{ page }}</option>
                </select>
            
            </div>
        
        
        </div>
        <div class="mt-160">
            <div class="columns">
                <div class="column is-6">
                    <div v-for="element in elements">
                        <h4 class="heading-3" style="font-weight: bold; text-decoration: underline;">{{
                                element.label
                            }}</h4>
                        
                        <div v-for="(item, label) in element.items">
                            <div class="mb-56" v-if="item.states">
                                <h5 class="heading-4">{{ label }}</h5>
                                
                                <tabs :options="{ useUrlFragment: false }" v-if="item.states">
                                    <tab v-for="(state, key) in item.states" :name="key" :key="key">
                                        <div v-for="input in state">
                                            <color-input :name="input.property" v-model="scheme.colors[input.key]"
                                                         @blur="updateScheme"/>
                                        </div>
                                        
                                        <!--                                    <StyleItem :brand="brand" :item="tab" @blur="updateBrand" :responsive-type="responsiveType"/>-->
                                    </tab>
                                </tabs>
                                
                                <div v-for="input in item" v-else>
                                    <color-input :name="input.property" v-model="scheme.colors[input.key]"
                                                 @blur="updateScheme"/>
                                </div>
                            </div>
                            
                            <div class="mb-24" v-else>
                                <h4 class="h5" v-if="element.type !== 'flat'">{{ label }}</h4>
                                <div v-for="input in item">
                                    <color-input :name="input.property" v-model="scheme.colors[input.key]"
                                                 @blur="updateScheme"/>
                                </div>
                                
<!--                                <div v-for="input in item" v-else>-->
<!--                                    <h5 class="heading-4">{{ label }}</h5>-->
<!--                                    <color-input :name="input.property" v-model="scheme.colors[input.key]"-->
<!--                                                 @blur="updateScheme"/>-->
<!--                                </div>-->
                            </div>
                        
                        </div>
                    </div>
                
                </div>
                <div class="column is-6 is-relative">
                    <div style="width: 100%; height: 100vh; position: sticky; top: 0; right: 0; left: 0; bottom: 0;">
                        <iframe ref="iframe" :src="'/sections/' + sectionId" frameborder="0"
                                style="width: 100%; height: 100vh;"></iframe>
                    </div>
                </div>
            </div>
            
            
            <!--		<div v-for="text in elements.texts">-->
            <!--			<color-input :name="text" v-model="scheme.colors[text]" @blur="updateScheme"/>-->
            <!--		</div>-->
            <!--		-->
            <!--		<hr>-->
            <!--		-->
            <!--		<h4 class="heading-4">Buttons</h4>-->
            <!--		-->
            <!--		<div v-for="text in elements.buttons">-->
            <!--			<color-input :name="text" v-model="scheme.colors[text]" @blur="updateScheme"/>-->
            <!--		</div>-->
        
        </div>
    </div>
</template>

<script>
import ColorInput from "../../../admin/color-generator/ColorInput";

export default {
    name: "EditColorScheme",
    components: {ColorInput},
    data() {
        return {
            headings: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']
        }
    },
    props: {
        scheme: Object,
        // texts: Array,
        elements: Array,
        pages: Array,
        types: Array,
        page: String,
        type: String,
        sectionId: String,
    },
    methods: {
        inheritFromScheme() {
            var txt;
            var r = confirm("Are you sure you want to inherit from scheme?");
            if (r === true) {
                this.$inertia.put('/color-schemes/' + this.scheme.id + '/cards/inherit', {},
                    {
                        preserveScroll: true
                    });
            }
            else {
                txt = "You pressed Cancel!";
            }
        },
        updateScheme() {
            this.$inertia.put('/color-schemes/' + this.scheme.id, {
                    'colors': this.scheme.colors,
                },
                {
                    preserveScroll: true
                })
                .then(() => {
                    this.$refs.iframe.contentWindow.location.reload();
                });
        }
    },
    watch: {
        page(newValue, oldValue) {
            this.$inertia.visit('/color-schemes/' + this.scheme.id + '/edit', {
                data: {
                    page: newValue,
                    type: this.type,
                    
                },
            });
        },
        type(newValue, oldValue) {
            this.$inertia.visit('/color-schemes/' + this.scheme.id + '/edit', {
                data: {
                    page: this.page,
                    type: newValue
                },
            });
        }
    },
    
}
</script>
