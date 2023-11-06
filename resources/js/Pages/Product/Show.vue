<script setup>
// import Layout from './Layout'
import { Head } from '@inertiajs/vue3'

defineProps({
    product: Object,
    country: Object,
    price: Number,
})
</script>

<template>
<!--    <Layout>-->
<!--        <Head title="Product" />-->
        <h1>{{ product.name }}</h1>
        <p>Base price: {{ product.price }}</p>
        <p>Country VAT percent: {{ country.vat_percent }}</p>
        <p>Total price: {{ price }}</p>
<!--    </Layout>-->
</template>
