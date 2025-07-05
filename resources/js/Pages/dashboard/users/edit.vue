<template>
    <Layout title="Edit Postingan">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold mb-6">Ubah Pengguna</h1>
            <form
                @submit.prevent="submitForm"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                <div>
                    <label for="name" class="block font-medium">Nama</label>
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.name }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.name" class="text-red-500 text-sm">
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <label for="username" class="block font-medium"
                        >Username</label
                    >
                    <input
                        v-model="form.username"
                        type="text"
                        id="username"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.username }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.username" class="text-red-500 text-sm">
                        {{ form.errors.username }}
                    </p>
                </div>

                <div class="form-group mb-4">
                    <label for="role" class="block mb-1 font-semibold"
                        >Role</label
                    >
                    <select
                        id="role"
                        v-model="form.role"
                        class="form-select border rounded px-3 py-2 w-full"
                    >
                        <option value="Pengunjung">Pengunjung</option>
                        <option value="Author">Author</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="is_admin" class="block mb-1 font-semibold"
                        >Is Admin</label
                    >
                    <select
                        id="is_admin"
                        v-model="form.is_admin"
                        class="form-select border rounded px-3 py-2 w-full"
                    >
                        <option :value="0">-</option>
                        <option :value="1">Admin</option>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">
                    Perbarui Pengguna
                </button>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "@/shared/Admin.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import "trix";
import "trix/dist/trix.css";

const props = defineProps({
    post: Object,
});

const form = useForm({
    name: props.post?.name || "",
    username: props.post?.username || "",
    role: props.user?.role || "Pengunjung",
    is_admin: props.user?.is_admin || 0,
});

console.log("KIRIM DATA:", {
    name: form.name,
    username: form.username,
    role: form.role,
    is_admin: form.is_admin,
});

function submitForm() {
    console.log("KIRIM:", {
        name: form.name,
        username: form.username,
        role: form.role,
        is_admin: form.is_admin,
    });

    form.submit("post", `/dashboard/user/${props.post.id}`, {
        data: {
            _method: "put",
            name: form.name,
            username: form.username,
            role: form.role,
            is_admin: form.is_admin,
        },
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            console.log("✅ Post updated!");
        },
        onError: (errors) => {
            console.error("❌ Gagal update:", errors);
        },
    });
}
</script>
