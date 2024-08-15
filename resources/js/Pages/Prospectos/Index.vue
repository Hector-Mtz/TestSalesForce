<script setup>
import { ref, reactive, watch, onMounted, onUpdated } from 'vue';
import { pickBy } from "lodash";
import { router, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
//Modales
import ModalNewProspecto from './Modals/ModalNewProspecto.vue';
//Componentes
import PaginationInertia from '@/Components/PaginationInertia.vue';
import InputSearch from '@/Components/InputSearch.vue';
import ShortInput from '@/Components/ShortInput.vue';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const page = usePage()

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
    date1:'',
    date2:'',
    fields: props.filters.fields,
    profile_id:'',
    usuario:''
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

const date = ref();

onMounted(() => 
{
   params.usuario = page.props.auth.user.id;
   params.profile_id = page.props.auth.user.role_id;
});

onUpdated(() => 
{
   params.usuario = page.props.auth.user.id;
   params.profile_id = page.props.auth.user.role_id;
});

</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-around">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Prospectos
                    </h2>
                </div>
                <div v-if="$page.props.auth.user.role_id == 1" class="flex flex-row justify-around px-8 gap-x-4">
                    <div class="w-48" >
                        <VueDatePicker :placeholder="'Fecha inicial'" v-model="params.date1"  :enable-time-picker="false"></VueDatePicker>
                    </div>
                    <div class="w-48">
                        <VueDatePicker :placeholder="'Fecha final'" v-model="params.date2"  :enable-time-picker="false"></VueDatePicker>
                    </div>
                </div>
                <div v-if="$page.props.auth.user.role_id == 1" class="flex flex-row gap-x-10">
                    <InputSearch v-model="params.search" />
                    <button @click="openModalNewProspecto" class="px-4 py-1 text-white bg-blue-600 border rounded-lg">
                        Nuevo
                    </button>
                </div>
                <div v-if="$page.props.auth.user.role_id == 1" class="flex flex-row items-center">
                    <a class="flex flex-row px-2 py-2 text-white bg-green-500 border rounded-lg gap-x-2" :href="route('exporProspectos', params)">
                        Descargar reporte
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V9C21 9.55228 20.5523 10 20 10C19.4477 10 19 9.55228 19 9V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H7C7.55228 21 8 21.4477 8 22C8 22.5523 7.55228 23 7 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM19 12C19.5523 12 20 12.4477 20 13V19H23C23.5523 19 24 19.4477 24 20C24 20.5523 23.5523 21 23 
                            21H19C18.4477 21 18 20.5523 18 20V13C18 12.4477 18.4477 12 19 12ZM11.8137 12.4188C11.4927 11.9693 10.8682 11.8653 10.4188 12.1863C9.96935 12.5073 9.86526 13.1318 10.1863 13.5812L12.2711 16.5L10.1863 19.4188C9.86526 19.8682 9.96935 20.4927 10.4188 20.8137C10.8682 21.1347 11.4927 21.0307 11.8137 20.5812L13.5 18.2205L15.1863 20.5812C15.5073 21.0307 16.1318 21.1347 16.5812 20.8137C17.0307 20.4927 17.1347 19.8682 16.8137 19.4188L14.7289 16.5L16.8137 13.5812C17.1347 13.1318 17.0307 12.5073 16.5812 12.1863C16.1318 11.8653 15.5073 11.9693 15.1863 12.4188L13.5 14.7795L11.8137 12.4188Z" fill="white"/>
                       </svg>
                    </a>
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
<style>
.dp__input
{
    border-radius: 0.5rem;
    border: solid 1px;
}
</style>