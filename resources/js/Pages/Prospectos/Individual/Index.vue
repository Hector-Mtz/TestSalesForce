<script setup> 
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
    prospecto:Object
})
</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Prospecto                 
                    </h2>
                    <p class="mt-2 font-semibold">{{ prospecto.nombre + ' '+ prospecto.apellidos }}</p>
                </div>
            </div>
        </template>
    </AppLayout>
</template>