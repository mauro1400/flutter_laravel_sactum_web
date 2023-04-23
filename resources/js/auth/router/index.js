export default [
    {
        name: 'login',
        path: '/login',
        component: () => import('../components/LoginForm.vue'),
        meta: {
            title: 'Iniciar Sesión',
            middleware: 'guest',
        }
    },
]