<template>
    <div>
        <nav class="d-flex flex-row container justify-content-center">
            <a v-for="categoria in categorias"
                v-bind:key="categoria.id"
                class="m-0"
                @click = "seleccionarCategoria(categoria)"
            >
               {{ categoria.nombre }} 
            </a>
        </nav>
    </div>
</template>

<script>
import { store } from '../store'

export default {
    created() {
        axios.get('/api/categorias')
            .then(respuesta => {
                //console.log(respuesta.data);
                store.commit('AGREGAR_CATEGORIAS', respuesta.data)
            })
    },
    computed: {
        categorias() {
            return store.getters.obtenerCategorias;
        }
    },
    methods: {
        seleccionarCategoria(categoria){
            store.commit('SELECCIONAR_CATEGORIA', categoria.data)
            console.log(categoria.slug)
        }
    }
}
</script>

<style scoped>

div{
    background-color: #EBEFF5;
}

nav a{
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    padding: 0.5rem 2rem;
    text-align: center;
    flex: 1;
}

nav a:hover{
    color: white;
    cursor: pointer;
}

nav a:nth-child(1){
    background-color: #45214A;
}

nav a:nth-child(2){
    background-color: #323050;
}

nav a:nth-child(3){
    background-color: #21445B;
}

nav a:nth-child(4){
    background-color: #1A6566;
}

nav a:nth-child(5){
    background-color: #5D8A66;
}

nav a:nth-child(6){
    background-color: #75AA9E;
}

nav a:nth-child(7){
    background-color: #A8C5E5;
}
</style>