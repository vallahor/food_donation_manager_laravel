<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const { food_package } = defineProps<{ food_package: any }>();
console.log(food_package);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Food Package</h2>
                <span>{{ food_package.data.name }}</span>
            </div>
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Description</h2>
                <span v-if="food_package.data.description">{{ food_package.data.description }}</span>
                <span v-if="!food_package.data.description">---</span>
            </div>
        </div>
    </AppLayout>
</template>
