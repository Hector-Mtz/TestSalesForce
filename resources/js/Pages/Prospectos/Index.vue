<script setup>
import { ref, reactive, watch } from 'vue';
import { pickBy } from "lodash";
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
//Modales
import ModalNewProspecto from './Modals/ModalNewProspecto.vue';
//Componentes
import PaginationInertia from '@/Components/PaginationInertia.vue';
import InputSearch from '@/Components/InputSearch.vue';
import ShortInput from '@/Components/ShortInput.vue'

const props = defineProps({
    filters: Object,
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

const params = reactive({
    search: props.filters.search,
    searchs: {
        'asignaciones.nombre': '',
        'sedes.nombre': '',
        'prospectos.nombre': '',
        'prospectos.apellidos': '',
        'prospectos.telefono': '',
        'prospectos.email': '',
        'users.name':'',
        'producto_de_interes.nombre':'',
        'campana_canals.nombre': '',
        ...props.filters.searchs
    },
    fields: props.filters.fields
});

watch(params, () => {
    const clearParams = pickBy({ ...params });
    router.visit(route("prospectos"), 
    {
        data: clearParams,
        replace: true,
        preserveScroll: true,
        preserveState: true,
    });
});

const sort = (field) => {
    if (params.fields === null) {
        params.fields = {};// para que no falle hasOwnProperty
    }
    if (params.fields.hasOwnProperty(field)) {
        params.fields[field] = params.fields[field] === 'asc' ? 'desc' : 'asc';
    } else {
        params.fields[field] = 'asc';
    }

}

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
            <div class="flex flex-row justify-around">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Prospectos
                </h2>
                <div class="flex flex-row gap-x-10">
                    <InputSearch v-model="params.search" />
                    <button @click="openModalNewProspecto" class="px-4 py-1 text-white bg-blue-600 border rounded-lg">
                        Nuevo
                    </button>
                </div>
            </div>
        </template>
        <div class="p-8">
            <div class="p-2 py-4 bg-white rounded-lg">
                <table class="w-full ">
                   <thead>
                     <tr class="border-b-4 border-[#091a3e] ">
                        <th class="px-2">
                            <p @click="sort('id')" class="my-1">
                                ID
                            </p>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Asignación
                                <ShortInput  type="search" v-model="params.searchs['asignaciones.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th >
                            Fecha de creación
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Nombre completo
                                <ShortInput  type="search" v-model="params.searchs['prospectos.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Teléfono
                                <ShortInput  type="search" v-model="params.searchs['prospectos.telefono']" class="my-1" />
                            </div>                            
                        </th>
                        <th  class="px-2">
                            <div class="flex flex-col">
                                Sede
                                <ShortInput  type="search" v-model="params.searchs['sedes.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Producto de interés
                                <ShortInput  type="search" v-model="params.searchs['producto_de_interes.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Email
                                <ShortInput  type="search" v-model="params.searchs['prospectos.email']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Campaña / Canal
                                <ShortInput  type="search" v-model="params.searchs['campana_canals.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                Nombre completo del propietario
                                <ShortInput  type="search" v-model="params.searchs['users.name']" class="my-1" />
                            </div>
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
                           <a :href="'/viewProspecto/'+prospecto.id" class="text-blue-500">
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