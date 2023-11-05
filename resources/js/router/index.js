
import {createWebHistory, createRouter} from 'vue-router';
import InicioEstablecimientos from '../components/InicioEstablecimientos.vue'
import MostrarEstablecimiento from '../components/MostrarEstablecimiento.vue'

const routes = [
    {
        path: '/',
        component: InicioEstablecimientos
    },
    {
        path: '/establecimiento/:id',
        name: "establecimiento",
        component: MostrarEstablecimiento
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});


export default router;