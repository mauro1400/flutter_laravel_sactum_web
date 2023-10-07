<template>
    <div>
        <!--<b-overlay :show="Boolean(Object.keys($store.state.auth.empresa).length === 0)" rounded="sm">-->
        <Navbar />
        <Sidebar />
        <router-view>

        </router-view>
    </div>
    <!--</b-overlay>-->
</template>
<script>
const Navbar = () => import(/* webpackChunkName: "Navbar" */ './layouts/components/Navbar.vue')
const Sidebar = () => import(/* webpackChunkName: "Sidebar" */ './layouts/components/Sidebar.vue')

export default {
    components: {
        Navbar,
        Sidebar
    },
    data() {
        return {};
    },
}
</script>