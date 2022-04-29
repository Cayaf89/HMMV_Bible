<template>
    <main>
        <NavBar>
            <template #nav-brand>
                <NavLink class="mr-5" to="/" :is-hover-gray="false" :is-stretch="true">
                    <img class="h-16" src="../../../images/logo-hmmv-te.jpeg" alt="logo" />
                </NavLink>
            </template>

            <template #nav-links-left>
                <NavLink to="/">
                    Home
                </NavLink>
            </template>
        </NavBar>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>
import NavLink from "../NavBar/NavLink";
import NavBar from "../NavBar/NavBar";

export default {
    components: {
        NavLink,
        NavBar,
    }
}
</script>
