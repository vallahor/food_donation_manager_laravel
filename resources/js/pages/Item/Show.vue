<script setup lang="ts">
import ItemController from '@/actions/App/Http/Controllers/ItemController';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const { item } = defineProps<{ item: any }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Packages',
        href: ItemController.index().url,
    },
    {
        title: item.data.name,
        href: ItemController.show(item.data.id).url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Food Package</h2>
                <span>{{ `${item.data.name} - ${item.data.quantity_label}` }} </span>
            </div>
            <div class="space-2 flex flex-col">
                <h2 class="text-2xl">Description</h2>
                <span v-if="item.data.description">{{ item.data.description }}</span>
                <span v-if="!item.data.description">---</span>
            </div>
        </div>
    </AppLayout>
</template>
