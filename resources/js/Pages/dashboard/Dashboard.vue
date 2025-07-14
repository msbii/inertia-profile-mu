<script setup>
import CardLineChart from "@/Components/Cards/CardLineChart.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import CardPageVisits from "@/Components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/Components/Cards/CardSocialTraffic.vue";
import AdminLayout from "@/shared/Admin.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";

import { onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Chart from "chart.js/auto";

const lineCanvas = ref(null);
let chartInstance = null;

const { props } = usePage();
const totalUsers = props.totalUsers;
const totalPosts = props.totalPosts;
const totalKajians = props.totalKajians;

// onMounted(async () => {
//     const res = await fetch("/api/visitor-stats");
//     const data = await res.json();

//     chartInstance = new Chart(lineCanvas.value.getContext("2d"), {
//         type: "line",
//         data: {
//             labels: data.labels,
//             datasets: [
//                 {
//                     label: "Visitors",
//                     data: data.data,
//                     borderColor: "rgba(75, 192, 192, 1)",
//                     backgroundColor: "rgba(75, 192, 192, 0.2)",
//                     borderWidth: 2,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             plugins: {
//                 legend: {
//                     display: true,
//                     position: "top",
//                 },
//             },
//         },
//     });
// });

onMounted(() => {
    const lineCtx = document.getElementById("lineChart").getContext("2d");
    new Chart(lineCtx, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
            datasets: [
                {
                    label: "Contoh Data",
                    data: [10, 20, 15, 30, 25, 40],
                    borderColor: "rgba(75, 192, 192, 1)",
                    tension: 0.3,
                },
            ],
        },
    });

    const pieCtx = document.getElementById("pieChart").getContext("2d");
    new Chart(pieCtx, {
        type: "pie",
        data: {
            labels: ["Posts", "Kajian", "Users"],
            datasets: [
                {
                    label: "Data Total",
                    data: [totalPosts, totalKajians, totalUsers],
                    backgroundColor: ["#36A2EB", "#FFCE56", "#FF6384"],
                },
            ],
        },
    });
});

// Inertia layout injection
defineOptions({
    layout: AdminLayout,
});
</script>

<template>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4"></div>
    </div>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4"></div>
    </div>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <h1>Dashboard Analytics</h1>

            <div class="flex flex-nowrap gap-4 my-6">
                <div
                    class="metric flex-1 text-center bg-white rounded shadow p-4"
                >
                    <h3 class="text-3xl font-bold">{{ totalUsers }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <div
                    class="metric flex-1 text-center bg-white rounded shadow p-4"
                >
                    <h3 class="text-3xl font-bold">{{ totalPosts }}</h3>
                    <p>Total Postingan</p>
                </div>
                <div
                    class="metric flex-1 text-center bg-white rounded shadow p-4"
                >
                    <h3 class="text-3xl font-bold">{{ totalKajians }}</h3>
                    <p>Total Kajian</p>
                </div>
            </div>

            <div class="charts grid grid-cols-2 gap-4">
                <canvas id="lineChart" height="100"></canvas>
                <!-- <canvas id="pieChart" height="100"></canvas> -->
            </div>
        </div>
    </div>

    <!-- <header-stats /> -->
    <!-- <div class="flex flex-wrap">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
            <CardLineChart />
        </div>
        <div class="w-full xl:w-4/12 px-4">
            <CardBarChart />
        </div>
        <div class="w-full xl:w-8/12 px-4">
            <CardPageVisits />
        </div>
        <div class="w-full xl:w-4/12 px-4">
            <CardSocialTraffic />
        </div>
    </div> -->
</template>
