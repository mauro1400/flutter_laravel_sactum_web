<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarTransporteEstudiante' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Ingresar Estudiante</h3>
                    <hr>
                    <!-- Alerta de Actualización -->
                    <div v-if="showAlert" class="alert alert-info" role="alert">
                        Registro Insertado con éxito! Redirigiendo en {{ countDown }} segundos.
                    </div>
                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_nombres">Nombres</label>
                                <input class="form-control form-control-sm" type="text" id="p_nombres" v-model="p_nombres">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_primer_apellido">Primer Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_primer_apellido"
                                    v-model="p_primer_apellido">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_segundo_apellido">Segundo Apellido</label>
                                <input class="form-control form-control-sm" type="text" id="p_segundo_apellido"
                                    v-model="p_segundo_apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_ci">CI</label>
                                <input class="form-control form-control-sm" type="text" id="p_ci" v-model="p_ci">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_fecha_nacimiento">Fecha de Nacimiento</label>
                                <input class="form-control form-control-sm" type="date" id="p_fecha_nacimiento"
                                    v-model="p_fecha_nacimiento">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label select-label" for="p_genero">Género</label>
                                <select class="select form-control-sm" id="p_genero" v-model="p_genero">
                                    <option value="0">Femenino</option>
                                    <option value="1">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_direccion">Dirección</label>
                                <input class="form-control form-control-sm" type="text" id="p_direccion"
                                    v-model="p_direccion">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_celular">Celular</label>
                                <input class="form-control form-control-sm" type="text" id="p_celular" v-model="p_celular">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Grado</label>
                                <input class="form-control form-control-sm" type="text" id="p_grado" v-model="p_grado">
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
            p_nombres: '',
            p_primer_apellido: '',
            p_segundo_apellido: '',
            p_ci: '',
            p_fecha_nacimiento: '',
            p_genero: '',
            p_direccion: '',
            p_celular: '',
            p_grado: '',
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
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/insertar-transporte-estudiante', {
                    p_nombres: this.p_nombres,
                    p_primer_apellido: this.p_primer_apellido,
                    p_segundo_apellido: this.p_segundo_apellido,
                    p_ci: this.p_ci,
                    p_fecha_nacimiento: this.p_fecha_nacimiento,
                    p_genero: this.p_genero,
                    p_direccion: this.p_direccion,
                    p_celular: this.p_celular,
                    p_grado: this.p_grado,
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
                        this.$router.push({ name: 'listarEstudiante' });
                        location.reload()
                    }
                }, 1000);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>