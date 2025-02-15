<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Homepage" />
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100"
    >
        <h1 class="mb-6 text-3xl font-bold">User Management App</h1>
        <div class="space-x-4">
            <Link
                :href="route('login')"
                class="rounded bg-blue-500 px-4 py-2 text-white"
                >Login</Link
            >
        </div>
    </div>
</template>
