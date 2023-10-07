<template>
    <section class="container-fluid">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h2 class="mb-4 text-center">Listar Estudiantes Transporte</h2>
                                    <hr>                                    
                                    <hr>
                                    <table class="table table-bordered border-primary">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>CI</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>Género</th>
                                                <th>Dirección</th>
                                                <th>Celular</th>
                                                <th>Grado</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="estudiante in estudiantes" :key="estudiante.id_estudiante">
                                                <td>
                                                    <button class="btn btn-primary"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                        @click="eliminarEstudiante(estudiante.id_persona)">
                                                        Eliminar
                                                    </button>                                                   
                                                </td>
                                                <td>{{ estudiante.nombres }}</td>
                                                <td>{{ estudiante.primer_apellido }} {{
                                                    estudiante.segundo_apellido }}</td>
                                                <td>{{ estudiante.ci }}</td>
                                                <td>{{ estudiante.fecha_nacimiento }}</td>
                                                <td>{{ estudiante.genero }}</td>
                                                <td>{{ estudiante.direccion }}</td>
                                                <td>{{ estudiante.celular }}</td>
                                                <td>{{ estudiante.grado }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
  
<script>
import axios from 'axios';
export default {
    data() {
        return {
            estudiantes: [],
        };
    },
    async created() {        
        await axios.get(`/api/listar-transporte-estudiante/${this.$route.params.id_transporte}`).then((response) => {         
            //console.log("valor id_transporte=" + this.props.id_transporte);       
            console.log("entro aqui");
            this.estudiantes = response.data.datosTransportes;
            console.log(this.estudiantes);  
        }).catch(({ response }) => {     
            this.$swal.fire(response.message, "se redireccionará a Inicio!", "error");
            this.$router.replace({ name: "home" });        
        });                               
    },
    methods: {
        async verTransporteEstudiante(id_transporte) {
            
                const token = localStorage.getItem('token');
                await axios.delete(`/api/eliminar-estudiantes/${id_persona}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.estudiantes = this.estudiantes.filter(est => est.id_persona !== id_persona);            
        }
    },
};
</script>
