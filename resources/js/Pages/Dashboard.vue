<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import ButtonCalendar from '@/Components/ButtonCalendar.vue';
//graficas 
import Grafica1 from './Partials/Grafica1.vue';
import Grafica2 from './Partials/Grafica2.vue';
import Grafica3 from './Partials/Grafica3.vue';
import Grafica4 from './Partials/Grafica4.vue';
import { reactive, computed, ref, onMounted, watch } from 'vue'
import { pickBy } from "lodash";
import { router, usePage } from '@inertiajs/vue3';

const props = defineProps({
 prospectos:Object,
 prospectosGraph:Object,
 oportunidades_ganadas:Object,
 oportunidades_perdidas:Object,
 prospectos_por_fuente:Object,
 origenes:Object,
 sedes:Object,
 prospectosPorSede:Object,
 oportunidadesPorSede:Object,
 status:Object
});  

//Filtros
const params = reactive({
    fecha:null,
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
                   newObj.Junk = props.prospectosGraph[index].contador;
                break;
                case 3:
                   newObj.Contactado = props.prospectosGraph[index].contador;
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
                    objetoProspecto.Contactado += props.prospectosGraph[index].contador;
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
                    newObj.Junk = props.prospectosGraph[index].contador;
                 break;
                 case 3:
                    newObj.Contactado = props.prospectosGraph[index].contador;
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

//data para grafico pastel Prospectos pro fuente (DEBE SER AFECTADA POR EL AÑO / MES)
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
        //console.log(prospectos)
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

 //Fechas
let date = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear(),
});


const changeDate = (newDate) => {
    date.value = newDate;
    let fecha = null;
    //console.log(newDate.month)
    switch (newDate.month) 
    {
      case 0: //Enero
            fecha = newDate.year + '-' + "01";
            params.fecha = fecha;
         break;
      case 1: //Febrero
            fecha = newDate.year + '-' + "02";
            params.fecha = fecha;
         break;
      case 2: //Marzo
            fecha = newDate.year + '-' + "03";
            params.fecha = fecha;
         break;
      case 3: //Abril
            fecha = newDate.year + '-' + "04";
            params.fecha = fecha;
         break;
      case 4: //Mayo
            fecha = newDate.year + '-' + "05";
            params.fecha = fecha;
         break;
      case 5: //Junio
         fecha = newDate.year + '-' + "06";
         params.fecha = fecha;
      break;
      case 6: //Julio
         fecha = newDate.year + '-' + "07";
         params.fecha = fecha;
      break;
      case 7: //Agosto
         fecha = newDate.year + '-' + "08";
         params.fecha = fecha;
      break;
      case 8: //Spetiembre
         fecha = newDate.year + '-' + "09";
         params.fecha = fecha;
      break;
      case 9: //Octubre
         fecha = newDate.year + '-' + "10";
         params.fecha = fecha;
      break;
      case 10: //Noviembre
         fecha = newDate.year + '-' + "11";
         params.fecha = fecha;
      break;
      case 11: //Diciembre
         fecha = newDate.year + '-' + "12";
         params.fecha = fecha;
      break;
    }
};

const prospectosOportinitiesBySede = computed(() =>
{
  let arraySedes = [];
  for (let index = 0; index < props.sedes.length; index++) 
  {
    const sede = props.sedes[index];
    let objSede = {
        sede:sede.nombre,
        prospectos:0,
        oportunidades:0
    }
    arraySedes.push(objSede);
  }

  //recorrido de leads para asignar
  for (let index2 = 0; index2 < props.prospectosPorSede.length; index2++) 
  {
    const prospecto = props.prospectosPorSede[index2];
    for (let index3 = 0; index3 < arraySedes.length; index3++) 
    {
        const objeto = arraySedes[index3];
        if(objeto.sede == prospecto.sede_name)
        {
           objeto.prospectos = prospecto.contador
        }
    }
  }

  //recorrido de oportunidades para asignar
  for (let index3 = 0; index3 < props.oportunidadesPorSede.length; index3++) 
  {
    const oportunidad = props.oportunidadesPorSede[index3];
    for (let index4 = 0; index4 < arraySedes.length; index4++) 
    {
        const objeto = arraySedes[index4];
        if(objeto.sede == oportunidad.sede_name)
        {
           objeto.oportunidades = oportunidad.contador
        }
    }
  }

  return arraySedes;
});

onMounted(() => 
{
    let fecha = null;
    switch (date.value.month) 
    {
      case 0: //Enero
            fecha = date.value.year + '-' + "01";
            params.fecha = fecha;
         break;
      case 1: //Febrero
            fecha = date.value.year + '-' + "02";
            params.fecha = fecha;
         break;
      case 2: //Marzo
            fecha = date.value.year + '-' + "03";
            params.fecha = fecha;
         break;
      case 3: //Abril
            fecha = date.value.year+ '-' + "04";
            params.fecha = fecha;
         break;
      case 4: //Mayo
            fecha = date.value.year + '-' + "05";
            params.fecha = fecha;
         break;
      case 5: //Junio
         fecha = date.value.year + '-' + "06";
         params.fecha = fecha;
      break;
      case 6: //Julio
         fecha = date.value.year + '-' + "07";
         params.fecha = fecha;
      break;
      case 7: //Agosto
         fecha = date.value.year + '-' + "08";
         params.fecha = fecha;
      break;
      case 8: //Spetiembre
         fecha = date.value.year + '-' + "09";
         params.fecha = fecha;
      break;
      case 9: //Octubre
         fecha = date.value.year + '-' + "10";
         params.fecha = fecha;
      break;
      case 10: //Noviembre
         fecha = date.value.year+ '-' + "11";
         params.fecha = fecha;
      break;
      case 11: //Diciembre
         fecha = date.value.year + '-' + "12";
         params.fecha = fecha;
      break;
    }
});


watch(params, () => {
    const clearParams = pickBy({ ...params });
    router.visit(route("dashboard"), 
    {
        data: clearParams,
        replace: true,
        preserveScroll: true,
        preserveState: true,
    });
});
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>
        <div class="flex flex-row justify-center my-2">
            <ButtonCalendar :month="date.month"  :year="date.year"  @change-date="changeDate($event)" />
        </div>
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
                <Grafica1 :prospectosCalculados="prospectosCalculados" :status="status" />
            </div>
            <div class="w-1/4 ">
                <h1 class="my-2 text-xl font-semibold">Prospectos por fuente</h1>
                <Grafica2 :prospectosPorFuenteCalculados="prospectosPorFuenteCalculados" />
            </div>
            <div class="w-1/4 ">
                <h1 class="my-2 text-xl font-semibold">Descarte de oportunidades</h1>
                <Grafica4 />
            </div>
        </div>
        <div class="flex flex-row p-8 gap-x-16">
            <div class="w-full">
                <h1 class="my-2 text-xl font-semibold">Prospectos y oportunidades por sede</h1>
                <Grafica3 :prospectosOportinitiesBySede="prospectosOportinitiesBySede" />
            </div>
        </div>
    </AppLayout>
</template>
