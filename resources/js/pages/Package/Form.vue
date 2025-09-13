<script setup lang="ts">
import FoodPackageController from '@/actions/App/Http/Controllers/FoodPackageController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const { food_package, edit } = defineProps<{ food_package: any; edit: boolean }>();
const form = edit ? FoodPackageController.update.form(food_package.data.id) : FoodPackageController.store.form();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <Form v-bind="form" v-slot="{ errors, processing, recentlySuccessful }" class="flex w-2/6 flex-col gap-6">
                <h2>Food Package</h2>
                <div class="grid w-full gap-2">
                    <Label for="name">name</Label>
                    <Input
                        id="name"
                        name="name"
                        type="text"
                        :default-value="food_package.data.name"
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        placeholder="Food package name"
                    />
                    <InputError :message="errors.name" />
                </div>
                <div class="grid w-full gap-2">
                    <Label for="description">Description</Label>
                    <Textarea
                        id="description"
                        name="description"
                        type="textarea"
                        :default-value="food_package.data.description"
                        required
                        autofocus
                        :tabindex="2"
                        autocomplete="description"
                        placeholder="Description"
                    />
                    <InputError :message="errors.description" />
                </div>

                <div class="flex flex-col items-center gap-4">
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-show="recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                    </Transition>

                    <Button variant="secondary" :disabled="processing" class="w-full">
                        <span v-if="edit">Save</span>
                        <span v-if="!edit">Create</span>
                    </Button>
                </div>
                <Link :href="FoodPackageController.index().url" variant="outline" :as="Button"> Back </Link>
            </Form>
        </div>
    </AppLayout>
</template>
