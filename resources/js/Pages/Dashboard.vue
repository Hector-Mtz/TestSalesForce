<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
//graficas 
import Grafica1 from './Partials/Grafica1.vue';
import Grafica2 from './Partials/Grafica2.vue';
import { reactive, computed } from 'vue'

const props = defineProps({
 prospectos:Object,
 prospectosGraph:Object,
 oportunidades_ganadas:Object,
 oportunidades_perdidas:Object,
 prospectos_por_fuente:Object,
 origenes:Object
});  

//data para grafico barraas Etapa de prospectos (DEBE SER AFECTADA POR EL AÑO / MES)
const prospectosCalculados = computed(() => 
{
    let cantidadesProspectos = [];

    if(props.prospectosGraph.length > 0)
    {
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
             cantidadesProspectos.push(newObj);
          }
          else
          {
              //recorremos los objetos existentes para comparar fechas y tipo de status
              let newObj = {
                  year:'',
                  Nuevo:0,
                  Junk:0,
                  Contactado:0,
               };

               for (let index2 = 0; index2 < cantidadesProspectos.length; index2++) 
         {
            const objetoProspecto = cantidadesProspectos[index2];
            if(objetoProspecto.year == props.prospectosGraph[index].FechaString)
            {
               switch (props.prospectosGraph[index].status) 
               {
                  case 1:
                     objetoProspecto.Nuevo += props.prospectosGraph[index].contador;
                  break;
                  case 2:
                    objetoProspecto.Junk += props.prospectosGraph[index].contador;
                  break;
                  case 3:
                    objetoProspecto.Contactadoontactado += props.prospectosGraph[index].contador;
                  break;
               }
            }
            else
            {
              newObj.year = props.prospectosGraph[index].FechaString;
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
              cantidadesProspectos.push(newObj);
            }
               }
          }
        }
    }
    else
    {
        let newObj = {
            year:'',
            Nuevo:0,
            Junk:0,
            Contactado:0,
         };

         cantidadesProspectos.push(newObj);
    }

    return cantidadesProspectos;
});

//data para grafico pastel Prospectos pro fuente
const prospectosPorFuenteCalculados = computed(()=>
{
    let arrayFuentes = [];

    for (let index = 0; index < props.origenes.length; index++) 
    {
        const origen = props.origenes[index];
        let newObj = 
        {
            category:origen.nombre,
            value:0
        }
        arrayFuentes.push(newObj)
    }

    if(props.prospectos_por_fuente.length > 0)
    {
      for (let index2 = 0; index2 < props.prospectos_por_fuente.length; index2++) 
      {
        const prospectos = props.prospectos_por_fuente[index2];
        console.log(prospectos)
        for (let index3 = 0; index3 < arrayFuentes.length; index3++) 
        {
            const fuente = arrayFuentes[index3];
            if(fuente.category == prospectos.nombre)
            { 
               fuente.value = prospectos.contador;
            }     
        }
      }
    }

    return arrayFuentes;
});



</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>
        <div class="flex flex-row p-8 ">
            <div class="grid w-3/4 grid-cols-3 col-start-1 col-end-3 gap-x-4">
                <!--Primera fila-->
                <div class="col-start-1 col-end-2 row-start-1 row-end-2 pt-0">
                    <div class="bg-[#091a3e] rounded-lg p-2 my-4">
                        <h1 class="font-bold text-white">Prospectos totales</h1>
                        <h2 class="my-4 text-5xl font-bold text-center text-white">{{prospectos.length}}</h2>
                    </div>
                </div>
                <div class="col-start-2 col-end-3 row-start-1 row-end-2">
                    <div class="bg-[#091a3e] rounded-lg p-2 my-4">
                        <h1 class="font-bold text-white">Oportunidades ganadas</h1>
                        <h2 class="my-4 text-5xl font-bold text-center text-green-400">
                            {{ oportunidades_ganadas.length }}
                        </h2>
                    </div>
                </div>
                <div class="col-start-3 col-end-4 row-start-1 row-end-2">
                    <div class="bg-[#091a3e] rounded-lg p-2 my-4">
                        <h1 class="font-bold text-white">Oportunidades perdidas</h1>
                        <h2 class="my-4 text-5xl font-bold text-center text-red-400">
                            {{ oportunidades_perdidas.length }}
                        </h2>
                    </div>
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
                <h1 class="my-2 text-xl font-semibold">Prospectos por fuente</h1>
                <Grafica2 :prospectosPorFuenteCalculados="prospectosPorFuenteCalculados" />
            </div>
        </div>
        <div class="flex flex-row p-8 gap-x-16">
            
        </div>
    </AppLayout>
</template>
