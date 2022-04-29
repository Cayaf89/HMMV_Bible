<template>
    <nav class="relative top-0  w-full flex items-center flex-nowrap justify-start bg-gray-100 shadow-lg py-0 mb-3">
        <div class="container w-full mx-auto flex flex-row flex-wrap-inherit items-stretch justify-start">
            <slot name="nav-brand"></slot>
            <div class="flex items-stretch">
                <slot name="nav-links-left"></slot>
            </div>
            <div class="flex items-stretch ml-auto">
                <slot name="nav-links-right"></slot>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>

</style>
