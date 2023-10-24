<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import {computed} from 'vue';
const props = defineProps({
    roles:{
        type:Array,
        required:true
    }
});

const form = useForm({
    firstName: '',
    lastName: '',
    mobile: '',
    role: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const roleOptions = computed(()=>{
    return props.roles.map(role=>({label: role.name, value:role.id}))
})

</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="firstName" value="firstName" />

                <TextInput
                    id="firstName"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstName"
                    required
                    autofocus
                    autocomplete="firstName"
                />

                <InputError class="mt-2" :message="form.errors.firstName" />
            </div>

            <div>
                <InputLabel for="lastName" value="LastName" />

                <TextInput
                    id="lastName"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastName"
                    required
                    autofocus
                    autocomplete="lastName"
                />

                <InputError class="mt-2" :message="form.errors.lastName" />
            </div>

            <div class="mt-4">
                <InputLabel for="mobile" value="mobile" />

                <TextInput
                    id="mobile"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.mobile"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.mobile" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Select Role" />

                <SelectInput
                    id="email"
                    as="select"
                    class="mt-1 block w-full"
                    v-model="form.role"
                    :options="roleOptions"
                    required
                    autocomplete="username"
                >
                <template #selected>
                    <option value="" >select role</option>
                </template>
                </SelectInput>

                <InputError class="mt-2" :message="form.errors.role" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
