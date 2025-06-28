<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"));
};
</script>

<template>
    <div
        class="container d-flex justify-content-center align-items-center vh-100"
    >
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input
                                v-model="form.username"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">E-Mail Address</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input
                                v-model="form.password"
                                type="password"
                                class="form-control"
                                required
                            />
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation"
                                >Confirm Password</label
                            >
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                class="form-control"
                                required
                            />
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
