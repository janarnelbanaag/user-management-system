<script setup>
import { router, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    email: "",
    password: "",
});

const submit = async () => {
    try {
        const response = await axios.post("/auth/login", {
            email: form.email,
            password: form.password,
        });

        if (response.data.data.token) {
            localStorage.setItem("auth_token", response.data.data.token);
            localStorage.setItem(
                "user",
                JSON.stringify(response.data.data.user),
            );
            console.log("Login successful!");

            router.get("/dashboard");
        }
    } catch (error) {
        console.error("Login failed:", error.response.data.error);
        form.errors.error = error.response.data.error;
    }
};
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    class="ms-4 bg-green-500 hover:bg-green-700 focus:bg-green-700 active:bg-green-900"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>

            <div v-if="form.errors.error" class="mt-4 text-sm text-red-500">
                {{ form.errors.error }}
            </div>
        </form>
    </GuestLayout>
</template>
