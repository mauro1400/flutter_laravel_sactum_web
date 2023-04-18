import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserInfo from './components/UserInfo.vue'
import FormEstudiante from './components/FormEstudiante.vue';
import ListarEstudiante from './components/ListarEstudiante.vue'
 
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
      path: '/estudiantes',
      name: 'estudiantes',
      component: ListarEstudiante,
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
