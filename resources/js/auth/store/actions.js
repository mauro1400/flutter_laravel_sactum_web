import router from '../../router'

export const login = async ({ commit }) => { 
     // Obtén el token de acceso almacenado en localStorage
  const token = localStorage.getItem('token');

  // Configura el encabezado 'Authorization' con el token
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    return axios.get('/api/persona').then((response) => {
        //si no existe persona
        commit('SET_PERSONA', response.data.data)
        commit('SET_AUTHENTICATED', true)
        console.log("entro aqui 4");
        //router.replace({ name: 'home' })
        router.push({ name: 'home' })
        console.log('Respuesta recibida:', response.data.data);
    }).catch((response) => {    
        console.log("error de entrada no autorizada2");  
        commit('SET_PERSONA', {})
        commit('SET_AUTHENTICATED', false)
    })
}

export const logout = async ({ commit }) => {
    console.log("error de entrada no autorizada");
    commit('SET_PERSONA', {})
    commit('SET_AUTHENTICATED', false)    
}