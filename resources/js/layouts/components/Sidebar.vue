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
                    class="nav-link text-white"><span>Estudiantes</span></router-link>
            </li>
            <li>
                <router-link :to="{ name: 'listarChofer' }" class="nav-link text-white"><span>Choferes</span></router-link>
                <ul>
                    <li>
                        <router-link :to="{ name: 'listarTransporte' }"
                            class="nav-link text-white"><span>Trasporte</span></router-link>
                    </li>
                </ul>
            </li>
            <li>
                <router-link :to="{ name: 'listarApoderado' }"
                    class="nav-link text-white"><span>Apoderados</span></router-link>
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

 