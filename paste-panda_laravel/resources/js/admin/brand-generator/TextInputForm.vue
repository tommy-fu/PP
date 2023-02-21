<template>
	<div>
		<h4 class="heading-5">{{label}}</h4>
		
		<div class="mb-8">
			<div class="columns">
				<div class="column is-4">
					<text-input label="Font" v-model="internalValue['base_styles']['font-family']" @blur="$emit('blur')" v-if="responsiveType === 'mobile_styles'"></text-input>
					<h4 class="h5" style="color: #808080;" v-else>Font Family: {{internalValue['base_styles']['font-family']}}</h4>
				</div>
				<div class="column is-4">
					<font-weight-input v-model="internalValue['base_styles']['font-weight']" @blur="$emit('blur')" v-if="responsiveType === 'mobile_styles'"></font-weight-input>
					<h4 class="h5" style="color: #808080;" v-else>Font weight: {{internalValue['base_styles']['font-weight']}}</h4>
				</div>
				<div class="column is-4">
					<text-transform-input v-model="internalValue['base_styles']['text-transform']" @blur="$emit('blur')" v-if="responsiveType === 'mobile_styles'"></text-transform-input>
					<h4 class="h5" style="color: #808080;"v-else>Text transform: {{internalValue['base_styles']['text-transform']}}</h4>
				</div>
			</div>
		
		</div>
		
		<div class="columns">
			<div class="column is-4">
				<text-input label="Size" v-model="internalValue[responsiveType]['font-size']" @blur="$emit('blur')"></text-input>
			
			</div>
			<div class="column is-4">
				<text-input label="L-spacing" v-model="internalValue[responsiveType]['letter-spacing']" @blur="$emit('blur')"></text-input>
			</div>
			<div class="column is-4">
				<text-input label="L-height" v-model="internalValue[responsiveType]['line-height']" @blur="$emit('blur')"></text-input>
			</div>
		</div>
	</div>
</template>

<script>
    import TextInput from "./TextInput";
    import FontWeightInput from "./FontWeightInput";
    import TextTransformInput from "./TextTransformInput";
    export default {
        name: "TextInputForm",
        components: {TextTransformInput, FontWeightInput, TextInput},
        props: {
            label: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                default: 'Enter a name'
            },
            value: {
                type: Object,
                default: () => {}
            },
            responsiveType: {
                type: String,
                default: 'mobile_styles'
            },
        },
        computed: {
            internalValue: {
                get() {
                    return this.value;
                },
                set(newValue) {
                    this.$emit('input', newValue);
                }
            },
            isMobileStyle() {
                return this.responsiveType === 'mobile_styles';
            },
        },
    }
</script>
