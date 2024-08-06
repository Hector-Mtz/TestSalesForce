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
                            <div @click="sort('id')" class="flex flex-row items-center gap-x-2">
                                <p  class="my-1">
                                    ID
                                </p>
                                <svg v-if="params.fields && params.fields['prospectos.id'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                  class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                  <path
                                      d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('asignaciones.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p  class="my-1">Asignación</p>
                                    <svg v-if="params.fields && params.fields['asignaciones.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                      class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                      <path
                                          d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                    </svg>
                                </div>
                                <ShortInput  type="search" v-model="params.searchs['asignaciones.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div @click="sort('prospectos.created_at')" class="flex flex-row items-center justify-center gap-x-3">
                                <p class="my-1">Fecha de creación</p>
                                <svg v-if="params.fields && params.fields['prospectos.created_at'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                   class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                   <path
                                       d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                 </svg>
                                 <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                     fill="currentColor">
                                     <path
                                         d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                 </svg>
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('prospectos.nombre')" class="flex flex-row items-center justify-center gap-x-3">                             
                                   <p class="my-1">Nombre completo</p>
                                   <svg v-if="params.fields && params.fields['prospectos.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                      class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                      <path
                                          d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                    </svg>
                                </div>
                                <ShortInput  type="search" v-model="params.searchs['prospectos.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                 <div @click="sort('prospectos.telefono')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Teléfono</p>
                                    <svg v-if="params.fields && params.fields['prospectos.telefono'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div>
                                <ShortInput  type="search" v-model="params.searchs['prospectos.telefono']" class="my-1" />
                            </div>                            
                        </th>
                        <th  class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('sedes.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Sede</p>
                                    <svg v-if="params.fields && params.fields['sedes.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div>
                                <ShortInput  type="search" v-model="params.searchs['sedes.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('producto_de_interes.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Producto de interés</p>
                                    <svg v-if="params.fields && params.fields['producto_de_interes.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div>
                                <ShortInput  type="search" v-model="params.searchs['producto_de_interes.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('prospectos.email')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Email</p>
                                    <svg v-if="params.fields && params.fields['prospectos.email'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div>                              
                                <ShortInput  type="search" v-model="params.searchs['prospectos.email']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('campana_canals.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Campaña / Canal</p>
                                    <svg v-if="params.fields && params.fields['campana_canals.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div>  
                                <ShortInput  type="search" v-model="params.searchs['campana_canals.nombre']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div class="flex flex-col">
                                <div @click="sort('users.name')" class="flex flex-row items-center justify-center gap-x-3">
                                    <p class="my-1">Nombre completo del propietario</p>
                                    <svg v-if="params.fields && params.fields['users.name'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                       class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                       <path
                                           d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                     </svg>
                                     <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                         fill="currentColor">
                                         <path
                                             d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                     </svg>
                                 </div> 
                                <ShortInput  type="search" v-model="params.searchs['users.name']" class="my-1" />
                            </div>
                        </th>
                        <th class="px-2">
                            <div @click="sort('status_progress.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                <p class="my-1">Paso</p>
                                <svg v-if="params.fields && params.fields['status_progress.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                   class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                   <path
                                       d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                 </svg>
                                 <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                     fill="currentColor">
                                     <path
                                         d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                 </svg>
                             </div> 
                        </th>
                        <th class="px-2">
                            <div @click="sort('tipo_prospectos.nombre')" class="flex flex-row items-center justify-center gap-x-3">
                                <p class="my-1">Status</p>
                                <svg v-if="params.fields && params.fields['tipo_prospectos.nombre'] === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                   class="inline w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                   <path
                                       d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                 </svg>
                                 <svg v-else xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 20 20"
                                     fill="currentColor">
                                     <path
                                         d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                 </svg>
                             </div> 
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