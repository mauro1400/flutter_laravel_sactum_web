<template>
  <div class="row" style="padding-top: 30px;">
    <div class=" col-md-1">
    </div>
    <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;">
      <div class="card bg-dark text-white" style="border-top-left-radius: 1rem;border-bottom-left-radius:1rem;">
        <div class="card-body">

          <div class="mb-md-5 mt-md-4 pb-5">

            <h2 class="fw-bold mb-2 text-uppercase">Acceso</h2>
            <p class="text-white-50 mb-5">¡Por favor, introduce tu usuario y contraseña!</p>
            <form @submit.prevent="login">

              <div class="form-outline form-white mb-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" class="form-control" v-model="form.email">
              </div>
              <div class="form-outline form-white mb-4">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" class="form-control" v-model="form.password">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-outline-light btn-lg px-5">Iniciar Sesion</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;">
      <img src="/assets/brand/la_salle.png" alt="Descripción de la imagen" class="img-fluid"
        style="border-top-right-radius: 1rem;border-bottom-right-radius:1rem; width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class=" col-md-1">
    </div>
  </div>
</template>

  
<script>

import { mapActions } from "vuex";
import axios from 'axios'
export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      show_password: false,
      procesando: false,
      errors: {},
    }
  },
  methods: {
    ...mapActions({
     signIn: "auth/login",
    }),
    async login() {      
        this.procesando = true;
        this.errors = {}
        await axios.get("/sanctum/csrf-cookie");  
        await axios.post("/api/login", this.form).then(({ data }) => {
          
          localStorage.setItem('token', data.token)
          this.signIn();
          //console.log("entro aqui 2");
        });        
    }
  }
}
</script>
