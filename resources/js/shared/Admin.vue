<template>
    <div>
        <Sidebar />
        <div class="relative md:ml-64 bg-blueGray-100 pt-16">
            <admin-navbar />
            <!-- <header-stats /> -->
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <slot />
                <footer-admin />
            </div>
        </div>
    </div>
</template>
<script>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
// import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";

export default {
    name: "admin-layout",
    components: {
        Sidebar,
        AdminNavbar,
        // HeaderStats,
        FooterAdmin,
    },
};
</script>
