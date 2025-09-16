<script setup lang="ts">
import FoodPackageController from '@/actions/App/Http/Controllers/FoodPackageController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const { food_package, items: listItems, edit } = defineProps<{ food_package: any; items: any; edit: boolean }>();
const form = edit ? FoodPackageController.update.form(food_package.data.id) : FoodPackageController.store.form();

const items = ref(food_package.data.items ?? []);
const selectedItem = ref(null);

function addItem() {
    if (!selectedItem.value) return;

    const found = listItems.data.find((i: any) => i.id === selectedItem.value);
    if (found && !items.value.find((i: any) => i.id === found.id)) {
        items.value.push(found);
    }

    selectedItem.value = null;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Packages',
        href: FoodPackageController.index().url,
    },
    {
        title: edit ? 'Edit' : 'Register',
        href: edit ? FoodPackageController.edit(food_package.data.id).url : FoodPackageController.create().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <Form v-bind="form" v-slot="{ errors, processing, recentlySuccessful }" class="flex w-4/6 flex-col gap-6">
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
                        autofocus
                        :tabindex="2"
                        autocomplete="description"
                        placeholder="Description"
                    />
                    <InputError :message="errors.description" />
                </div>

                <h2>Packages Items</h2>
                <div class="flex w-full flex-col gap-4">
                    <div class="flex w-full gap-2">
                        <Select v-model="selectedItem" class="flex-1">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Select an item" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="item in listItems.data" :key="item.id" :value="item.id">
                                        {{ item.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>

                        <Button @click.prevent="addItem">Add</Button>
                    </div>

                    <div v-for="(item, index) in items" :key="item.id">
                        <div class="flex items-center gap-2">
                            <span class="flex-1">{{ item.name }}</span>
                            <span>{{ item.quantity_label }}</span>

                            <Input
                                type="number"
                                v-model.number="items[index].package_quantity"
                                :default-value="items[index].package_quantity"
                                :name="`items[${index}][package_quantity]`"
                                class="w-20"
                            />
                            <Input type="hidden" v-model="items[index].id" :name="`items[${index}][id]`" />

                            <Button variant="destructive" @click.prevent="items.splice(index, 1)">Remove</Button>
                        </div>
                        <InputError :message="errors[`items.${index}.package_quantity`]" />
                    </div>
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
