import { createStore } from 'vuex'

export const store = createStore({
    state: {
        cafes: [],
        bar: [],
        hospital:[],
    },
    mutations: {
        //accede al state y le asigna lo que mande desde la consulta al backend
        AGREGAR_CAFES(state, payload) {
            state.cafes = payload
        },
        AGREGAR_BAR(state, payload) {
            state.bar = payload
        },
        AGREGAR_HOSPITAL(state, payload) {
            state.hospital = payload
        }
    }

});
