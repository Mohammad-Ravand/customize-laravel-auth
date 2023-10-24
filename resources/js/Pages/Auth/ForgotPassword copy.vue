<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    mobile: '',
});

const submit = () => {
    form.post(route('password.mobile'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your mobile address and we will send you a new password
            that will allow you to login.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="mobile" value="Mobile" />

                <TextInput
                    id="mobile"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.mobile"
                    required
                    aria-placeholder="09124567894"
                    placeholder="09124567894"
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.mobile" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Send Code To Mobile
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
