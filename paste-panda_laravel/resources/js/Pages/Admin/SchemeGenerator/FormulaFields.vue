<template>
    <table>
        <tr class="is-flex is-align-items-center">
            <td style="width: 300px;">
                {{ item.key }}
            </td>
            <td>
                <input type="text" class="input" placeholder="Fixed value"
                       v-model="formula.colors[item.key].fixed_value"
                       @blur="updateValues">
            </td>
            <td>
                <input type="number" class="input" placeholder="Saturation"
                       v-model="formula.colors[item.key].fixed_saturation"
                       @blur="updateValues">
            </td>
            <td>
                <input type="number" class="input" placeholder="Brightness"
                       v-model="formula.colors[item.key].fixed_brightness"
                       @blur="updateValues">
            </td>
            <td>
                <input type="number" class="input"
                       placeholder="Alter Saturation"
                       v-model="formula.colors[item.key].altered_saturation"
                       @blur="updateValues">
            </td>
            <td>
                <input type="number" class="input"
                       placeholder="Alter Brightness"
                       v-model="formula.colors[item.key].altered_brightness"
                       @blur="updateValues">
            </td>
            <td>
                <input type="text" class="input" placeholder="Opacity"
                       v-model="formula.colors[item.key].opacity"
                       @blur="updateValues">
            </td>
            <td>
                <input type="text" class="input" placeholder="Fallback Variable"
                       v-model="formula.colors[item.key].fallback_variable"
                       @blur="updateValues">
            </td>
        </tr>
    </table>
</template>
<script>
export default {
    name: 'FormulaFields',
    props: {
        formula: {},
        item: {},
        updateValues: {}
    }
}
</script>
<style scoped>
td {
    padding: 20px;
}
</style>
