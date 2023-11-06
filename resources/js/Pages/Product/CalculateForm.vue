<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({ products: Array })

const form = reactive({
    product_id: null,
    tax_number: null,
})

function submit() {
    router.post('/product/calculate', form)
}
</script>

<template>
    <form @submit.prevent="submit">
        <label for="product_id">Product:</label>
        <select id="product_id" v-model="form.product_id">
            <option v-for="product in products" :value="product.id">{{ product.name }}</option>
        </select>
        <label for="tax_number">Tax Number:</label>
        <input id="tax_number" v-model="form.tax_number" />
        <button type="submit">Submit</button>
    </form>
</template>
