<template>
  <div class="container my-5">
    <h2>Cafés</h2>

    <div class="row">
      <div class="col-md-4 mt-4" v-for=" cafe in this.cafes " v-bind:key="cafe.id">

        <div class="card">
          <img :src="`storage/${cafe.imagen_principal}`" alt="Card del Café" class="card-img-top">
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">{{ cafe.nombre }}</h3>
            <p class="card-text">{{ cafe.direccion }}</p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ cafe.apertura }} - {{ cafe.cierre }}
            </p>

            <router-link :to="{name: 'establecimiento', params: { id: cafe.id}}"> <a class="btn btn-primary d-block">Ver Lugar</a></router-link>


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
      axios.get('/api/categorias/cafe')
        .then(respuesta => {
          //mandamos al store (mutations) los datos devueltos, con eso se modifica el state
          store.commit("AGREGAR_CAFES", respuesta.data);
        })
    },
    computed: {
      cafes(){
        //se trae los valores del state para trabajarlos en el template
        return store.state.cafes;
      }
    }


  }


</script>
