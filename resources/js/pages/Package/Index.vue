<script setup lang="ts">
import FoodPackageController from '@/actions/App/Http/Controllers/FoodPackageController';
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
        href: FoodPackageController.index().url,
    },
];

const { food_packages } = defineProps<{ food_packages: any }>();
console.log(food_packages);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-full">
                <Link variant="secondary" :href="FoodPackageController.create().url" :as="Button"> Register Package </Link>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="food_package in food_packages.data" :key="food_package.id">
                        <TableCell>{{ food_package.name }}</TableCell>
                        <TableCell class="max-w-full break-words whitespace-normal">{{ food_package.description }}</TableCell>
                        <TableCell class="flex gap-3">
                            <Link variant="secondary" :href="FoodPackageController.show(food_package.id)" :as="Button"> Show </Link>
                            <Link variant="secondary" :href="FoodPackageController.edit(food_package.id)" :as="Button"> Edit </Link>
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button variant="destructive">Delete</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle> Remove {{ food_package.name }} </DialogTitle>
                                        <DialogDescription>
                                            Deleting this item will remove it permanently from the system. Proceed with caution.
                                        </DialogDescription>
                                    </DialogHeader>
                                    <DialogFooter>
                                        <DialogClose>
                                            <Button>Cancel</Button>
                                        </DialogClose>
                                        <DialogClose>
                                            <Link variant="destructive" :href="FoodPackageController.destroy(food_package.id)" :as="Button"
                                                >Confirm</Link
                                            >
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
