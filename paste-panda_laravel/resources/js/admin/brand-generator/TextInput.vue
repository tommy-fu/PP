<template>
	<div class="mb-8">
		<label for="" v-if="label">{{label}}</label>
		<input type="text" class="form-input" placeholder="Default"
		       @blur="$emit('blur')"
		       v-model="internalValue">
	</div>
</template>

<script>
    export default {
        name: "TextInput",
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
        },
    }
</script>

<style scoped>

</style>
