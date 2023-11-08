import { createStore } from 'vuex'

export const store = createStore({
    state: {
        cafes: [],
        bar: [],
        hospital: [],
        hotel: [],
        establecimiento: {},
        establecimientos: []
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
        },
        AGREGAR_HOTEL(state, payload) {
            state.hotel = payload
        },
        AGREGAR_ESTABLECIMIENTO(state, payload) {
            state.establecimiento = payload
        },
        AGREGAR_ESTABLECIMIENTOS(state, payload) {
            state.establecimientos = payload
        }
    },
    getters: {
        obtenerEstablecimiento: state => {
            return state.establecimiento
        },
        obtenerImagenes: state => {
            return state.establecimiento.imagenes
        },
        obtenerEstablecimientos : state => {
            return state.establecimientos
        }
    }

});
