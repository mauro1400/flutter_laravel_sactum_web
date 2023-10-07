export default [
    {
        name: 'listarGrado',
        path: '/listarGrado',
        component: () => import('../components/ListarGrado.vue'),
        meta: {
            title: 'listarGrado',
        }
    },
    {
        name: 'editarGrado',
        path: '/editarGrado',
        component: () => import('../components/EditarGrado.vue'),
        meta: {
            title: 'editarGrado',
        }
    },
    {
        name: 'ingresarGrado',
        path: '/ingresarGrado',
        component: () => import('../components/FormGrado.vue'),
        meta: {
            title: 'ingresarGrado',
        }
    },
]


