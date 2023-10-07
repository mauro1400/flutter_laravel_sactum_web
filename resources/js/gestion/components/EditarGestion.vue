<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarGestion' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Gestion</h3>
                    <hr>                    
                    <form @submit.prevent="updateForm">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_gestion">Gestion</label>
                                <input class="form-control form-control-sm" type="text" id="p_gestion"
                                    v-model="gestion.gestion" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_periodo">Periodo</label>
                                <input class="form-control form-control-sm" type="text" id="p_periodo"
                                    v-model="gestion.periodo" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_descripcion">Descripcion</label>
                                <input class="form-control form-control-sm" type="text" id="p_descripcion"
                                    v-model="gestion.descripcion_gestion" required>
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
            gestion :{
                id_gestion: null,        
                gestion: null,
                periodo: null,
                descripcion_gestion: null,                
                estado: null
            },
            processing: false,
            errors: {},
        };
    },
    async created() {        
        try {
            
            await axios.get(`/api/editar-gestion/${this.$route.params.id_gestion}`).then((response) => {
                this.gestion.id_gestion = response.data.gestion.id_gestion,
                this.gestion.gestion = response.data.gestion.gestion,
                this.gestion.periodo = response.data.gestion.periodo,
                this.gestion.descripcion_gestion = response.data.gestion.descripcion_gestion,
                this.gestion.estado = response.data.gestion.estado                
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm(){
            try {                
                await axios.post(`/api/actualizar-gestion`,this.gestion).then((response) => {
                    this.$swal.fire('Gestion sido actualizado!', '', 'success')
                    this.$router.replace({ name: "listarGestion" })                                    
                });
            } catch (error) {
                console.log(error);
            }
        },        
    },
};
</script>