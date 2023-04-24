<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarChofer' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Chofer</h3>
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
                                    v-model="chofer.nombres">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_primer_apellido">Primer Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_primer_apellido"
                                    v-model="chofer.primer_apellido">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_segundo_apellido">Segundo Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_segundo_apellido"
                                    v-model="chofer.segundo_apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_ci">CI</label>
                                <input class="form-control form-control-sm" type="text" id="p_ci" v-model="chofer.ci">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                                <input class="form-control form-control-sm" type="date" id="p_fecha_nacimiento"
                                    v-model="chofer.fecha_nacimiento">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label select-label" for="p_genero">Género</label>
                                <div class="form-check">
                                    <input v-model="chofer.genero" class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Femenino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input v-model="chofer.genero" class="form-check-input" type="radio" name="flexRadioDefault"
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
                                    v-model="chofer.direccion">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_celular">Celular</label>
                                <input class="form-control form-control-sm" type="text" id="p_celular"
                                    v-model="chofer.celular">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Pin</label>
                                <input class="form-control form-control-sm" type="text" id="p_grado" v-model="chofer.pin">
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
            chofer: {
                nombres: "",
                primer_apellido: "",
                segundo_apellido: "",
                ci: "",
                fecha_nacimiento: "",
                genero: "",
                direccion: "",
                celular: "",
                pin: "",
            },
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, // contador para redireccionar
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            await axios.get(`/api/editar-chofer/${this.$route.params.id_persona}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
            }).then((response) => {
                this.chofer.nombres = response.data.chofer.nombres
                this.chofer.primer_apellido = response.data.chofer.primer_apellido
                this.chofer.segundo_apellido = response.data.chofer.segundo_apellido
                this.chofer.ci = response.data.chofer.ci
                this.chofer.fecha_nacimiento = response.data.chofer.fecha_nacimiento
                this.chofer.genero = response.data.chofer.genero
                this.chofer.direccion = response.data.chofer.direccion
                this.chofer.celular = response.data.chofer.cel
                this.chofer.pin = response.data.chofer.pin
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm() {
            try {
                const token = localStorage.getItem('token');
                await axios.post(`/api/actualizar-chofer/${this.$route.params.id_persona}`, {
                    nombres: this.chofer.nombres,
                    primer_apellido: this.chofer.primer_apellido,
                    segundo_apellido: this.chofer.segundo_apellido,
                    ci: this.chofer.ci,
                    fecha_nacimiento: this.chofer.fecha_nacimiento,
                    genero: this.chofer.genero,
                    direccion: this.chofer.direccion,
                    celular: this.chofer.celular,
                    pin: this.chofer.pin,
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
                            this.$router.push({ name: 'listarChofer' });
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