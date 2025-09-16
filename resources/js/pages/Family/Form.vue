<script setup lang="ts">
import FamilyController from '@/actions/App/Http/Controllers/FamilyController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const { family, edit, food_packages: foodPackageList } = defineProps<{ family: any; edit: boolean; food_packages: any }>();
const form = edit ? FamilyController.update.form(family.data.id) : FamilyController.store.form();

const food_packages = ref(family.data.food_packages ?? []);
const selectedItem = ref(null);
const months = ref(1);

function addItem() {
    if (!selectedItem.value) return;

    const found = foodPackageList.find((i: any) => i.id === selectedItem.value);
    for (let i = 0; i < months.value; i++) {
        food_packages.value.push(found);
    }

    selectedItem.value = null;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Families',
        href: FamilyController.index().url,
    },
    {
        title: edit ? 'Edit' : 'Register',
        href: edit ? FamilyController.edit(family.data.id).url : FamilyController.create().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center gap-4 overflow-x-auto rounded-xl p-4">
            <Form v-bind="form" v-slot="{ errors, processing, recentlySuccessful }" class="flex w-3/6 flex-col gap-6">
                <h2>Representant</h2>
                <div class="flex w-full gap-3">
                    <div class="grid w-full gap-2">
                        <Label for="first_name">First name</Label>
                        <Input
                            id="first-name"
                            name="first_name"
                            type="text"
                            :default-value="family.data.first_name"
                            autofocus
                            :tabindex="1"
                            autocomplete="first_name"
                            placeholder="First name"
                        />
                        <InputError :message="errors.first_name" />
                    </div>
                    <div class="grid w-full gap-2">
                        <Label for="last_name">Last name</Label>
                        <Input
                            id="last-name"
                            name="last_name"
                            type="text"
                            :default-value="family.data.last_name"
                            required
                            autofocus
                            :tabindex="2"
                            autocomplete="last_name"
                            placeholder="Last name"
                        />
                        <InputError :message="errors.last_name" />
                    </div>
                </div>
                <h2>Address</h2>
                <div class="grid gap-2">
                    <Label for="street_name">Street Name</Label>
                    <Input
                        id="street-name"
                        name="street_name"
                        type="text"
                        :default-value="family.data.street_name"
                        required
                        autofocus
                        :tabindex="3"
                        autocomplete="street_name"
                        placeholder="Street Name"
                    />
                    <InputError :message="errors.street_name" />
                </div>
                <div class="grid gap-2">
                    <Label for="zipcode">Zipcode</Label>
                    <Input
                        id="zipcode"
                        name="zipcode"
                        type="text"
                        :default-value="family.data.zipcode"
                        required
                        autofocus
                        minlength="9"
                        maxlength="9"
                        :tabindex="4"
                        autocomplete="zipcode"
                        placeholder="Zipcode"
                    />
                    <InputError :message="errors.zipcode" />
                </div>
                <h2>Contact</h2>
                <div class="grid gap-2">
                    <Label for="phone_number">Phone</Label>
                    <Input
                        id="phone_number"
                        name="phone_number"
                        type="text"
                        :default-value="family.data.phone_number"
                        required
                        autofocus
                        minlength="11"
                        maxlength="11"
                        :tabindex="5"
                        autocomplete="phone_number"
                        placeholder="Phone"
                    />
                    <InputError :message="errors.phone_number" />
                </div>

                <div class="flex items-center gap-3">
                    <Label for="visited">Visited</Label>
                    <Checkbox id="visited" name="visited" :default-value="family.data.visited ? true : false" />
                    <span>Mark if family was visited.</span>
                    <InputError :message="errors.visited" />
                </div>

                <div v-if="!!family.data.visited && edit" class="flex flex-col gap-3">
                    <h2>Family Packages</h2>
                    <div class="flex w-full flex-col gap-4">
                        <div class="flex w-full gap-2">
                            <Select v-model="selectedItem" class="flex-1">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Select a food package" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem v-for="food_package in foodPackageList" :key="food_package.id" :value="food_package.id">
                                            {{ food_package.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>

                            <Label for="months">Months</Label>
                            <Input id="months" name="months" type="number" v-model.number="months" :default-value="1" class="w-20" />

                            <Button @click.prevent="addItem">Add</Button>
                        </div>

                        <div v-for="(food_package, index) in food_packages" :key="food_package.id">
                            <div class="flex items-center gap-2">
                                <span class="flex-1">{{ food_package.name }}</span>
                                <span>{{ food_package.delivery_date }}</span>
                                <Input type="hidden" v-model="food_packages[index].id" :name="`food_packages[${index}][id]`" />

                                <Button variant="destructive" @click.prevent="food_packages.splice(index, 1)">Remove</Button>
                            </div>
                        </div>
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
                <Link :href="FamilyController.index().url" variant="outline" :as="Button"> Back </Link>
            </Form>
        </div>
    </AppLayout>
</template>
