<template>
	<div class="mb-8">
		<div class="columns is-align-items-center">
			<div class="column is-4">
				{{name}}
			</div>
			<div class="column is-8">
				<div class="is-flex">
					<input type="text" class="form-input" placeholder="Enter a value"
					       @blur="$emit('blur')"
					       v-model="internalValue"
					       style="padding: 6px;">
					<div>
						<div class="is-32x32 ml-8" :style="{'background' : internalValue}" style="border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 4px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        name: "ColorInput",
        props: {
            name: {
                type: String,
                default: 'Enter a name'
            },
            value: {
                type: String,
                default: '#000'
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
