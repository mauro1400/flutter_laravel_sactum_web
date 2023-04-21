<template>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <Sidebar></Sidebar>
            <!-- Main Content -->
            <div class="col-md-10">

                <router-link to="/listar-estudiantes" class="btn btn-primary"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Volver atrás</router-link>
                <h1>Editar Estudiante</h1>
                <!--@submit.prevent="updateForm"-->
                <form @submit.prevent="updateForm">
                    <label for="p_nombres">Nombres</label>
                    <input type="text" id="p_nombres" v-model="estudiante.nombres">
                    <label for="p_primer_apellido">Primer Apellido</label>
                    <input type="text" id="p_primer_apellido" v-model="estudiante.primer_apellido">
                    <label for="p_segundo_apellido">Segundo Apellido</label>
                    <input type="text" id="p_segundo_apellido" v-model="estudiante.segundo_apellido">
                    <label for="p_ci">CI</label>
                    <input type="text" id="p_ci" v-model="estudiante.ci">
                    <label for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="p_fecha_nacimiento" v-model="estudiante.fecha_nacimiento">
                    <label for="p_genero">Género</label>
                    <select id="p_genero" v-model="estudiante.genero">
                        <option value="0">Femenino</option>
                        <option value="1">Masculino</option>
                    </select>
                    <label for="p_direccion">Dirección</label>
                    <input type="text" id="p_direccion" v-model="estudiante.direccion">
                    <label for="p_celular">Celular</label>
                    <input type="text" id="p_celular" v-model="estudiante.celular">
                    <label for="p_grado">Grado</label>
                    <input type="text" id="p_grado" v-model="estudiante.grado">
                    <button type="submit" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Actualizar
                        Registro</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Sidebar from '../Sidebar.vue';
export default {
    components: {
        Sidebar
    },
    data() {
        return {
            estudiante: {
                nombres: "",
                primer_apellido: "",
                segundo_apellido: "",
                ci: "",
                fecha_nacimiento: "",
                genero: "",
                direccion: "",
                celular: "",
                grado: "",
            },
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            await axios.get(`/api/editar-estudiante/${this.$route.params.id_persona}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
            }).then((response) => {
                this.estudiante.nombres = response.data.estudiante.nombres
                this.estudiante.primer_apellido = response.data.estudiante.primer_apellido
                this.estudiante.segundo_apellido = response.data.estudiante.segundo_apellido
                this.estudiante.ci = response.data.estudiante.ci
                this.estudiante.fecha_nacimiento = response.data.estudiante.fecha_nacimiento
                this.estudiante.genero = response.data.estudiante.genero
                this.estudiante.direccion = response.data.estudiante.direccion
                this.estudiante.celular = response.data.estudiante.celular
                this.estudiante.grado = response.data.estudiante.grado
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm() {
            try {
                const token = localStorage.getItem('token');
                await axios.post(`/api/actualizar-estudiantes/${this.$route.params.id_persona}`, {
                    nombres: this.estudiante.nombres,
                    primer_apellido: this.estudiante.primer_apellido,
                    segundo_apellido: this.estudiante.segundo_apellido,
                    ci: this.estudiante.ci,
                    fecha_nacimiento: this.estudiante.fecha_nacimiento,
                    genero: this.estudiante.genero,
                    direccion: this.estudiante.direccion,
                    celular: this.estudiante.celular,
                    grado: this.estudiante.grado,
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    },
                }).then((response) => {
                    this.$router.push('/listar-estudiantes');
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>