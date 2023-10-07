export default [
    {
        name: 'listarTransportes',
        path: '/listarTransportes',
        component: () => import('../components/ListarTransporte.vue'),
        meta: {
            title: 'listarTransportes',
        }
    },    
    {
        name: 'listarTransporteEstudiante',
        path: '/listarTransporteEstudiante/:id_transporte',
        component: () => import('../components/ListarTransporteEstudiante.vue'),
        meta: {
            title: 'listarTransporteEstudiante',
        }
    }
]


