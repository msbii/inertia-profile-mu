<script>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const logoUrl = "/img/Logo3.jpg";

export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
                remember: false,
            },
        };
    },
    methods: {
        submit() {
            console.log("yah");
            // this.$inertia.post('/users',data)
            this.$inertia.post("/login", this.form, {
                onSuccess: () => {
                    console.log("Data berhasil disimpan");
                },
                onError: (errors) => {
                    console.error("Terjadi kesalahan:", errors);
                },
            });
        },
    },
};
</script>

<style></style>

<template>
    <div
        class="container d-flex justify-content-center align-items-center vh-100"
    >
        <div class="login-box">
            <div class="login-logo">
                <img
                    :src="`/img/Logo3.jpg`"
                    width="350"
                    height="200"
                    alt="Logo"
                />
                <!-- <img :src="logoUrl" width="350" height="200" alt="Logo" /> -->
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg text-center mb-3">Halaman Login</p>

                    <form @submit.prevent="submit">
                        <div class="form-group mb-3">
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="E-Mail"
                                class="form-control"
                                required
                                autofocus
                            />
                        </div>

                        <div class="form-group mb-3">
                            <input
                                v-model="form.password"
                                type="password"
                                placeholder="Password"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group form-check mb-3">
                            <input
                                type="checkbox"
                                v-model="form.remember"
                                class="form-check-input"
                            />
                            <label class="form-check-label">Remember Me</label>
                        </div>

                        <div class="mb-3">
                            <button
                                type="submit"
                                class="btn btn-success btn-block w-100"
                            >
                                Login
                            </button>
                        </div>
                    </form>

                    <small class="text-center"
                        >Belum punya akun? <a href="/register">Daftar</a></small
                    >
                </div>
            </div>
        </div>
    </div>
</template>
