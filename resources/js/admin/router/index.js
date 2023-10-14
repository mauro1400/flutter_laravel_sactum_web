export default [
    {
        name: 'admin',
        path: '/admin',
        component: () => import('../components/Admin.vue'),
        meta: {
            title: 'admin',
        }
    },
]


