<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
const api_token = defineProps(['api_token']);
</script>

<template>
    <AppLayout title="Breweries">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Breweries
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome :token="api_token.api_token" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
