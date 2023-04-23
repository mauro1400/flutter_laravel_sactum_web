export default [
    {
        name: 'login',
        path: '/',
        component: () => import('../components/LoginForm.vue'),
        meta: {
            title: 'Iniciar Sesión',
        }
    },
]