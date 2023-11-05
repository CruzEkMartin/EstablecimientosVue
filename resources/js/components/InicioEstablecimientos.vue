<template>
    <div>
        <categoria-cafe></categoria-cafe>
        <categoria-bar></categoria-bar>
        <categoria-hospital></categoria-hospital>
        <categoria-hotel></categoria-hotel>
    </div>
</template>

<script>

import CategoriaCafe from './CategoriaCafe.vue'
import CategoriaBar from './CategoriaBar.vue'
import CategoriaHospital from './CategoriaHospital.vue'
import CategoriaHotel from './CategoriaHotel.vue'

export default {

    components: {
        CategoriaCafe,
        CategoriaBar,
        CategoriaHospital,
        CategoriaHotel
    }
}

</script>