<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
//Modales
import ModalNewProspecto from './Modals/ModalNewProspecto.vue';

const props = defineProps({
    sedes:Object,
    asignaciones:Object,
    producto_interes:Object,
    campana_canal:Object,
    origenes:Object
   });  

let showModalNewProspecto = ref(false);
const openModalNewProspecto = () =>
{
  showModalNewProspecto.value = true;
}
const closeModalNewProspecto = () => 
{
    showModalNewProspecto.value = false
}

</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Prospectos
                </h2>
                <button @click="openModalNewProspecto" class="px-4 py-1 border rounded-lg">
                    Nuevo
                </button>
            </div>
        </template>
        <div class="p-8">
            <div class="py-2 bg-white rounded-lg">
                <table class="w-full">
                   <thead>
                     <tr class="border-b-4 border-[#091a3e] ">
                        <th>
                            ID
                        </th>
                        <th>
                            Asignación
                        </th>
                        <th>
                            Fecha de creación
                        </th>
                        <th>
                            Nombre completo
                        </th>
                        <th>
                            Teléfono
                        </th>
                        <th>
                            Sede
                        </th>
                        <th>
                            Producto de interés
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                          Producto de interés
                        </th>
                        <th>
                            Campaña / Canal
                        </th>
                        <th>
                            Nombre completo del propietario
                        </th>
                        <th>
                            Paso
                        </th>
                        <th>
                            Status
                        </th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                        
                    </tr>
                   </tbody>
                </table>
            </div>
        </div>
        <div>
            <ModalNewProspecto :show="showModalNewProspecto"
             :asignaciones="asignaciones"
             :campana_canal="campana_canal"
             :origenes="origenes"
             :producto_interes="producto_interes"
             :sedes="sedes"
             @close="closeModalNewProspecto" />
        </div>
    </AppLayout>
</template>