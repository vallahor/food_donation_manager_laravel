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

const { family } = defineProps<{ family: any }>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Representant</h2>
                <span>{{ `${family.data.first_name} ${family.data.last_name}` }}</span>
            </div>
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Address</h2>
                <span>Street name: {{ family.data.street_name }}</span>
                <span>Zipcode: {{ family.data.zipcode }}</span>
            </div>
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Contact</h2>
                <span>Phone number: {{ family.data.phone_number }}</span>
            </div>
        </div>
    </AppLayout>
</template>
