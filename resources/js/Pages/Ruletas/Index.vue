<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
//importar modales
import ModalNewRuleta from './Modals/ModalNewRuleta.vue'

const props = defineProps({
    sedes:Object,
    asignaciones:Object,
    producto_interes:Object,
   });  

let showModalNewRuleta = ref(false);

const openModalNewRuleta = () => 
{
    showModalNewRuleta.value = true;
}

const closeModalNewRuleta = () => 
{
    showModalNewRuleta.value = false;
}
</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Ruletas
                </h2>
                <button @click="openModalNewRuleta" class="px-4 py-1 border rounded-lg">
                    Nueva ruleta
                </button>
            </div>
        </template>
        <div>
            
        </div>
        <ModalNewRuleta :show="showModalNewRuleta" 
        :sedes="sedes"
        :asignaciones="asignaciones"
        :producto_interes="producto_interes"
        @close="closeModalNewRuleta" />
    </AppLayout>
</template>