<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
//graficas 
import Grafica1 from './Partials/Grafica1.vue'
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="flex flex-row p-8 ">
            <div class="grid w-3/4 grid-cols-3 col-start-1 col-end-3">
                <!--Primera fila-->
                <div class="col-start-1 col-end-2 row-start-1 row-end-2">
                    <h1 class="text-2xl font-bold">Reportes</h1>
                    <div class="bg-[#091a3e] rounded-lg p-2">
                        <h1 class="font-bold text-white">Prospectos totales</h1>
                        <h2 class="my-4 text-5xl font-bold text-center text-white">0</h2>
                    </div>
                </div>
                <div class="col-start-2 col-end-3 row-start-1 row-end-2">

                </div>
                <div class="col-start-3 col-end-4 row-start-1 row-end-2">
                    
                </div>
            </div>
            <div class="w-1/4">
               
            </div>
        </div>
        <div class="flex flex-row p-8">
            <div class="w-1/4 ">
                <Grafica1 />
            </div>
        </div>
    </AppLayout>
</template>
