<template>
    <Link :href="to"
          class="flex px-5 py-2"
          :class="{ 'hover:bg-gray-200': isHoverGray, 'items-stretch': isStretch, 'items-center': !isStretch }">
        <slot></slot>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    name: "NavLink",
    components: {
        Link
    },
    props: {
        to: String,
        isHoverGray: {
            type: Boolean,
            default: true
        },
        isStretch: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>

</style>
