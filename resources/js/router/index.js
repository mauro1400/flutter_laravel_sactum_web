import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import auth from '../auth/router'
import usuario from '../usuario/router'
import estudiante from '../Estudiante/router'
import chofer from '../Choferes/router'
import apoderado from '../Apoderados/router'
import transporte from '../Transporte/router'
import transporteestudiante from '../transporte_estudiante/router'
import grado from '../grado/router'
import gestion from '../gestion/router'

Vue.use(VueRouter)

const home = [
  {
    path: '',
    redirect: '/login'
  },
  {
    name: 'home',
    path: '/home',
    component: () => import(/* webpackChunkName: "Home" */  '../Home.vue'),
    meta: {
      title: 'Inicio',
      requiresAuth: true,
      middleware: 'auth',
    },
    children: auth.concat(estudiante, usuario, chofer, apoderado, transporte,transporteestudiante,grado,gestion)
  }, {
    name: 'notfoundcomponent',
    path: '*',
    component: () => import(/* webpackChunkName: "NotFoundComponent" */ '../views/NotFoundComponent.vue'),
    meta: {
      title: 'No Encontrado',
    }
  }
]

const routes = auth.concat(home)

var router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title} - ${process.env.APP_NAME}`
  //if (store.state.auth.authenticated) {
  //  next({ name: 'home' })
  //} else {
  //  next()
  //}
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    next('/login')
  } else {
    next()
  }
})

export default router
