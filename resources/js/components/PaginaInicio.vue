<template>
    <div>

        

        
            <router-view v-slot="{ Component }">
                <transition name="fade">
                    <component :is="Component" />
                </transition>

            </router-view>
        
        
    
    </div>
</template>

<script>


export default {

  
    
}

</script>

<style lang="css">
.slide-enter-active,
.slide-leave-active{
    transition: opacity 1s, transform 1s;
}

.slide-enter-from,
.slide-leave-to{
    opacity:0;
    transform: translateX(-30%)
}

.fade-enter-active,
.fade-leave-active{
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
