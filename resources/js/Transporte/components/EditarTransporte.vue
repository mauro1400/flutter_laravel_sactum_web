<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarTransporte' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Transporte</h3>
                    <hr>
                    <!-- Alerta de Actualización -->
                    <div v-if="showAlert" class="alert alert-info" role="alert">
                        Registro Actualizado! con éxito! Redirigiendo en {{ countDown }} segundos.
                    </div>
                    <form @submit.prevent="updateForm">

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="id_chofer">Id_chofer</label>
                                <input class="form-control form-control-sm" type="text" id="id_chofer"
                                    v-model="id_chofer">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="modelo">Modelo</label>
                                <input class="form-control form-control-sm" type="text" id="modelo"
                                    v-model="modelo">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="placa">Placa</label>
                                <input class="form-control form-control-sm" type="text" id="placa"
                                    v-model="placa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="estado">Estado</label>
                                <input class="form-control form-control-sm" type="text" id="estado"
                                    v-model="estado">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="cant_persona">Nro de personas</label>
                                <input class="form-control form-control-sm" type="text" id="cant_persona"
                                    v-model="cant_persona">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="descripcion">descripcion</label>
                                <textarea class="form-control form-control-sm" type="text" id="descripcion" rows="3"
                                    v-model="descripcion"></textarea>
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
            id_chofer: '',
            modelo: '',
            placa: '',
            estado: '',
            cant_persona: '',
            descripcion: '',
            showAlert: false, // muestra la alerta de actualización
            countDown: 2, 
        };
    },
    async created() {
        try {
            const token = localStorage.getItem('token');
            await axios.get(`/api/editar-transporte/${this.$route.params.id_transporte}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
            }).then((response) => {
                this.id_chofer = response.data.transporte.id_chofer
                this.modelo = response.data.transporte.modelo
                this.placa = response.data.transporte.placa
                this.estado = response.data.transporte.estado
                this.cant_persona = response.data.transporte.cant_persona
                this.descripcion = response.data.transporte.descripcion
                console.log(this.modelo);
                console.log(this.placa);
                console.log(this.estado);
                console.log(this.cant_persona);
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm() {
            try {
                const token = localStorage.getItem('token');
                await axios.post(`/api/actualizar-transporte/${this.$route.params.id_transporte}`, {
                    id_chofer: this.id_chofer,
                    modelo: this.modelo,
                    placa: this.placa,
                    estado: this.estado,
                    cant_persona: this.cant_persona,
                    descripcion: this.descripcion,
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
                            this.$router.push({ name: 'listarTransporte' });
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