<template>
    <div>
        <Sidebar />
        <div class="pt-16 md:ml-64 bg-blueGray-100 min-h-screen">
            <admin-navbar />
            <!-- <header-stats /> -->
            <div class="px-4">
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
