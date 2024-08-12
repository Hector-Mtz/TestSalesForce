<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref} from 'vue';
//Modales
import ModalNewSede from './Modals/ModalNewSede.vue';
import ModalProductosInteres from './Modals/ModalProductosInteres.vue';
import ModalOrigen from './Modals/ModalOrigen.vue';
import ModalCampanaCanal from './Modals/ModalCampanaCanal.vue';
import ModalIdioma from './Modals/ModalIdioma.vue';
import ModalMontoE from './Modals/ModalMontoE.vue';
import ModalBusquedaTerreno from './Modals/ModalBusquedaTerreno.vue';
import ModalInversion from './Modals/ModalInversion.vue';
import ModalFormaContacto from './Modals/ModalFormaContacto.vue';

const props = defineProps({
    sedes:Object,
    productos:Object,
    origenes:Object,
    campana_canales:Object,
    idiomas:Object,
    montos_enganches:Object,
    busqueda_terrenos:Object,
    inversiones_al_mes:Object,
    formas_de_contacto:Object
});  

let modalNewSede = ref(false);
let typeSede = ref('new');
let sedeActual = ref(null);

const openModalNewSede = (type, sede) => 
{
    modalNewSede.value = true;
    typeSede.value = type;
    sedeActual.value = sede;
}

const closeModalNewSede = () => 
{
    modalNewSede.value = false;
    typeSede.value = 'new';
    sedeActual.value = null;
}

let modalProducto = ref(false);
let typeProducto = ref('new');
let productoActual = ref(null);
const openModalNewProducto = (type, producto) => 
{
  modalProducto.value = true;
  typeProducto.value = type;
  productoActual.value = producto;
}

const closeModalNewProducto = () => 
{
  modalProducto.value = false;
  typeProducto.value = 'new';
  productoActual.value = null;
}

let modalOrigen = ref(false);
let typeOrigen = ref('new');
let origenActual = ref(null);
const openModalNewOrigen = (type, origen) => 
{
  modalOrigen.value = true;
  typeOrigen.value = type;
  origenActual.value =  origen;
}

const closeModalNewOrigen = () => 
{
  modalOrigen.value = false;
  typeOrigen.value = 'new';
  origenActual.value = null;
}


let modalCamp = ref(false);
let typeCamp = ref('new');
let campActual = ref(null);
const openModalNewCamp = (type, campaña) => 
{
  modalCamp.value = true;
  typeCamp.value = type;
  campActual.value = campaña;
}

const closeModalCamp = () =>
{
    modalCamp.value = false;
    typeCamp.value = 'new';
    campActual.value = null;
}

const modalIdioma = ref(false);
const typeIdioma = ref('new');
const idiomaActual = ref(null);
const openModalIdioma = (type, idioma) => 
{
  modalIdioma.value = true;
  typeIdioma.value = type;
  idiomaActual.value = idioma;
}

const closeModalIdioma = () => 
{
  idiomaActual.value = null;
  modalIdioma.value = false;
  typeIdioma.value = 'new';
}

const modalMontoEncanche = ref(false);
const typeMontoE = ref('new');
const montoEActual = ref(null);

const openMontoEnganche = (type, montoE) => 
{
    modalMontoEncanche.value = true;
    typeMontoE.value = type;
    montoEActual.value = montoE;
}

const closeMontoEnganche = () => 
{
    modalMontoEncanche.value = false;
    typeMontoE.value = 'new';
    montoEActual.value = null;
}

const modalBusquedaT = ref(false);
const typeBusquedaT = ref('new');
const busquedaT = ref(null);

const openBusquedaT = (type, busquedaTe) => 
{
    modalBusquedaT.value = true;
    typeBusquedaT.value = type;
    busquedaT.value = busquedaTe
}

const closeBusquedaT = () => 
{
    modalBusquedaT.value = false;
    typeBusquedaT.value = 'new';
    busquedaT.value = null
}


const modalInversion = ref(false);
const typeInversion= ref('new');
const inversionA = ref(null);
const openInversionAlMes = (type, inversion) =>
{
  modalInversion.value = true;
  typeInversion.value = type;
  inversionA.value = inversion;
}

const closeInversionAlMes = () => 
{
  modalInversion.value = false;
  typeInversion.value = 'new';
  inversionA.value = null;
}

const modalFormaContacto = ref(false);
const typeFormaContacto= ref('new');
const formaContactoA = ref(null);
const openFormaContacto = (type, forma) => 
{
    modalFormaContacto.value = true;
    typeFormaContacto.value = type;
    formaContactoA.value = forma;
}

const closeFormaContacto = () => 
{
    modalFormaContacto.value = false;
    typeFormaContacto.value = 'new';
    formaContactoA.value = null;
}

</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Catálogos
                </h2>
            </div>
        </template>
        <div class="grid grid-cols-3 gap-6 p-4">
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Sedes</h1>
                    <button @click="openModalNewSede('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="sede in sedes" :key="sede.id">
                        <div class="w-1/4">
                            <button @click="openModalNewSede('edit', sede)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{sede.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Productos de interés</h1>
                    <button @click="openModalNewProducto('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="producto in productos" :key="producto.id">
                        <div class="w-1/4">
                            <button @click="openModalNewProducto('edit', producto)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{producto.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Origenes</h1>
                    <button @click="openModalNewOrigen('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="origen in origenes" :key="origen.id">
                        <div class="w-1/4">
                            <button @click="openModalNewOrigen('edit', origen)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{origen.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Campañas / canales</h1>
                    <button @click="openModalNewCamp('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="camana_canal in campana_canales" :key="camana_canal.id">
                        <div class="w-1/4">
                            <button @click="openModalNewCamp('edit', camana_canal)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{camana_canal.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Idiomas</h1>
                    <button @click="openModalIdioma('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="idioma in idiomas" :key="idioma.id">
                        <div class="w-1/4">
                            <button @click="openModalIdioma('edit', idioma)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{idioma.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Montos de encanches</h1>
                    <button @click="openMontoEnganche('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="monto in montos_enganches" :key="monto.id">
                        <div class="w-1/4">
                            <button @click="openMontoEnganche('edit', monto)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{monto.cantidad}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Busqueda de terreno</h1>
                    <button @click="openBusquedaT('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="bt in busqueda_terrenos" :key="bt.id">
                        <div class="w-1/4">
                            <button @click="openBusquedaT('edit', bt)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{bt.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Inversión al mes</h1>
                    <button @click="openInversionAlMes('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="inversion in inversiones_al_mes" :key="inversion.id">
                        <div class="w-1/4">
                            <button @click="openInversionAlMes('edit', inversion)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{inversion.nombre}}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg">
                <div class="flex flex-row justify-around">
                    <h1 class="text-2xl font-semibold">Formas de contacto</h1>
                    <button @click="openFormaContacto('new')" class="px-4 text-white bg-blue-600 rounded-lg">
                        +
                    </button>
                </div>
                <div class="my-2 overflow-y-auto h-96">
                    <div class="flex flex-row justify-center my-1" v-for="forma_contacto in formas_de_contacto" :key="forma_contacto.id">
                        <div class="w-1/4">
                            <button @click="openFormaContacto('edit', forma_contacto)" >
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="w-3/4 text-xl font-semibold">{{forma_contacto.forma}}</p>
                    </div>
                </div>
            </div>
        </div>
        <ModalNewSede :show="modalNewSede" @close="closeModalNewSede" :typeSede="typeSede" :sede="sedeActual" />
        <ModalProductosInteres :show="modalProducto" @close="closeModalNewProducto" :typeProducto="typeProducto" :producto="productoActual" />
        <ModalOrigen :show="modalOrigen" @close="closeModalNewOrigen" :typeOrigen="typeOrigen" :origen="origenActual"  />
        <ModalCampanaCanal :show="modalCamp" @close="closeModalCamp" :typeCamp="typeCamp" :campana="campActual" />
        <ModalIdioma :show="modalIdioma" @close="closeModalIdioma" :typeIdioma="typeIdioma" :idioma="idiomaActual" />
        <ModalMontoE :show="modalMontoEncanche" @close="closeMontoEnganche" :typeMontoE="typeMontoE" :montoE="montoEActual" />
        <ModalBusquedaTerreno :show="modalBusquedaT" @close="closeBusquedaT" :typeBusquedaT="typeBusquedaT" :busquedaT="busquedaT"  />
        <ModalInversion :show="modalInversion" @close="closeInversionAlMes" :typeInversion="typeInversion" :inverion="inversionA" />
        <ModalFormaContacto :show="modalFormaContacto" @close="closeFormaContacto" :typeFormaContacto="typeFormaContacto" :formaContactoA="formaContactoA" />
    </AppLayout>
</template>