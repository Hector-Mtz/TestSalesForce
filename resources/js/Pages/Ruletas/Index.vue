<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
//importar modales
import ModalNewRuleta from './Modals/ModalNewRuleta.vue';
//paginacion
import PaginationAxios from '@/Components/PaginationAxios.vue'

const props = defineProps({
    sedes:Object,
    asignaciones:Object,
    producto_interes:Object,

    ruletas_padre:Object,
    ruletas_sede:Object
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

//funciones paginacion
const changePagRuletaPadre = () => 
{

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
        <div class="flex flex-row gap-4 p-8">
            <div class="w-1/2 p-2 bg-white rounded-lg shadow-lg">
              <h1 class="text-xl font-bold">Ruletas padre</h1>
              <div class="mt-2">
                <table class="w-full">
                    <thead class="border-b boderd-2">
                        <tr>
                            <th>Nombre de ruleta</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="ruleta_padre in ruletas_padre.data" :key="ruleta_padre.id">
                        <td class="py-2 text-center">
                            <button class="font-bold text-blue-600">
                                {{ruleta_padre.nombre}}
                            </button>
                        </td>
                      </tr>
                    </tbody>
                </table>
                <PaginationAxios :pagination="ruletas_padre" @loadPage="changePagRuletaPadre" />
              </div>
            </div>
            <div class="w-1/2 p-2 bg-white rounded-lg shadow-lg">
                <h1 class="text-xl font-bold">Ruletas por sede</h1>
                <div class="mt-2">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>
                                    Nombre de ruleta
                                </th>
                                <th>
                                    Tipo de asignación
                                </th>
                                <th>
                                    Ruleta padre
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ruleta_sed in ruletas_sede.data" :key="ruleta_sed.id" >
                                <td class="text-center">
                                    <button class="font-bold text-blue-600">
                                        {{ ruleta_sed.nombre }}
                                    </button>
                                </td>
                                <td class="text-center"> 
                                    {{ ruleta_sed.asignacion }}
                                </td>
                                <td class="text-center">
                                    {{ ruleta_sed.ruleta_padre }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <ModalNewRuleta :show="showModalNewRuleta" 
        :sedes="sedes"
        :asignaciones="asignaciones"
        :producto_interes="producto_interes"
        @close="closeModalNewRuleta" />
    </AppLayout>
</template>