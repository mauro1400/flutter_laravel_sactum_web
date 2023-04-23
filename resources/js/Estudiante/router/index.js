export default [
    {
        name: 'listarEstudiante',
        path: '/listarEstudiante',
        component: () => import('../components/ListarEstudiante.vue'),
        meta: {
            title: 'listarEstudiante',
        }
    },
    {
        name: 'editarEstudiante',
        path: '/editarEstudiante',
        component: () => import('../components/EditarEstudiante.vue'),
        meta: {
            title: 'editarEstudiante',
        }
    },
    {
        name: 'ingresarEstudiante',
        path: '/ingresarEstudiante',
        component: () => import('../components/FormEstudiante.vue'),
        meta: {
            title: 'ingresarEstudiante',
        }
    },
]


