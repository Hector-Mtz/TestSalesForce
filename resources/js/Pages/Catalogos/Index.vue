<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref} from 'vue';
//Modales
import ModalNewSede from './Modals/ModalNewSede.vue';
import ModalProductosInteres from './Modals/ModalProductosInteres.vue';
import ModalOrigen from './Modals/ModalOrigen.vue';

const props = defineProps({
    sedes:Object,
    productos:Object,
    origenes:Object,
    campana_canales:Object
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
        </div>
        <ModalNewSede :show="modalNewSede" @close="closeModalNewSede" :typeSede="typeSede" :sede="sedeActual" />
        <ModalProductosInteres :show="modalProducto" @close="closeModalNewProducto" :typeProducto="typeProducto" :producto="productoActual" />
        <ModalOrigen :show="modalOrigen" @close="closeModalNewOrigen" :typeOrigen="typeOrigen" :origen="origenActual"  />
    </AppLayout>
</template>