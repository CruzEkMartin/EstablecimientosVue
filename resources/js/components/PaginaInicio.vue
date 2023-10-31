<template>
    <div>
    <categoria-cafe></categoria-cafe>
    <categoria-bar></categoria-bar>
    <categoria-hospital></categoria-hospital>
</div>
</template>

<script>

import CategoriaCafe from './CategoriaCafe.vue'
import CategoriaBar from './CategoriaBar.vue'
import CategoriaHospital from './CategoriaHospital.vue'



export default {
   
    components: {
        CategoriaCafe,
        CategoriaBar,
        CategoriaHospital
    }
}
    
</script>
