<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { onMounted, ref } from "vue";

const { props } = usePage();
const flashMessage = ref(props.flash.message);

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post("/login", {
        onSuccess: () => {
            router.get("/dashboard");
        },
        onError: (errors) => {
            console.error("Login failed:", errors);
        },
    });
};

onMounted(() => {
    if (flashMessage.value) {
        setTimeout(() => {
            flashMessage.value = null;
        }, 5000);
    }
});
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
            <div
                v-if="flashMessage"
                class="mt-4 rounded bg-red-100 p-2 text-red-800"
            >
                {{ flashMessage }}
            </div>
        </form>
    </GuestLayout>
</template>
