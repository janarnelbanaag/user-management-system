<script setup>
import { computed, reactive } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const { props, url } = usePage();

const queryString = url.split("?")[1] || "";
const params = new URLSearchParams(queryString);

const isEdit = computed(() => {
    return params.get("isEdit") === "true" || params.get("addUser") === "true";
});

const isAddUser = computed(() => {
    return params.get("addUser") === "true";
});

const userData = reactive(
    isAddUser.value
        ? {
              first_name: "",
              last_name: "",
              address: "",
              postcode: "",
              phone_number: "",
              email: "",
              username: "",
              password: "",
              role: "user",
          }
        : { ...props.user },
);
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
                            v-model="userData.first_name"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.first_name }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Last Name:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="userData.last_name"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.last_name }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Address:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="userData.address"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.address }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Postcode:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="userData.postcode"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.postcode }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Phone Number:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="userData.phone_number"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.phone_number }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Email:</label>
                    <template v-if="isEdit">
                        <input
                            type="email"
                            v-model="userData.email"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.email }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Username:</label>
                    <template v-if="isEdit">
                        <input
                            type="text"
                            v-model="userData.username"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.username }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Password:</label>
                    <template v-if="isEdit">
                        <input
                            type="password"
                            v-model="userData.password"
                            class="w-full rounded border p-2"
                        />
                    </template>
                    <template v-else>
                        <span>{{ userData.password }}</span>
                    </template>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Role:</label>
                    <template v-if="isEdit">
                        <select
                            v-model="userData.role"
                            class="w-full rounded border p-2"
                        >
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </template>
                    <template v-else>
                        <span>{{ userData.role }}</span>
                    </template>
                </div>

                <div v-if="isEdit" class="mt-6">
                    <button
                        @click="
                            isAddUser
                                ? $inertia.post(route('add'), userData)
                                : $inertia.put(
                                      route('edit', userData.id),
                                      userData,
                                  )
                        "
                        class="rounded bg-blue-500 px-3 py-1 text-white"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
