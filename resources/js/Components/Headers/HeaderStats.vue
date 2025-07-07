<template>
    <!-- Header -->
    <div class="relative bg-emerald-600 md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!-- Card stats -->
                <!-- <div class="flex flex-wrap">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="TRAFFIC"
                            statTitle="350,897"
                            statArrow="up"
                            statPercent="3.48"
                            statPercentColor="text-emerald-500"
                            statDescripiron="Since last month"
                            statIconName="far fa-chart-bar"
                            statIconColor="bg-red-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="NEW USERS"
                            statTitle="2,356"
                            statArrow="down"
                            statPercent="3.48"
                            statPercentColor="text-red-500"
                            statDescripiron="Since last week"
                            statIconName="fas fa-chart-pie"
                            statIconColor="bg-orange-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="SALES"
                            statTitle="924"
                            statArrow="down"
                            statPercent="1.10"
                            statPercentColor="text-orange-500"
                            statDescripiron="Since yesterday"
                            statIconName="fas fa-users"
                            statIconColor="bg-pink-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="PERFORMANCE"
                            statTitle="49,65%"
                            statArrow="up"
                            statPercent="12"
                            statPercentColor="text-emerald-500"
                            statDescripiron="Since last month"
                            statIconName="fas fa-percent"
                            statIconColor="bg-emerald-500"
                        />
                    </div>
                </div> -->

                <!-- <div class="flex flex-wrap">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="PENGGUNA"
                            :statTitle="totalUsers.toString()"
                            statArrow="up"
                            statPercent="5.12"
                            statPercentColor="text-emerald-500"
                            statDescripiron="Naik dari bulan lalu"
                            statIconName="fas fa-user"
                            statIconColor="bg-blue-500"
                        />
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="POSTINGAN"
                            :statTitle="totalPosts.toString()"
                            statArrow="up"
                            statPercent="2.85"
                            statPercentColor="text-indigo-500"
                            statDescripiron="Naik dari minggu lalu"
                            statIconName="fas fa-file-alt"
                            statIconColor="bg-green-500"
                        />
                    </div>

                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="KAJIAN"
                            :statTitle="totalKajians.toString()"
                            statArrow="up"
                            statPercent="1.23"
                            statPercentColor="text-pink-500"
                            statDescripiron="Sejak kemarin"
                            statIconName="fas fa-book"
                            statIconColor="bg-pink-500"
                        />
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
import CardStats from "@/Components/Cards/CardStats.vue";

export default {
    components: {
        CardStats,
    },
};
</script>
