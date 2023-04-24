import Vue from 'vue'
import VueRouter from 'vue-router'
import auth from '../auth/router';
import usuario from '../usuario/router';
import estudiante from '../Estudiante/router'
import chofer from '../Choferes/router'
Vue.use(VueRouter)

const home = [
  {
    name: 'home',
    path: '/',
    component: () => import(/* webpackChunkName: "Home" */  '../Home.vue'),
    meta: {
      title: 'Inicio',
      requiresAuth: true,
      middleware: 'auth',
    },
    children: auth.concat(estudiante,usuario,chofer)
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
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    next('/login')
  } else {
    next()
  }
})

export default router
