<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
//Modales
import ModalNewProspecto from './Modals/ModalNewProspecto.vue';
//Componentes
import PaginationInertia from '@/Components/PaginationInertia.vue';

const props = defineProps({
    prospectos:Object,
    sedes:Object,
    asignaciones:Object,
    producto_interes:Object,
    campana_canal:Object,
    origenes:Object,
    busqueda_terreno:Object,
    inversiones_al_mes:Object,
    idiomas:Object,
    montos_eganche:Object,
    formas_contacto:Object,
    horarios:Object
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
            <div class="p-2 py-4 bg-white rounded-lg">
                <table class="w-full ">
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
                    <tr v-for="prospecto in prospectos.data" :key="prospecto.id">
                        <td class="py-2 text-center">
                            {{ prospecto.id }}
                        </td>
                        <td class="py-2 text-center">
                           {{ prospecto.asignacion_name }}
                        </td>
                        <td class="py-2 text-center">
                           {{ prospecto.created_at.substring(0,10) }}
                        </td>
                        <td class="py-2 text-center">
                           <a class="text-blue-500">
                            {{ prospecto.nombre + ' ' + prospecto.apellidos}}
                           </a>
                        </td>
                        <td class="py-2 text-center">
                            {{ prospecto.telefono }}
                        </td>
                        <td class="py-2 text-center">
                           {{ prospecto.sede_name }}
                        </td>
                        <td class="py-2 text-center">
                          {{ prospecto.productoInteres }}
                        </td>
                        <td class="py-2 text-center">
                            {{ prospecto.email }}
                        </td>
                        <td class="py-2 text-center">
                            {{ prospecto.campanaCanal }}
                        </td>
                        <td class="py-2 text-center">
                            {{ prospecto.userName + ' ' +prospecto.userApP + ' ' + prospecto.userApM }}
                        </td>
                        <td class="py-2 text-center">
                           {{ prospecto.statusP }}
                        </td>
                        <td class="py-2 text-center">
                           {{ prospecto.tipoProspecto }} 
                        </td>
                    </tr>
                   </tbody>
                </table>
                <PaginationInertia :pagination="prospectos" />
            </div>
        </div>
        <div>
            <ModalNewProspecto :show="showModalNewProspecto"
             :asignaciones="asignaciones"
             :campana_canal="campana_canal"
             :origenes="origenes"
             :producto_interes="producto_interes"
             :sedes="sedes"
             :busqueda_terreno="busqueda_terreno"
             :inversiones_al_mes="inversiones_al_mes"
             :idiomas="idiomas"
             :montos_eganche="montos_eganche"
             :formas_contacto="formas_contacto"
             :horarios="horarios"
             @close="closeModalNewProspecto" />
        </div>
    </AppLayout>
</template>