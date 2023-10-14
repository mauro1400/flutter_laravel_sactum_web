<template>
    <div class="container">
        <div class="row">
            <!--<b-overlay :show="Boolean(Object.keys($store.state.auth.empresa).length === 0)" rounded="sm">-->
            <div class="col-3">
                <Sidebar />
            </div>
            <div class="col-9">
                <router-view>
                </router-view>
            </div>
        </div>
    </div>
    <!--</b-overlay>-->
</template>
<script>
const Sidebar = () => import(/* webpackChunkName: "Sidebar" */ './layouts/components/Sidebar.vue')

export default {
    components: {
        Sidebar
    },
    data() {
        return {};
    },
}
</script>