<template>
    <div>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-bar></categoria-bar>
        <categoria-hospital></categoria-hospital>
        <categoria-hotel></categoria-hotel>
    </div>
</template>

<script>

import MapaEstablecimientos from './MapaEstablecimientos.vue'
import CategoriaCafe from './CategoriaCafe.vue'
import CategoriaBar from './CategoriaBar.vue'
import CategoriaHospital from './CategoriaHospital.vue'
import CategoriaHotel from './CategoriaHotel.vue'

export default {

    components: {
        MapaEstablecimientos,
        CategoriaCafe,
        CategoriaBar,
        CategoriaHospital,
        CategoriaHotel
    }
}

</script>