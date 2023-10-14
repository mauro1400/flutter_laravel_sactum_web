export default [
    {
        name: 'user',
        path: '/user',
        component: () => import('../components/UserInfo.vue'),
        meta: {
            title: 'user',
        }
    },
    {
        name: 'index',
        path: '/index',
        component: () => import('../components/index.vue'),
        children: [
            {
                name: 'listaUsuarios',
                path: '/listaUsuarios',
                component: () => import('../components/ListaUsuarios.vue'),
                meta: {
                    title: 'listaUsuarios',
                }
            }, {
                name: 'formUsuario',
                path: '/formUsuario',
                component: () => import('../components/FormUsuario.vue'),
                meta: {
                    title: 'formUsuario',
                }
            },
        ],
        meta: {
            title: 'index',
        }
    },
]


