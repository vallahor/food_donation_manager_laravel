<script setup lang="ts">
import FamilyController from '@/actions/App/Http/Controllers/FamilyController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/vue3';

const { family, edit } = defineProps<{ family: any; edit: boolean }>();
const form = edit ? FamilyController.update.form(family.data.id) : FamilyController.store.form();

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
            <Form v-bind="form" v-slot="{ errors, processing, recentlySuccessful }" class="flex w-4/6 flex-col gap-6">
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
