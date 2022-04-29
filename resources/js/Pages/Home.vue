<template>
    <Layout>
        <Head title="Welcome" >
            <title>Welcome</title>
        </Head>
        <h1 class="size">Welcome</h1>
        <p>Hello, welcome to your first Inertia app!</p>
        <input type="text">
    </Layout>
</template>

<script>
import Layout from '../Components/Layout/Layout'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head,
        Layout,
    },
    props: {
        user: Object,
    },
}
</script>
