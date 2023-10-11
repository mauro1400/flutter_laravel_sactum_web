<template>
    <div>
        <div>
            <b-overlay :show="processing" rounded="sm">
                <hr>
                <router-link :to="{ name: 'listarGrado' }">
                    <button>
                        Volver atrás
                    </button>
                </router-link>
                <hr>
                <h3>Ingresar Grado</h3>
                <hr>
                <!-- Alerta de Actualización -->
                <b-form action="javascript:void(0)" @submit="registrar" method="post">
                    <div>
                        <div>
                            <label for="p_grado">Descripcion Grado</label>
                            <b-form-input type="text" id="p_grado" v-model="grado.grado" :state="!errors.grado && ''"
                                required></b-form-input>
                            <b-form-invalid-feedback v-if="errors.grado">{{ errors.grado[0] }}</b-form-invalid-feedback>
                        </div>
                    </div>
                    <div>
                        <button type="submit" :disabled="processing">{{ processing ? "Agregando Grado..." : "Añadir Grado"
                        }}</button>
                    </div>
                </b-form>
            </b-overlay>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            grado: {
                grado: null,
                estado: null
            },
            processing: false,
            errors: {},
        }
    },
    methods: {
        async registrar() {
            this.processing = true;
            await axios.post('/api/insertar-grado', this.grado).then((response) => {
                this.$swal.fire('Grado Agregado!', '', 'success')
                this.$router.replace({ name: "listarGrado" })
            }).catch(({ response }) => {
                if (response.status === 422) {
                    this.errors = response.data.errors;
                } else if (response.status === 466) {
                    this.errors = response.data.errors;
                }
            }).finally(() => {
                this.processing = false;
            });
        }
    },
};
</script>