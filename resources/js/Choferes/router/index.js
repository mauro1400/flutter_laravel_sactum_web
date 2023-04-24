export default [
    {
        name: 'listarChofer',
        path: '/listarChofer',
        component: () => import('../components/ListarChofer.vue'),
        meta: {
            title: 'listarChofer',
        }
    },
    {
        name: 'editarChofer',
        path: '/editarChofer',
        component: () => import('../components/EditarChofer.vue'),
        meta: {
            title: 'editarChofer',
        }
    },
    {
        name: 'ingresarChofer',
        path: '/ingresarChofer',
        component: () => import('../components/FormChofer.vue'),
        meta: {
            title: 'ingresarChofer',
        }
    },
]


