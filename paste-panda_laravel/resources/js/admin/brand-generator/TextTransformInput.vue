<template>
	<div class="mb-8">
		<label>Transform</label>
		<select name="" id="" v-model="internalValue" class="form-input" @blur="$emit('blur')">
			<option :value="transform.value" v-for="transform in textTransforms">{{transform.label}}</option>
		</select>
	</div>
</template>

<script>
    export default {
        name: "TextTransformInput",
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
                type: String,
                default: ''
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
	        textTransforms(){
                return [
	                {
	                    'label': 'None',
		                'value': ''
	                },
                    {
                        'label': 'Uppercase',
                        'value': 'uppercase'
                    },
                    {
                        'label': 'Capital case',
                        'value': 'capitalize'
                    },
                    {
                        'label': 'Lowercase',
                        'value': 'lowercase'
                    }
                ];
	        }
        },
    }
</script>
