<template>
    <div class="max-w-4xl border-t-primary-400 border-t-4 shadow-xl rounded-b-xl p-5">
        <h1 class="text-center font-bold mb-4" :class="{ [headerSizeClass]: true}">
            <slot name="header"></slot>
        </h1>
        <slot name="body"></slot>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: {
        headerSize: {
            type: [Number, String],
            default: 2
},
    },
    computed: {
        headerSizeClass: () => 'text-' + this.headerSize + 'xl'
    }
}
</script>

<style scoped>

</style>
