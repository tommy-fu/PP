<template>
    <div class="section">
        <div style="position: fixed; width: 100%; background: #fff; border-bottom: 1px solid #EAEAEA;">
            
            <h1 class="h3">{{ brand.name }}</h1>
            <button class="button" v-for="style in responsiveStyles" @click="responsiveType = style"
                    :class="{'is-active': responsiveType === style}">{{ style }}
            </button>
            
            <select class="input" style="width: 300px;" v-model="page">
                <option :value="page" v-for="page in pages">{{ page }}</option>
            </select>
        
        </div>
        <div class="py-160">
            <div class="columns">
                <div class="column is-6">
                    <div v-for="element in elements">
                        <h4 class="heading-5 mb-156" style="font-weight: bold; text-decoration: underline;">{{
                                element.label
                            }}</h4>
                        
                        <div v-for="(item, label) in element.items" class="mb-56">
                            <h5 class="heading-5 mb-8">{{ label }}</h5>
                            
                            <tabs :options="{ useUrlFragment: false }" v-if="item.states">
                                <tab v-for="(tab, key) in item.states" :name="key" :key="key">
                                    <StyleItem :brand="brand" :item="tab" @blur="updateBrand" :responsive-type="responsiveType"/>
                                </tab>
                            </tabs>
    
                            <StyleItem :brand="brand" :item="item" @blur="updateBrand" :responsive-type="responsiveType" v-else/>


                        </div>
                    </div>
                </div>
                <div class="column is-6 is-relative">
                    <div
                        style="width: 100%; height: 100vh; position: sticky; top: 0; right: 0; left: 0; bottom: 0;">
                        <iframe ref="iframe" :src="'/sections/' + sectionId" frameborder="0"
                                style="width: 100%; height: 100vh;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import StyleItem from "./StyleItem";

export default {
    name: "EditStyle",
    components: {
        StyleItem,
    },
    data() {
        return {
            headings: ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            responsiveType: 'mobile_styles',
        }
    },
    props: {
        brand: Object,
        // texts: Array,
        elements: Array,
        pages: Array,
        page: String,
        sectionId: Number
    },
    computed: {
        responsiveStyles() {
            return ['mobile_styles', 'tablet_styles', 'desktop_styles'];
        },
    },
    watch: {
        page(newValue, oldValue) {
            this.$inertia.visit('/styles/' + this.brand.id + '/edit', {
                data: {
                    page: newValue
                },
            });
        }
    },
    methods: {
        updateBrand() {
            // return;
            this.$inertia.put('/brands/' + this.brand.id, {
                    'variables': this.brand.variables,
                },
                {
                    preserveScroll: true
                }).then(() => {
                // this.$refs.iframe.contentWindow.location.reload();
            })
        }
        // updateScheme() {
        //     this.$inertia.put('/color-schemes/' + this.scheme.id, {
        //             'colors': this.scheme.colors,
        //         },
        //         {
        //             preserveScroll: true
        //         });
        // }
    },
    
}
</script>

<style>
.button {
    background: #FFF;
    color: #000;
    border: 1px solid #EAEAEA;
}

.button.is-active {
    background: dodgerblue;
    color: #FFF;
}
</style>
