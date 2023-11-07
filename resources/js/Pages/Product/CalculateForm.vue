<script setup>
import {router, useForm} from '@inertiajs/vue3'
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ProductInfo from "@/Pages/Product/ProductInfo.vue";

defineProps({
    products: Array,
    errors: Object,
    product: Object,
    country: Object,
    price: Number,
})

const form = useForm({
    product_id: null,
    tax_number: null,
})

function submit() {
    router.post('/product/calculate', form)
}
</script>

<template>
    <GuestLayout>
        <Head title="Product Price"/>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="product_id" value="Product" />

                <select
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    name="product_id"
                    id="product_id"
                    v-model="form.product_id"
                >
                    <option v-for="product in products" :value="product.id">
                        {{ product.name }}
                    </option>
                </select>

                <InputError class="mt-2" :message="errors?.product_id" />
            </div>
            <div class="mt-5">
                <InputLabel for="tax_number" value="Tax Number" />

                <TextInput
                    id="tax_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.tax_number"
                    required
                    autofocus
                    autocomplete="tax_number"
                />

                <InputError class="mt-2" :message="errors?.tax_number" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </div>

            <ProductInfo
                v-if="price"
                :country="country"
                :product="product"
                :price="price"
            />
        </form>
    </GuestLayout>
</template>
