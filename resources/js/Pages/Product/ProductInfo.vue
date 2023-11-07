<script setup>

defineProps({
    product: Object,
    country: Object,
    price: Number,
})
</script>

<template>
    <div class="block mt-2">
        <h1 class="mt-4">{{ product.name }}</h1>
        <p>Base price: {{ product.price }}</p>
        <p class="mb-2">Country VAT percent: {{ country.vat_percent }}</p>
        <hr>
        <b class="mt-3 text-success">Total price: {{ price }}</b>
    </div>
</template>
