<template>
    <div class="container-fluid">
        <section class="gradient-custom">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-4">
                    <router-link :to="{ name: 'listarGrado' }" class="btn btn-primary"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Grado</h3>
                    <hr>                    
                    <form @submit.prevent="updateForm">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="p_grado">Descripcion grado</label>
                                <input class="form-control form-control-sm" type="text" id="p_grado"
                                    v-model="grado.grado" required>
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
            grado :{
                id_grado: null,        
                grado: null,                
                estado: null
            },
            processing: false,
            errors: {},
        };
    },
    async created() {        
        try {
            
            await axios.get(`/api/editar-grado/${this.$route.params.id_grado}`).then((response) => {
                this.grado.id_grado = response.data.grado.id_grado,
                this.grado.grado = response.data.grado.grado,                
                this.grado.estado = response.data.grado.estado                
            });
        } catch (error) {
            console.log(error);
        }
    },
    methods: {
        async updateForm(){
            //try {                
                await axios.post(`/api/actualizar-grado`,this.grado).then((response) => {
                    this.$swal.fire('Grado sido actualizado!', '', 'success')
                    this.$router.replace({ name: "listarGrado" })                                    
                });
            /*} catch (error) {
                console.log(error);
            }*/
        },        
    },
};
</script>