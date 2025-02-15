<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const { props, url } = usePage();

const user = computed(() => props.user);

const isEdit = computed(() => {
    const queryString = url.split("?")[1] || "";
    const params = new URLSearchParams(queryString);
    return params.get("isEdit") === "true";
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="View User" />

        <div class="mx-auto max-w-2xl p-6">
            <h1 class="mb-4 text-2xl font-bold">User Details</h1>
            <div class="rounded bg-white p-4 shadow">
                <div class="mb-4">
                    <label class="block font-bold">First Name:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.first_name"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.first_name }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Last Name:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.last_name"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.last_name }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Address:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.address"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.address }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Postcode:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.postcode"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.postcode }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Phone Number:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.phone_number"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.phone_number }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Email:</label>
                    <template v-if="isEdit">
                        <input
                            type="email"
                            v-model="user.email"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.email }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Username:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="user.username"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.username }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Password:</label>
                    <template v-if="isEdit">
                        <input
                            type="password"
                            v-model="user.password"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ user.password }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Role:</label>
                    <template v-if="isEdit">
                        <select
                            v-model="user.role"
                            class="w-full rounded border p-2"
                        >
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </template>
                    <template v-else>
                        <span>{{ user.role }}</span>
                    </template>
                </div>

                <div v-if="isEdit" class="mt-6">
                    <button
                        @click="$inertia.put(route('edit', user.id), user)"
                        class="rounded bg-blue-500 px-3 py-1 text-white"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
