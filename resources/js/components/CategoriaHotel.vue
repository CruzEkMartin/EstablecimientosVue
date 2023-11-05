<template>
    <div class="container my-5">
      <h2>Hoteles</h2>
  
      <div class="row">
        <div class="col-md-4 mt-4" v-for=" hotel in this.hoteles " v-bind:key="hotel.id">
  
          <div class="card">
            <img :src="`storage/${hotel.imagen_principal}`" alt="Card del Hotel" class="card-img-top">
            <div class="card-body">
              <h3 class="card-title text-primary font-weight-bold">{{ hotel.nombre }}</h3>
              <p class="card-text">{{ hotel.direccion }}</p>
              <p class="card-text">
                <span class="font-weight-bold">Horario:</span>
                {{ hotel.apertura}} - {{ hotel.cierre }}
              </p>
  
              <router-link :to="{name: 'establecimiento', params: { id: hotel.id}}"> <a class="btn btn-primary d-block">Ver Lugar</a></router-link>
  
  
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
 import { store } from '../store'
 
 export default {
   
     //cuando se monte el componente se hace una llamada al backend para obtener los datos de la categoria
     mounted() {
       //consultamos al backend
       axios.get('/api/categorias/hotel')
         .then(respuesta => {
           //mandamos al store (mutations) los datos devueltos, con eso se modifica el state
           store.commit("AGREGAR_HOTEL", respuesta.data);
         })
     },
     computed: {
       hoteles(){
         //se trae los valores del state para trabajarlos en el template
         return store.state.hotel;
       }
     }
 
 
   }
  </script>
  