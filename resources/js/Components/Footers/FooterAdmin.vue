<template>
    <footer class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <hr class="mb-4 border-gray-300" />
            <div
                class="flex flex-wrap items-center md:justify-between justify-center"
            >
                <!-- Kiri -->
                <div class="w-full md:w-4/12 px-4">
                    <div
                        class="text-sm text-gray-600 font-semibold py-1 text-center md:text-left"
                    >
                        Copyright © {{ date }}
                        <a
                            href="https://www.creative-tim.com?ref=vn-footer-admin"
                            class="text-gray-600 hover:text-gray-800 font-semibold"
                        >
                            Creative Tim
                        </a>
                    </div>
                </div>

                <!-- Kanan -->
                <div class="w-full md:w-8/12 px-4">
                    <ul
                        class="flex flex-wrap list-none md:justify-end justify-center gap-3"
                    >
                        <li>
                            <a
                                href="https://www.creative-tim.com?ref=vn-footer-admin"
                                class="text-gray-600 hover:text-gray-800 text-sm font-semibold"
                            >
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a
                                href="https://www.creative-tim.com/presentation?ref=vn-footer-admin"
                                class="text-gray-600 hover:text-gray-800 text-sm font-semibold"
                            >
                                About Us
                            </a>
                        </li>
                        <li>
                            <a
                                href="http://blog.creative-tim.com?ref=vn-footer-admin"
                                class="text-gray-600 hover:text-gray-800 text-sm font-semibold"
                            >
                                Blog
                            </a>
                        </li>
                        <li>
                            <a
                                href="https://github.com/creativetimofficial/vue-notus/blob/main/LICENSE.md?ref=vn-footer-admin"
                                class="text-gray-600 hover:text-gray-800 text-sm font-semibold"
                            >
                                MIT License
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            date: new Date().getFullYear(),
        };
    },
};
</script>
