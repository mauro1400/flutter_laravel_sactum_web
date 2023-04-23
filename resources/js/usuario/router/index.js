export default [
    {
        name: 'user',
        path: '/user',
        component: () => import('../components/UserInfo.vue'),
        meta: {
            title: 'Usuario',
        }
    },
]


