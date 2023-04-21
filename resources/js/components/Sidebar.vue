<template>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <router-link to="/listar-estudiantes" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Estudiante</span></router-link>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
</template>


  
<script>
export default {
    name: 'Sidebar'
}
</script> 