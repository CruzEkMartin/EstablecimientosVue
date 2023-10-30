<template>
   <div class="container my-5">
     <h2>Bares</h2>
 
     <div class="row">
       <div class="col-md-4 mt-4" v-for=" bar in this.bares " v-bind:key="bar.id">
 
         <div class="card">
           <img :src="`storage/${bar.imagen_principal}`" alt="Card del Bar" class="card-img-top">
           <div class="card-body">
             <h3 class="card-title text-primary font-weight-bold">{{ bar.nombre }}</h3>
             <p class="card-text">{{ bar.direccion }}</p>
             <p class="card-text">
               <span class="font-weight-bold">Horario:</span>
               {{ bar.apertura}} - {{ bar.cierre }}
             </p>
 
             <a href="" class="btn btn-primary d-block">Ver Lugar</a>
 
 
           </div>
         </div>
 
       </div>
     </div>
   </div>
 </template>
 
 <script>
 export default {
   data: function () {
     return {
       bares: []
     }
   },
   mounted() {
     axios.get('/api/categorias/bar')
       .then(respuesta => {
         this.bares = respuesta.data;
       })
   }
 }
 </script>
 