<template>
    <div class="pt-96">
        
        <div class="py-8" style="border-bottom: 1px solid #F3F3F3;">
            
            <select class="input" style="width: 300px;" v-model="type">
                <option :value="type" v-for="type in types">{{ type }}</option>
            </select>
        </div>
        
        <div class="mt-160">
            <div class="">
                <div v-for="element in elements">
                    <h4 class="heading-3" style="font-weight: bold; text-decoration: underline;">{{
                            element.label
                        }}</h4>

                    <div v-for="(item, key) in element.items">
                        <tabs :options="{ useUrlFragment: false }" v-if="item.states">
                            
                            <tab v-for="(state, key) in item.states" :name="key" :key="key">
                                
                                <table>
                                    <FormulaField :color="color" :formula="formula" :update-values="updateValues" v-for="color in state"/>
                                </table>
                            
                            </tab>
                        </tabs>
                        
                        <FormulaFields :formula="formula" :item="item" :update-values="updateValues"/>
                    </div>
                </div>
            </div>
            <!--                <div class="column is-6 is-relative">-->
            <!--                    <div style="width: 100%; height: 100vh; position: sticky; top: 0; right: 0; left: 0; bottom: 0;">-->
            <!--                        <iframe ref="iframe" :src="'/sections/' + sectionId" frameborder="0"-->
            <!--                                style="width: 100%; height: 100vh;"></iframe>-->
            <!--                    </div>-->
            <!--                </div>-->
        </div>
    </div>

</template>

<script>
import FormulaFields from "./FormulaFields";
import FormulaField from "./FormulaField";

export default {
    name: "EditSchemeGenerator",
    components: {FormulaField, FormulaFields},
    props: ['keys', 'formula', 'type', 'types', 'elements'],
    
    methods: {
        getKeyState(key, state) {
            if (state === 'default') {
                return key;
            }
            
            return key + '_' + state;
        },
        updateValues: _.debounce(function () {
            {
                this.$inertia.put('/scheme-color-formula/' + this.formula.id, {
                        'colors': this.formula.colors
                    },
                    {
                        preserveScroll: true,
                        only: ['']
                    })
            }
        }, 2000)
    },
    computed: {
        shouldShowTabs() {
            return this.attributes.length > 0 && this.states.length > 0;
        }
    },
    watch: {
        type(newValue, oldValue) {
            this.$inertia.visit('/scheme-color-formula/' + this.formula.id + '/edit', {
                data: {
                    type: newValue
                },
            });
        }
    },
}
</script>

<style scoped>
td {
    padding: 20px;
}
</style>
