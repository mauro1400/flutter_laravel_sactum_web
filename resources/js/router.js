import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginForm from './components/auth/LoginForm.vue'
import RegisterForm from './components/auth/RegisterForm.vue'
import UserInfo from './components/auth/UserInfo.vue'
import FormEstudiante from './components/Estudiantes/FormEstudiante.vue'
import ListarEstudiante from './components/Estudiantes/ListarEstudiante.vue'
import EditarEstudiantes from './components/Estudiantes/EditarEstudiante.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/login',
      component: LoginForm
    },
    {
      path: '/register',
      component: RegisterForm
    },
    {
      path: '/user',
      component: UserInfo,
      meta: { requiresAuth: true }
    },
    {
      path: '/form-estudiante',
      component: FormEstudiante,
      meta: { requiresAuth: true }
    },
    {
      path: '/listar-estudiantes',
      component: ListarEstudiante,
      meta: { requiresAuth: true }
    },
    {
      path: '/editar-estudiante/:id_persona',
      name: 'editarEstudiante',
      component: EditarEstudiantes,
      meta: { requiresAuth: true }
    },
  ]
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    next('/login')
  } else {
    next()
  }
})

export default router
