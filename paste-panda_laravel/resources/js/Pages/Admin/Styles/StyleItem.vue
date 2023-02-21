<template>
    <div>
        <div class="columns is-multiline" v-if="brand.variables[item]['base_styles']">
            <div class="column is-2" v-for="(value, key) in brand.variables[item]['base_styles']">
                <text-input :label="key" v-model="brand.variables[item]['base_styles'][key]"
                            @blur="$emit('blur')"></text-input>
            </div>
        </div>
        <div class="mt-56" v-if="brand.variables[item][responsiveType]">
            <div class="columns is-multiline">
                <div class="column is-2"
                     v-for="(value, key) in brand.variables[item][responsiveType]">
                    <text-input :label="key" v-model="brand.variables[item][responsiveType][key]"
                                @blur="$emit('blur')"></text-input>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from "../../../admin/brand-generator/TextInput"

export default {
    name: 'StyleItem',
    components: {TextInput},
    props: {
        brand: {},
        item: {},
        responsiveType: {}
    }
}
</script>
