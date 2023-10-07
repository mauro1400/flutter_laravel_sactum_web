export default [
    {
        name: 'listarGestion',
        path: '/listarGestion',
        component: () => import('../components/ListarGestion.vue'),
        meta: {
            title: 'listarGestion',
        }
    },
    {
        name: 'editarGestion',
        path: '/editarGestion',
        component: () => import('../components/EditarGestion.vue'),
        meta: {
            title: 'editarGestion',
        }
    },
    {
        name: 'ingresarGestion',
        path: '/ingresarGestion',
        component: () => import('../components/FormGestion.vue'),
        meta: {
            title: 'ingresarGestion',
        }
    },
]


