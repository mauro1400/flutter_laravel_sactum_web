<template>
    <div>
        <section>
            <div>
                <div>
                    <router-link :to="{ name: 'listarGrado' }">
                        Volver atrás</router-link>
                    <hr>
                    <h3>Editar Grado</h3>
                    <hr>                    
                    <form @submit.prevent="updateForm">
                        <div>
                            <div>
                                <label for="p_grado">Descripcion grado</label>
                                <input type="text" id="p_grado" v-model="grado.grado" required>
                            </div>
                        </div>                                                
                        <div>
                            <button type="submit">Actualizar Registro</button>
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