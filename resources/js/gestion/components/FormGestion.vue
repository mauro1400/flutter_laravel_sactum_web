<template>
    <div class="container-fluid">
     <div class="card shadow-2-strong card-registration">
     <b-overlay :show="processing" rounded="sm">
        <hr>   
        <router-link :to="{ name: 'listarGestion' }" class="btn btn-primary"
            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
            Volver atrás</router-link>
        <hr>
        <h3>Ingresar Gestion</h3>
        <hr>
        <!-- Alerta de Actualización -->
        <b-form  action="javascript:void(0)" @submit="registrar" method="post">
        
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_gestion">Gestion 1</label>
                                <b-form-input class="form-control form-control-sm" type="text" id="p_gestion" v-model="gestion.gestion"
                                :state="!errors.gestion && ''" required>
                                </b-form-input>
                                <b-form-invalid-feedback v-if="errors.gestion">{{ errors.gestion[0] }}</b-form-invalid-feedback>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_periodo">Periodo</label>
                                <b-form-input class="form-control form-control-sm" type="text" id="p_periodo" v-model="gestion.periodo"
                                :state="!errors.gestion && ''" required>
                                </b-form-input>
                                <b-form-invalid-feedback v-if="errors.gestion">{{ errors.gestion[0] }}</b-form-invalid-feedback>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_descripcion">Descripcion</label>
                                <b-form-input class="form-control form-control-sm" type="text" id="p_descripcion" v-model="gestion.descripcion_gestion"
                                :state="!errors.gestion && ''" required placeholder="Ej: 2003 Periodo 1">
                                </b-form-input>
                                <b-form-invalid-feedback v-if="errors.gestion">{{ errors.gestion[0] }}</b-form-invalid-feedback>
                            </div>
                        </div>                    
                        <div class="col-md-12 mb-4">
                            <button type="submit" class="btn btn-primary"
                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" :disabled="processing">
                                {{ processing ? "Agregando Grado..." : "Añadir Gestion" }}
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
            gestion :{
                gestion: null,
                periodo: null,
                descripcion_gestion: null,
                estado: null
            },
            processing: false,
            errors: {},             
        }
    },    
    methods: {
        async registrar() {
            this.processing = true;
            await axios.post('/api/insertar-gestion', this.gestion).then((response) => {
                this.$swal.fire('Gestion Agregado!', '', 'success')
                this.$router.replace({ name: "listarGestion" })
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