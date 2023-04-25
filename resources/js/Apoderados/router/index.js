export default [
    {
        name: 'listarApoderado',
        path: '/listarApoderado',
        component: () => import('../components/ListarApoderado.vue'),
        meta: {
            title: 'listarApoderado',
        }
    },
    {
        name: 'editarApoderado',
        path: '/editarApoderado',
        component: () => import('../components/EditarApoderado.vue'),
        meta: {
            title: 'editarApoderado',
        }
    },
    {
        name: 'ingresarApoderado',
        path: '/ingresarApoderado',
        component: () => import('../components/FormApoderado.vue'),
        meta: {
            title: 'ingresarApoderado',
        }
    },
]


