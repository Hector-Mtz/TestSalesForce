<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
//importar modales
import ModalNewRuleta from './Modals/ModalNewRuleta.vue';
import ModalRuletaPadre from './Modals/ModalRuletaPadre.vue'
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

const changePagRuletaSede = () => 
{
    
}

//Funciones modales ruletas
let ruleta_padre_act = ref({
    id:'',
    nombre:'',
    activo:'',
    sede:'',
    creado_por:'',
    sede_name:'',
    usuario_nombre:''
});
let watchModalRuletaPadre = ref(false);
const openModalRuletaPadre = (ruletaPadreAct) => 
{
   ruleta_padre_act.value = ruletaPadreAct;
   watchModalRuletaPadre.value = true;
}

const closeModalRuletPadre = () => 
{
    watchModalRuletaPadre.value = false;
    ruleta_padre_act.value = {id:'',
    nombre:'',
    activo:'',
    sede:'',
    creado_por:'',
    sede_name:'',
    usuario_nombre:''};
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
                            <button @click="openModalRuletaPadre(ruleta_padre)" class="font-bold text-blue-600">
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
                    <PaginationAxios :pagination="ruletas_sede" @loadPage="changePagRuletaSede" />
                </div>
            </div>
        </div>
        <ModalNewRuleta :show="showModalNewRuleta" 
        :sedes="sedes"
        :asignaciones="asignaciones"
        :producto_interes="producto_interes"
        @close="closeModalNewRuleta" />

        <ModalRuletaPadre :show="watchModalRuletaPadre" @close="closeModalRuletPadre" 
        :ruleta_padre_act="ruleta_padre_act" :sedes="sedes" :ruletas_sede="ruletas_sede.data" />
        
    </AppLayout>
</template>