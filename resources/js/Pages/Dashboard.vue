<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const users = computed(() => usePage().props.users);
const errorMessage = computed(() => usePage().props.errorMessage);

const deleteUser = (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        Inertia.delete(route("delete", id), {
            onSuccess: () => {
                Inertia.reload();
            },
            onError: (error) => {
                console.error("Deletion failed:", error);
            },
        });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                User Management Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="user in users"
                        :key="user.id"
                        class="rounded-lg bg-white p-4 shadow-md"
                    >
                        <h3 class="text-lg font-semibold">
                            {{ user.first_name }} {{ user.last_name }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            Email: {{ user.email }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Role: {{ user.role }}
                        </p>

                        <div class="mt-4 flex justify-end gap-2">
                            <button
                                @click="$inertia.get(route('view', user.id))"
                                class="rounded-md bg-green-500 px-3 py-1 text-white"
                            >
                                View
                            </button>
                            <button
                                @click="
                                    $inertia.get(
                                        route('view', user.id) + '?isEdit=true',
                                    )
                                "
                                class="rounded-md bg-blue-500 px-3 py-1 text-white"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteUser(user.id)"
                                class="rounded-md bg-red-500 px-3 py-1 text-white"
                            >
                                Delete
                            </button>
                        </div>
                    </div>

                    <div v-if="errorMessage" class="mt-4 text-sm text-red-500">
                        {{ errorMessage }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
