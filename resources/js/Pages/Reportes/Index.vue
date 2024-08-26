<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive, computed, ref, onMounted, watch } from 'vue'
import { pickBy } from "lodash";
import { router, usePage } from '@inertiajs/vue3';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import ShortInput from '@/Components/ShortInput.vue';
import moment from 'moment';
import ModalCheckActivities from './Partials/ModalCheckActivities.vue';

const props = defineProps
({
   valores:Object
});

//Filtros
const params = reactive({
    date1:null,
    date1:null,
    seleccion:'Prospectos',
    searchs: {
        //Prospectos
        'prospectos.nombre': '',
        'prospectos.apellidos': '',
        'prospectos.telefono': '',
        'prospectos.email': '',
        'users.name':'',
        'origenes.nombre':'',
        //Oportunidades
        'prospectos.created_at': '',
        'prospectos.fecha_de_cierre':'',
        'prospectos.probabilidad':'',
        'prospectos.importe':'',
        'status_progress.nombre':'',
        'roles.nombre':'',
        //Actividades con prospecto
        
    },
});

watch(params, () => {
    const clearParams = pickBy({ ...params });
    router.visit(route("reportes"), 
    {
        data: clearParams,
        replace: true,
        preserveScroll: true,
        preserveState: true,
    });
});


let hoy = ref(moment(new Date()));

let showModalAct = ref(false);
let arrayActividades = ref([]);
const openModalAct  = (actividades) => 
{
    arrayActividades.value = actividades;
    showModalAct.value = true;
}

const closeModalAct = () => 
{
    showModalAct.value = false;
    arrayActividades.value = [];
}

</script>
<template>
    <AppLayout title="Reportes">
        <div class="flex flex-row">
            <div class="w-2/12 h-screen p-2 bg-white shadow-sm">
                <div class="flex flex-row justify-evenly">
                    <h1 class="text-xl font-semibold text-center">Reportes</h1>
                    <!--
                    <button class="px-3 text-white bg-blue-500 rounded-full ">
                        +
                    </button>
                    -->
                </div>
                <div class="flex flex-col px-4 my-6 gap-y-4">
                    <div>
                        <button @click="params.seleccion='Prospectos'">
                            Prospectos
                        </button>
                    </div>
                    <div>
                        <button @click="params.seleccion='Oportunidades'">
                            Oportunidades
                        </button>
                    </div>
                    <div>
                        <button @click="params.seleccion='Campañas'">
                            Campañas
                        </button>
                    </div>
                    <div>
                        <button @click="params.seleccion='Actividades por prospecto'">
                            Actividades por prospecto
                        </button>
                    </div>
                    <div>
                        <button @click="params.seleccion='Conteo motivos de descarte'">
                            Conteo motivos de descarte
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-10/12 p-4" >
                <div class="flex flex-row my-2 gap-x-4">
                    <div class="w-48">
                        <VueDatePicker :placeholder="'Fecha inicial'" v-model="params.date1"  :enable-time-picker="false"></VueDatePicker>
                    </div>
                    <div class="w-48">
                        <VueDatePicker :placeholder="'Fecha final'" v-model="params.date2"  :enable-time-picker="false"></VueDatePicker>
                    </div>
                </div>
                <div class="p-4 bg-white rounded-lg">
                    <h3 class="text-xl italic font-bold">{{ params.seleccion }}</h3>
                    <table class="w-full" v-if="params.seleccion == 'Prospectos'">
                        <thead>
                           <tr>
                             <th>
                                <div class="flex flex-col">
                                    Nombre
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.nombre']" class="my-1" />
                                </div>
                            </th>
                             <th>
                                <div class="flex flex-col">
                                    Apellidos
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.apellidos']" class="my-1" />
                                </div>
                            </th>
                             <th>
                                <div class="flex flex-col">
                                    Email 
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.email']" class="my-1" />
                                </div>
                                </th>
                             <th>
                                <div class="flex flex-col">
                                    Teléfono
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.telefono']" class="my-1" />
                                </div>
                            </th>
                             <th>
                                <div class="flex flex-col">
                                    Origen del prospecto
                                    <ShortInput  type="search" v-model="params.searchs['origenes.nombre']" class="my-1" />
                                </div>
                            </th>
                             <th>
                                <div class="flex flex-col">
                                    Propietario del prospecto
                                    <ShortInput  type="search" v-model="params.searchs['users.name']" class="my-1" />
                                </div>
                            </th>
                           </tr>
                        </thead>
                        <tbody> 
                            <tr v-for="valor in valores" :key="valor.id">
                               <td class="text-center">{{valor.nombre}}</td>
                               <td class="text-center">{{valor.apellidos}}</td>
                               <td class="text-center">{{valor.email}}</td>
                               <td class="text-center">{{valor.telefono}}</td>
                               <td class="text-center">{{valor.origen_name}}</td>
                               <td class="text-center">{{valor.full_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-full" v-if="params.seleccion == 'Oportunidades'">
                        <thead>
                            <tr>
                              <th>
                                 <div class="flex flex-col">
                                     Funcion del propietario
                                     <ShortInput  type="search" v-model="params.searchs['roles.nombre']" class="my-1" />
                                 </div>
                             </th>
                              <th>
                                 <div class="flex flex-col">
                                     Propietario de oportunidad
                                     <ShortInput  type="search" v-model="params.searchs['users.name']" class="my-1" />
                                 </div>
                             </th>
                              <th>
                                 <div class="flex flex-col">
                                     Nombre de la oportunidad
                                     <ShortInput  type="search" v-model="params.searchs['prospectos.nombre']" class="my-1" />
                                 </div>
                                 </th>
                              <th>
                                 <div class="flex flex-col">
                                     Etapa
                                     <ShortInput  type="search" v-model="params.searchs['status_progress.nombre']" class="my-1" />
                                 </div>
                             </th>
                              <th>
                                 <div class="flex flex-col">
                                     Importe
                                     <ShortInput  type="search" v-model="params.searchs['prospectos.importe']" class="my-1" />
                                 </div>
                             </th>
                              <th>
                                 <div class="flex flex-col">
                                     Probabilidad (%)
                                     <ShortInput  type="search" v-model="params.searchs['prospectos.probabilidad']" class="my-1" />
                                 </div>
                             </th>
                             <th>
                                <div class="flex flex-col">
                                    Aniguedad
                                </div>
                             </th>
                             <th>
                                <div class="flex flex-col">
                                    Fecha de cierre
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.fecha_de_cierre']" class="my-1" />
                                </div>
                             </th>
                             <th>
                                <div class="flex flex-col">
                                    Fecha de creación
                                    <ShortInput  type="search" v-model="params.searchs['prospectos.created_at']" class="my-1" />
                                </div>
                             </th>
                            </tr>
                         </thead>
                         <tbody>
                            <tr v-for="valor in valores" :key="valor.id">
                                <td class="text-center">{{valor.funcion}}</td>
                                <td class="text-center">{{valor.full_name}}</td>
                                <td class="text-center">{{valor.nombre + ' ' + valor.apellidos}}</td>
                                <td class="text-center">{{valor.status_name}}</td>
                                <td class="text-center">
                                    <p v-if="valor.importe !== null">
                                        {{valor.importe}}
                                    </p>
                                    <p v-else>
                                       0
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p v-if="valor.probabilidad !== null">
                                        {{valor.probabilidad}}
                                    </p>
                                    <p v-else>
                                       0
                                    </p>
                                </td>
                                <td class="text-center">
                                    {{  (hoy).diff(moment(valor.date),'days') }} días
                                </td>
                                <td class="text-center">
                                    {{ valor.fecha_de_cierre }}
                                </td>
                                <td class="text-center">
                                    {{ valor.date }}
                                </td>
                            </tr>
                         </tbody>
                    </table>
                    <table class="w-full" v-if="params.seleccion == 'Actividades por prospecto'">
                       <thead>
                          <tr>
                            <th>Prospecto</th>
                            <th>Cantidad de actividades</th>
                          </tr>
                       </thead>
                       <tbody>
                          <tr v-for="valor in valores" :key="valor.id">
                             <td class="text-center">
                                {{valor.nombre + ' ' + valor.apellidos}}
                            </td>
                             <td class="text-center">
                                <button v-if="valor.tareas" @click="openModalAct(valor.tareas)" class="p-2 px-4 text-xl font-semibold text-white bg-blue-600 rounded-full">
                                    {{valor.tareas.length}}
                                </button>
                             </td>
                          </tr>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
        <ModalCheckActivities :show="showModalAct" @close="closeModalAct" :arrayActividades="arrayActividades" />
    </AppLayout>
</template>