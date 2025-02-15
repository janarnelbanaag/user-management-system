<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Access the user prop passed from the controller
const { props } = usePage();
const user = computed(() => props.user);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="View User" />

        <div class="mx-auto max-w-2xl p-6">
            <h1 class="mb-4 text-2xl font-bold">User Details</h1>
            <div class="rounded bg-white p-4 shadow">
                <div class="mb-4">
                    <label class="block font-bold">First Name:</label>
                    <span>{{ user.first_name }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Last Name:</label>
                    <span>{{ user.last_name }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Address:</label>
                    <span>{{ user.address }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Postcode:</label>
                    <span>{{ user.postcode }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Phone Number:</label>
                    <span>{{ user.phone_number }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Email:</label>
                    <span>{{ user.email }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Username:</label>
                    <span>{{ user.username }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Password:</label>
                    <span>{{ user.password }}</span>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Role:</label>
                    <span>{{ user.role }}</span>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Add any additional styling as needed */
</style>
