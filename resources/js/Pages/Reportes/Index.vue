<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({

});
</script>
<template>
    <AppLayout title="Reportes">
        <div class="w-2/12 p-2 bg-white shadow-sm ">
            <div class="flex flex-row justify-evenly">
                <h1 class="text-xl font-semibold text-center">Reportes</h1>
                <button class="px-3 text-white bg-blue-500 rounded-full ">
                    +
                </button>
            </div>
            <div class="px-4 my-4">
                <div>
                    Prospectos
                </div>
                <div>
                    Oportunidades
                </div>
                <div>
                    Actividades con prospecto
                </div>
                <div>
                    Conteo motivos de descarte
                </div>
            </div>
        </div>
    </AppLayout>
</template>