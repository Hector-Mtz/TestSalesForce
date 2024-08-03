<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
    sedes:Object
});  
</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Catálogos
                </h2>
            </div>
        </template>
        <div class="grid grid-cols-3 gap-6 p-4">
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Sedes</h1>
                    <button>
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="my-1" v-for="sede in sedes" :key="sede.id">
                        <p class="text-xl">{{sede.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <h1 class="text-2xl font-semibold">Productos de interés</h1>
                <div>
                    
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <h1 class="text-2xl font-semibold">Origenes</h1>
                <div>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>