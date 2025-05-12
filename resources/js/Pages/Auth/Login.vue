<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ms-2 text-sm text-primary">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-300 hover:text-secondary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4 bg-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
        <!-- Google Login button -->

        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-4 text-gray-500">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>


        <div class="flex items-center justify-center">
            <a
                href="/auth/google/redirect"
                class="inline-flex items-center px-6 py-3 bg-secondary text-white font-bold rounded-2xl shadow-md hover:bg-primary transition duration-300"
            >
                <!-- Google icon -->
                <svg class="w-6 h-6 mr-3" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.9 0 7.4 1.4 10.1 4l7.5-7.5C36.9 1.7 30.8 0 24 0 14.8 0 6.7 5.6 2.7 13.7l8.7 6.8C13.4 14.8 18.2 9.5 24 9.5z"/>
                    <path fill="white" d="M46.5 24.5c0-1.5-.1-2.9-.4-4.3H24v8.2h12.7c-1.3 4-4.9 7-9.2 7-5.5 0-10-4.5-10-10s4.5-10 10-10c2.4 0 4.6.9 6.3 2.3l6.2-6.2C35.9 8.3 30.3 6 24 6 14.8 6 7 13.8 7 24s7.8 18 17 18c9.2 0 16.5-7.3 16.5-16.5z"/>
                </svg>
                Login with Google
            </a>
        </div>


    </AuthenticationCard>
</template>
