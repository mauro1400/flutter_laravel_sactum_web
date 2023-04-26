export default [
    {
        name: 'listarTransporte',
        path: '/listarTransporte',
        component: () => import('../components/ListarTransporte.vue'),
        meta: {
            title: 'listarTransporte',
        }
    },
    {
        name: 'editarTransporte',
        path: '/editarTransporte',
        component: () => import('../components/EditarTransporte.vue'),
        meta: {
            title: 'editarTransporte',
        }
    },
    {
        name: 'ingresarTransporte',
        path: '/ingresarTransporte',
        component: () => import('../components/FormTransporte.vue'),
        meta: {
            title: 'ingresarTransporte',
        }
    },
]


