<script setup lang="ts">
import ItemController from '@/actions/App/Http/Controllers/ItemController';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Items',
        href: ItemController.index().url,
    },
];

const { items } = defineProps<{ items: any }>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-full">
                <Link variant="secondary" :href="ItemController.create().url" :as="Button"> Register Item </Link>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Quantity</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="item in items.data" :key="item.id">
                        <TableCell>{{ item.name }}</TableCell>
                        <TableCell class="max-w-full break-words whitespace-normal">{{ item.description }}</TableCell>
                        <TableCell>{{ item.quantity_label }}</TableCell>
                        <TableCell class="flex gap-3">
                            <Link variant="secondary" :href="ItemController.show(item.id)" :as="Button"> Show </Link>
                            <Link variant="secondary" :href="ItemController.edit(item.id)" :as="Button"> Edit </Link>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button variant="destructive">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle> Remove {{ item.name }} </DialogTitle>
                                        <DialogDescription>
                                            Deleting this item will remove it permanently from the system. Proceed with caution.
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose>
                                            <Button>Cancel</Button>
                                        </DialogClose>
                                        <DialogClose>
                                            <Link variant="destructive" :href="ItemController.destroy(item.id)" :as="Button">Confirm</Link>
                                        </DialogClose>
                                    </DialogFooter>
                                </DialogContent>
                            </Dialog>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
