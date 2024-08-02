<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
//graficas 
import Grafica1 from './Partials/Grafica1.vue';
import Grafica2 from './Partials/Grafica2.vue';
import { reactive, computed } from 'vue'

const props = defineProps({
 prospectos:Object,
 prospectosGraph:Object
});  

const prospectosCalculados = computed(() => 
{
    let cantidadesProspectos = [];

    for (let index = 0; index < props.prospectosGraph.length; index++) 
    {
      if(props.prospectosGraph[index] == props.prospectosGraph[0]) //primero seteamos el primer objeto
      {
         let newObj = {
            year:'',
            Nuevo:0,
            Junk:0,
            Contactado:0,
         }
         
         newObj.year = props.prospectosGraph[index].FechaString;
         cantidadesProspectos.push(newObj);
         switch (props.prospectosGraph[index].status) {
            case 1:
                newObj.Nuevo = props.prospectosGraph[index].contador;
            break;
            case 2:
               newObj.Junkunk = props.prospectosGraph[index].contador;
            break;
            case 3:
               newObj.Contactadoontactado = props.prospectosGraph[index].contador;
            break;
         }
      }
      else
      {
    
      }
    }

    return cantidadesProspectos;
});


let cantidadesProspectos = [];

for (let index = 0; index < props.prospectosGraph.length; index++) 
{
  if(props.prospectosGraph[index] == props.prospectosGraph[0]) //primero seteamos el primer objeto
  {
     let newObj = {
        fecha:'',
        Nuevo:0,
        Junk:0,
        Contactado:0
     }
     
     newObj.fecha = props.prospectosGraph[index].FechaString;
     cantidadesProspectos.push(newObj);
  }
  else
  {
    //falta ver los demas registros
  }
}

console.log(cantidadesProspectos)

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>
        <div class="flex flex-row p-8 ">
            <div class="grid w-3/4 grid-cols-3 col-start-1 col-end-3">
                <!--Primera fila-->
                <div class="col-start-1 col-end-2 row-start-1 row-end-2">
                    <h1 class="text-2xl font-bold">Reportes</h1>
                    <div class="bg-[#091a3e] rounded-lg p-2 my-4">
                        <h1 class="font-bold text-white">Prospectos totales</h1>
                        <h2 class="my-4 text-5xl font-bold text-center text-white">{{prospectos.length}}</h2>
                    </div>
                </div>
                <div class="col-start-2 col-end-3 row-start-1 row-end-2">

                </div>
                <div class="col-start-3 col-end-4 row-start-1 row-end-2">
                    
                </div>
            </div>
            <div class="w-1/4">
               
            </div>
        </div>
        <div class="flex flex-row p-8 gap-x-16">
            <div class="w-1/4 ">
                <h1 class="my-2 text-xl font-semibold ">Etapa de prospectos</h1>
                <Grafica1 :prospectosCalculados="prospectosCalculados" />
            </div>
            <div class="w-1/4 ">
                <h1 class="my-2 text-xl font-semibold">Oportunidades cerradas por sede</h1>
                <Grafica2 />
            </div>
        </div>
    </AppLayout>
</template>
