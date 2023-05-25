<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarApoderado' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Ingresar Apoderado</h3>
                    <hr>
                    <!-- Alerta de Actualización -->
                    <div v-if="showAlert" class="alert alert-info" role="alert">
                        Registro Insertado con éxito! Redirigiendo en {{ countDown }} segundos.
                    </div>
                    <form @submit.prevent="submitForm">

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="nombres">Nombres</label>
                                <input class="form-control form-control-sm" type="text" id="nombres" v-model="nombres">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="primer_apellido">Primer Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="primer_apellido"
                                    v-model="primer_apellido">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="segundo_apellido">Segundo Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="segundo_apellido"
                                    v-model="segundo_apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="ci">CI</label>
                                <input class="form-control form-control-sm" type="text" id="ci" v-model="ci">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input class="form-control form-control-sm" type="date" id="fecha_nacimiento"
                                    v-model="fecha_nacimiento">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label select-label" for="genero">Género</label>
                                <div class="form-check">
                                    <input v-model="genero" class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Femenino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input v-model="genero" class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Masculino
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="direccion">Dirección</label>
                                <input class="form-control form-control-sm" type="text" id="direccion" v-model="direccion">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="celular">Celular</label>
                                <input class="form-control form-control-sm" type="text" id="celular" v-model="celular">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="pin">Pin</label>
                                <input class="form-control form-control-sm" type="text" id="pin" v-model="pin">
                            </div>
                        </div>
                        <hr>
                        <h6>Asignar Estudiante</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <select class="form-control form-control-sm" id="p_estudiante" v-model="id_estudiante">
                                    <option value="">Seleccionar estudiante</option>
                                    <option v-for="estudiante in estudiantes" :value="estudiante.id_estudiante"
                                        :key="estudiante.id_estudiante">
                                        {{ estudiante.nombres }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Enviar</button>
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
            estudiantes: [], // lista de estudiantes
            nombres: '',
            primer_apellido: '',
            segundo_apellido: '',
            ci: '',
            fecha_nacimiento: '',
            genero: '',
            direccion: '',
            celular: '',
            pin: '',
            id_estudiante: '',
            csrfToken: null,
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, // Agregando variable para mensaje de éxito
        };

    },
    mounted() {
        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (csrfTokenElement !== null) {
            this.csrfToken = csrfTokenElement.getAttribute('content');
        }
        this.loadEstudiantes();
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/insertar-persona-apoderado', {
                    nombres: this.nombres,
                    primer_apellido: this.primer_apellido,
                    segundo_apellido: this.segundo_apellido,
                    ci: this.ci,
                    fecha_nacimiento: this.fecha_nacimiento,
                    genero: this.genero,
                    direccion: this.direccion,
                    celular: this.celular,
                    pin: this.pin,
                    id_estudiante: this.id_estudiante,
                }, {
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                });
                this.showAlert = true; // muestra la alerta
                this.countDown = 2; // reinicia el contador
                setInterval(() => {
                    if (this.countDown > 0) {
                        this.countDown--; // decrementa el contador
                    } else {
                        this.$router.push({ name: 'listarApoderado' });
                        location.reload()
                    }
                }, 1000);
            } catch (error) {
                console.error(error);
            }
        },
        async loadEstudiantes() {
            try {
                const response = await axios.get('/api/listar-estudiantes', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    },
                });

                this.estudiantes = response.data.estudiantes; // Asignar los estudiantes a la lista
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>