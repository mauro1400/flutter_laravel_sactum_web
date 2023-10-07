<template>
    <div class="container-fluid">
     <div class="card shadow-2-strong card-registration">
     <b-overlay :show="processing" rounded="sm">
        <hr>   
        <router-link :to="{ name: 'listarGrado' }" class="btn btn-primary"
            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
            Volver atrás</router-link>
        <hr>
        <h3>Ingresar Grado</h3>
        <hr>
        <!-- Alerta de Actualización -->
        <b-form  action="javascript:void(0)" @submit="registrar" method="post">
        
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Descripcion Grado</label>
                                <b-form-input class="form-control form-control-sm" type="text" id="p_grado" v-model="grado.grado"
                                :state="!errors.grado && ''" required>
                                </b-form-input>
                                <b-form-invalid-feedback v-if="errors.grado">{{ errors.grado[0] }}</b-form-invalid-feedback>
                            </div>
                        </div>                    
                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" :disabled="processing">
                                {{ processing ? "Agregando Grado..." : "Añadir Grado" }}
                            </button>
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
            grado :{
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