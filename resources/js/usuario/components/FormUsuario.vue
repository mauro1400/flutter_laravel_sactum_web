<template>
    <div>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="name" v-model="formData.name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" v-model="formData.email">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Mensaje</label>
          <textarea class="form-control" id="message" v-model="formData.message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="submitForm">Enviar</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: {
          name: '',
          email: '',
          message: ''
        }
      };
    },
    methods: {
      submitForm() {
        // Aquí puedes realizar la lógica para enviar los datos del formulario.
        console.log(this.formData);
        // Limpia el formulario después de enviarlo si es necesario.
        this.formData.name = '';
        this.formData.email = '';
        this.formData.message = '';
      }
    }
  };
  </script>
  
  