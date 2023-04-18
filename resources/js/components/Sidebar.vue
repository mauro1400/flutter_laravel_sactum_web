<template>
    <div class="col-md-2 bg-light" style="height: 560px;">
        <ul class="nav flex-column">
            <li>
                <router-link to="/form-estudiante">Formulario de Estudiante</router-link>
            </li>
            <li>
                <router-link to="/estudiantes">Lista de Estudiantes</router-link>
            </li>
            <li class="nav-item">
                <router-link to="">link</router-link>   
            </li>
        </ul>
    </div>
</template>


  
<script>
export default {
    name: 'Sidebar'
}
</script> 