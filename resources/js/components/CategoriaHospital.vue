<template>
  <div class="container my-5">
    <h2>Hospitales</h2>

    <div class="row">
      <div class="col-md-4 mt-4" v-for=" hospital in this.hospitales " v-bind:key="hospital.id">

        <div class="card">
          <img :src="`storage/${hospital.imagen_principal}`" alt="Card del Bar" class="card-img-top">
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">{{ hospital.nombre }}</h3>
            <p class="card-text">{{ hospital.direccion }}</p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ hospital.apertura}} - {{ hospital.cierre }}
            </p>

            <router-link :to="{name: 'establecimiento', params: { id: hospital.id}}"> <a class="btn btn-primary d-block">Ver Lugar</a></router-link>


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
      axios.get('/api/categorias/hospital')
        .then(respuesta => {
          //mandamos al store (mutations) los datos devueltos, con eso se modifica el state
          store.commit("AGREGAR_HOSPITAL", respuesta.data);
        })
    },
    computed: {
      hospitales(){
        //se trae los valores del state para trabajarlos en el template
        return store.state.hospital;
      }
    }


  }
</script>
