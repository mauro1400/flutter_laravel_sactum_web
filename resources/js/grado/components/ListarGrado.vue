<template>
    <section>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <h2>Listar Grado</h2>
                                    <hr>
                                    <div>
                                        <router-link :to="{ name: 'ingresarGrado' }">
                                            Crear Grado
                                        </router-link>
                                    </div>
                                    <hr>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Grado</th>
                                            </tr>
                                        </thead>
                                        <!-- Agregar botón "Eliminar" a la tabla -->
                                        <tbody>
                                            <tr v-for="grado in grados" :key="grado.id_grado">
                                                <td>
                                                    <button @click="eliminarGrado(grado.id_grado)">
                                                        Eliminar
                                                    </button>
                                                    <router-link
                                                        :to="{ name: 'editarGrado', params: { id_grado: grado.id_grado } }">
                                                        Editar
                                                    </router-link>
                                                </td>
                                                <td>{{ grado.grado }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
  
<script>
import axios from 'axios';
export default {
    data() {
        return {
            grados: [],
            processing: false,
            errors: {},
            id_grado: null
        };
    },
    async created() {
        axios.get("/api/listar-grado").then((response) => {
            this.grados = response.data.listaGrados;
            console.log(this.grados);
        }).catch(({ response }) => {
            this.$swal.fire(response.message, "se redireccionará a Inicio!", "error");
            this.$router.replace({ name: "login" });
        }).finally(() => {
            this.processing = false;
        });
    },
    methods: {
        async eliminarGrado(id_grado) {
            console.log(id_grado);
            this.processing = true;
            await axios.get('/api/eliminar-grado/' + id_grado).then((response) => {
                this.$swal.fire('Eliminar Grado!', '', 'success')
                this.grados = this.grados.filter(gra => gra.id_grado !== id_grado);
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
