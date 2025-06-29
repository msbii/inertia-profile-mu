<template>
    <div v-if="links.length > 3" class="flex justify-center mt-4 space-x-1">
        <Link
            v-for="(link, index) in links"
            :key="index"
            :href="link.url || ''"
            v-html="link.label"
            class="px-3 py-1 text-sm rounded"
            :class="{
                'bg-blue-500 text-white': link.active,
                'bg-gray-200 text-gray-700': !link.active,
                'cursor-not-allowed pointer-events-none': !link.url,
            }"
        />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>
