<template>
	<div class="mb-8">
		<label>Weight</label>
		<select name="" id="" v-model="internalValue" class="form-input"  @blur="$emit('blur')">
			<option :value="weight" v-for="weight in weights">{{weight}}</option>
		</select>
	</div>
</template>

<script>
    export default {
        name: "FontWeightInput",
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
                type: [Number, String],
                default: 400
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
	        weights(){
                return [100, 200, 300, 400, 500, 600, 700, 800, 900];
	        }
        },
    }
</script>

<style scoped>

</style>
