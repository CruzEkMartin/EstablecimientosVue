import { createStore } from 'vuex'



//state se relacionan los valores de las consultas al backend y quedan disponibles para su visualización
//mutations para modificar el state ya sea consultando los valores o asignando los cambios
export default createStore({
    state: {
        cafes: []
    },
    mutations: {
        AGREGAR_CAFES(state, cafes){
            state.cafes = cafes;
        }
    },
    actions: {

    },
    modules: {
    }

})