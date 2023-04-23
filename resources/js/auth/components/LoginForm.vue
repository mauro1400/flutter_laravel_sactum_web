<template>
  <section class="vh-100 gradient-custom">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
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
                  <button type="submit" class="btn btn-outline-light btn-lg px-5">Iniciar Sesion</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

  
<script>
export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/api/login', this.form)
        localStorage.setItem('token', response.data.access_token)
        this.$router.push('/home')
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
  