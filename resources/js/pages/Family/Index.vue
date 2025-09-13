<script setup lang="ts">
import FamilyController from '@/actions/App/Http/Controllers/FamilyController';
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
        title: 'Families',
        href: FamilyController.index().url,
    },
];

const { families } = defineProps<{ families: any }>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-full">
                <Link variant="secondary" :href="FamilyController.create().url" :as="Button"> Register Family </Link>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Visited</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="family in families.data" :key="family.id">
                        <TableCell>{{ `${family.first_name} ${family.last_name}` }}</TableCell>
                        <TableCell>{{ family.visited ? family.visited : 'Pending' }}</TableCell>
                        <TableCell class="flex gap-3">
                            <Link variant="secondary" :href="FamilyController.show(family.id)" :as="Button"> Show </Link>
                            <Link variant="secondary" :href="FamilyController.edit(family.id)" :as="Button"> Edit </Link>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button variant="destructive">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle> Remove {{ `${family.first_name} ${family.last_name}` }} </DialogTitle>
                                        <DialogDescription>
                                            Deleting this item will remove it permanently from the system. Proceed with caution.
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose>
                                            <Button>Cancel</Button>
                                        </DialogClose>
                                        <DialogClose>
                                            <Link variant="destructive" :href="FamilyController.destroy(family.id)" :as="Button">Confirm</Link>
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
