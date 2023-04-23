<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarEstudiante' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Estudiante</h3>
                    <hr>
                    <!-- Alerta de Actualización -->
                    <div v-if="showAlert" class="alert alert-info" role="alert">
                        Registro Actualizado! Redirigiendo en {{ countDown }} segundos.
                    </div>
                    <!--@submit.prevent="updateForm"-->
                    <form @submit.prevent="updateForm">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_nombres">Nombres</label>
                                <input class="form-control form-control-sm" type="text" id="p_nombres"
                                    v-model="estudiante.nombres">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_primer_apellido">Primer Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_primer_apellido"
                                    v-model="estudiante.primer_apellido">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_segundo_apellido">Segundo Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_segundo_apellido"
                                    v-model="estudiante.segundo_apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_ci">CI</label>
                                <input class="form-control form-control-sm" type="text" id="p_ci" v-model="estudiante.ci">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                                <input class="form-control form-control-sm" type="date" id="p_fecha_nacimiento"
                                    v-model="estudiante.fecha_nacimiento">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label select-label" for="p_genero">Género</label>
                                <select class="select form-control-sm" id="p_genero" v-model="estudiante.genero">
                                    <option value="0">Femenino</option>
                                    <option value="1">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_direccion">Dirección</label>
                                <input class="form-control form-control-sm" type="text" id="p_direccion"
                                    v-model="estudiante.direccion">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_celular">Celular</label>
                                <input class="form-control form-control-sm" type="text" id="p_celular"
                                    v-model="estudiante.celular">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Grado</label>
                                <input class="form-control form-control-sm" type="text" id="p_grado"
                                    v-model="estudiante.grado">
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Actualizar
                                Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import axios from 'axios';
export default {
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
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, // contador para redireccionar
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
                    this.showAlert = true; // muestra la alerta
                    this.countDown = 2; // reinicia el contador
                    setInterval(() => {
                        if (this.countDown > 0) {
                            this.countDown--; // decrementa el contador
                        } else {
                            this.$router.push({ name: 'listarEstudiante' });
                            location.reload() // redirecciona
                        }
                    }, 1000); // actualiza el contador cada segundo
                });
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>