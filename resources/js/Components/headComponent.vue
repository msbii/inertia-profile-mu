<script>
import { defineProps } from "vue";

defineProps({
    title: String,
});

const asset = (path) => `/storage/${path}`;
</script>
<template>
    <head>
        <meta charset="utf-8" />
        <!-- <title>Muhammadiyah | {{ title }}</title> -->
        <title>Muhammadiyah |</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/lawyerPack/css/bootstrap.css" />
        <link rel="stylesheet" href="/lawyerPack/css/revolution-slider.css" />
        <link rel="stylesheet" href="/lawyerPack/css/style.css" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Responsive -->
        <link rel="shortcut icon" href="/img/Logo.png" type="image/x-icon" />
        <link rel="icon" href="/img/Logo.png" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
        />
        <link rel="stylesheet" href="/lawyerPack/css/responsive.css" />
    </head>
</template>
