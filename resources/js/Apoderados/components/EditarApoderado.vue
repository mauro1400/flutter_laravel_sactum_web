<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarApoderado' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Apoderado</h3>
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
                                    v-model="apoderado.nombres">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_primer_apellido">Primer Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_primer_apellido"
                                    v-model="apoderado.primer_apellido">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_segundo_apellido">Segundo Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_segundo_apellido"
                                    v-model="apoderado.segundo_apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_ci">CI</label>
                                <input class="form-control form-control-sm" type="text" id="p_ci" v-model="apoderado.ci">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                                <input class="form-control form-control-sm" type="date" id="p_fecha_nacimiento"
                                    v-model="apoderado.fecha_nacimiento">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label select-label" for="p_genero">Género</label>
                                <div class="form-check">
                                    <input v-model="apoderado.genero" class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Femenino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input v-model="apoderado.genero" class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Masculino
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_direccion">Dirección</label>
                                <input class="form-control form-control-sm" type="text" id="p_direccion"
                                    v-model="apoderado.direccion">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_celular">Celular</label>
                                <input class="form-control form-control-sm" type="text" id="p_celular"
                                    v-model="apoderado.celular">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Pin</label>
                                <input class="form-control form-control-sm" type="text" id="p_grado" v-model="apoderado.pin">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_nombres">Estudiante</label>
                                <input class="form-control form-control-sm" type="text" id="p_nombres" v-model="apoderado.id_estudiante">
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
            apoderado: {
                nombres: "",
                primer_apellido: "",
                segundo_apellido: "",
                ci: "",
                fecha_nacimiento: "",
                genero: "",
                direccion: "",
                celular: "",
                pin: "",
                id_estudiante:"",
                
            },
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, // contador para redireccionar
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            await axios.get(`/api/editar-apoderado/${this.$route.params.id_persona}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
            }).then((response) => {
                this.apoderado.nombres = response.data.apoderado.nombres
                this.apoderado.primer_apellido = response.data.apoderado.primer_apellido
                this.apoderado.segundo_apellido = response.data.apoderado.segundo_apellido
                this.apoderado.ci = response.data.apoderado.ci
                this.apoderado.fecha_nacimiento = response.data.apoderado.fecha_nacimiento
                this.apoderado.genero = response.data.apoderado.genero
                this.apoderado.direccion = response.data.apoderado.direccion
                this.apoderado.celular = response.data.apoderado.cel
                this.apoderado.pin = response.data.apoderado.pin
                this.apoderado.id_estudiante = response.data.apoderado.id_estudiante
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm() {
            try {
                const token = localStorage.getItem('token');
                await axios.post(`/api/actualizar-apoderado/${this.$route.params.id_persona}`, {
                    nombres: this.apoderado.nombres,
                    primer_apellido: this.apoderado.primer_apellido,
                    segundo_apellido: this.apoderado.segundo_apellido,
                    ci: this.apoderado.ci,
                    fecha_nacimiento: this.apoderado.fecha_nacimiento,
                    genero: this.apoderado.genero,
                    direccion: this.apoderado.direccion,
                    celular: this.apoderado.celular,
                    pin: this.apoderado.pin,
                    id_estudiante: this.apoderado.id_estudiante,
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
                            this.$router.push({ name: 'listarApoderado' });
                            //location.reload() // redirecciona
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