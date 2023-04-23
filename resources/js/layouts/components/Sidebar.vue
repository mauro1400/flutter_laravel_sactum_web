<template>
    <!-- Sidebar -->
    <div class="d-flex flex-column sidebar sflex-shrink-0 p-3 text-bg-dark">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <router-link :to="{ name: 'listarEstudiante' }"
                    class="nav-link text-white"><span>Estudiante</span></router-link>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data() {
        return {}
    },
    methods: {},
    created() {
    },
    computed: {},
};
</script>

 