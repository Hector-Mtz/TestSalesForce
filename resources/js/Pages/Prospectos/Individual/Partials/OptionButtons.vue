<script setup>
 import { useForm, usePage } from '@inertiajs/vue3';
 import { onMounted, ref, watch,computed, onUpdated } from 'vue';

import VueBottomSheet from "@webzlodimir/vue-bottom-sheet";
import  "@webzlodimir/vue-bottom-sheet/dist/style.css";

const props = defineProps({
    prospecto:Object,
    asesores:Object
});

const formNewTask = useForm
({
    asunto:'',
    comentarios:'',
    prospecto:props.prospecto.id,
    asesor:props.prospecto.propietario,
    //datos mail
    from:'',
    to:props.prospecto.email,
    asunto_mail:'',
    cuerpo_mail:''
});

const asesorActual = computed(() => 
{
  let asesor = props.asesores.filter(function(actual)
  {
     return actual.id == props.prospecto.propietario
  });

  return asesor[0];
});

const myBottomSheet = ref(null)
const open = (type) => 
{
  //console.log(asesorActual.value.email);
  formNewTask.from = asesorActual.value.email;
  formNewTask.asunto = type
  myBottomSheet.value.open();
}

const close = () => 
{
  typeTask.value = '';
  myBottomSheet.value.close();
}




</script>
<template>
    <div class="mainopShadow"></div>
      <div class="fab">
        <div class="bg-green-500 mainop">
          <i id="addIcon" class="material-icons">
            <svg class="-mt-2" width="50px" height="50px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <g id="Page-1" stroke="none" stroke-width="1" fill="white"  sketch:type="MSPage">
                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-464.000000, -1087.000000)" fill="white">
                        <path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" id="plus-circle" sketch:type="MSShapeGroup">
                        </path>
                    </g>
                </g>
            </svg>
          </i>
        </div>
        <button @click="open(1)" id="forms" class="bg-green-400 minifab">
            <svg class="mt-1 ml-1" fill="white" width="40px" height="40px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <title>whatsapp</title>
                <path d="M26.576 5.363c-2.69-2.69-6.406-4.354-10.511-4.354-8.209 0-14.865 6.655-14.865 14.865 0 2.732 0.737 5.291 2.022 7.491l-0.038-0.070-2.109 7.702 7.879-2.067c2.051 1.139 4.498 1.809 7.102 1.809h0.006c8.209-0.003 14.862-6.659 14.862-14.868 0-4.103-1.662-7.817-4.349-10.507l0 0zM16.062 28.228h-0.005c-0 0-0.001 0-0.001 0-2.319 0-4.489-0.64-6.342-1.753l0.056 0.031-0.451-0.267-4.675 1.227 1.247-4.559-0.294-0.467c-1.185-1.862-1.889-4.131-1.889-6.565 0-6.822 5.531-12.353 12.353-12.353s12.353 5.531 12.353 12.353c0 6.822-5.53 12.353-12.353 12.353h-0zM22.838 18.977c-0.371-0.186-2.197-1.083-2.537-1.208-0.341-0.124-0.589-0.185-0.837 0.187-0.246 0.371-0.958 1.207-1.175 1.455-0.216 0.249-0.434 0.279-0.805 0.094-1.15-0.466-2.138-1.087-2.997-1.852l0.010 0.009c-0.799-0.74-1.484-1.587-2.037-2.521l-0.028-0.052c-0.216-0.371-0.023-0.572 0.162-0.757 0.167-0.166 0.372-0.434 0.557-0.65 0.146-0.179 0.271-0.384 0.366-0.604l0.006-0.017c0.043-0.087 0.068-0.188 0.068-0.296 0-0.131-0.037-0.253-0.101-0.357l0.002 0.003c-0.094-0.186-0.836-2.014-1.145-2.758-0.302-0.724-0.609-0.625-0.836-0.637-0.216-0.010-0.464-0.012-0.712-0.012-0.395 0.010-0.746 0.188-0.988 0.463l-0.001 0.002c-0.802 0.761-1.3 1.834-1.3 3.023 0 0.026 0 0.053 0.001 0.079l-0-0.004c0.131 1.467 0.681 2.784 1.527 3.857l-0.012-0.015c1.604 2.379 3.742 4.282 6.251 5.564l0.094 0.043c0.548 0.248 1.25 0.513 1.968 0.74l0.149 0.041c0.442 0.14 0.951 0.221 1.479 0.221 0.303 0 0.601-0.027 0.889-0.078l-0.031 0.004c1.069-0.223 1.956-0.868 2.497-1.749l0.009-0.017c0.165-0.366 0.261-0.793 0.261-1.242 0-0.185-0.016-0.366-0.047-0.542l0.003 0.019c-0.092-0.155-0.34-0.247-0.712-0.434z"></path>
            </svg>
        </button>
        <button @click="open(3)"  id="forms" class="bg-emerald-400 minifab">
            <svg class="mt-1 ml-1" width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.13948 12.7696C3.76094 10.2681 3 7.29713 3 4L4.96733 3.5081C5.68758 3.32804 6.0477 3.238 6.37009 3.29854C6.65417 3.35188 6.91678 3.48615 7.12635 3.68522C7.36417 3.91113 7.50204 4.25579 7.77776 4.9451L8.48846 6.72184C8.67477 7.18763 8.76793 7.42053 8.784 7.65625C8.79821 7.86484 8.76867 8.07409 8.69726 8.27058C8.61655 8.49264 8.46255 8.69065 8.15456 9.08664L5.13948 12.7696ZM5.13948 12.7696C6.66062 15.5299 8.93373 17.7184 11.7662 19.1428M11.7662 19.1428C14.1523 20.3425 16.9352 21 20 21L20.4916 19.0324C20.6717 18.3121 20.7617 17.952 20.7012 17.6296C20.6478 17.3456 20.5136 17.0829 20.3145 16.8734C20.0886 16.6355 19.7439 16.4977 19.0546 16.222L17.4691 15.5877C16.9377 15.3752 16.672 15.2689 16.4071 15.2608C16.1729 15.2536 15.9404 15.3013 15.728 15.4001C15.4877 15.512 15.2854 15.7143 14.8807 16.119L11.7662 19.1428ZM20.9997 7V3M20.9997 3H16.9997M20.9997 3L14.9997 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button @click="open(2)"  id="forms" class="bg-blue-400 minifab">
            <svg class="mt-1 ml-1" width="40px" height="40px" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.0098 12.39V7.39001C22.0098 6.32915 21.5883 5.31167 20.8382 4.56152C20.0881 3.81138 19.0706 3.39001 18.0098 3.39001H6.00977C4.9489 3.39001 3.93148 3.81138 3.18134 4.56152C2.43119 5.31167 2.00977 6.32915 2.00977 7.39001V17.39C2.00977 18.4509 2.43119 19.4682 3.18134 20.2184C3.93148 20.9685 4.9489 21.39 6.00977 21.39H12.0098" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21.209 5.41992C15.599 16.0599 8.39906 16.0499 2.78906 5.41992" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.0098 18.39H23.0098" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.0098 15.39L23.0098 18.39L20.0098 21.39" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <!--
        <div id="drawings" class="minifab op4">
          <img class="minifabIcon" src="https://vectr.com/doodleblu/b2DCtQvEHF.svg?width=64&height=64&select=b2DCtQvEHFpage0">
        </div>
        <div id="slides" class="minifab op3">
          <img class="minifabIcon" src="https://vectr.com/doodleblu/a12WZHDh0z.svg?width=64&height=64&select=a12WZHDh0zpage0">
        </div>
        <div id="sheets" class="minifab op2">
          <img class="minifabIcon" src="https://vectr.com/doodleblu/eoOhnACDe.svg?width=64&height=64&select=eoOhnACDepage0">
        </div>
        <div id="docs" class="minifab op1">
          <img class="minifabIcon" src="https://vectr.com/doodleblu/bo4WGZSAK.svg?width=64&height=64&select=bo4WGZSAKpage0">
        </div>
        -->
        <vue-bottom-sheet ref="myBottomSheet"
         :can-swipe="true"
         :max-width="720" max-height="1080" >
           <div class="p-6 pt-0">
              <h1 class="my-2 text-2xl font-semibold text-center">Nueva tarea</h1>
              <div class="my-2">
                <p class="font-semibold">Asunto:        
                    <span class="font-light" v-if="formNewTask.asunto == 1">
                        WhatsApp
                    </span>
                    <span class="font-light"  v-if="formNewTask.asunto == 2">
                        Email
                    </span>
                    <span class="font-light"  v-if="formNewTask.asunto == 3">
                        Llamada
                    </span>
                </p>
              </div>
              <div class="my-2">
                <p class="font-semibold">Nombre:
                    <span class="font-light" >{{prospecto.nombre + ' ' + prospecto.apellidos }}</span>
                </p>
              </div>
              <div class="my-2">
                <p class="font-semibold">Asignado a:
                    <span class="font-light" v-if="asesorActual" >
                         {{ asesorActual.name + ' ' + asesorActual.ap_paterno + ' ' +asesorActual.ap_materno}}
                    </span>
                </p>
              </div>
              <div class="my-2" v-if="formNewTask.asunto  !== 2">
                <p class="font-semibold">Comentarios</p>
                <textarea v-model="formNewTask.comentarios" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"></textarea>
              </div>
              <div  v-else>
                <div class="flex flex-row gap-x-12">
                    <div class="w-1/2 my-2">
                        <p class="font-semibold">
                           De:
                           <input disabled v-model="formNewTask.from" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 disabled:"  />
                        </p>
                     </div>
                     <div class="w-1/2 my-2" >
                       <p class="font-semibold">
                          Para: 
                       </p>
                       <input disabled v-model="formNewTask.to" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 disabled:"  />
                    </div>
                </div>
                <div class="my-2">
                   <p class="font-semibold">Asunto del correo</p>
                   <input v-model="formNewTask.asunto_mail" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"  />
                </div>
                <div class="my-2">
                   <p class="font-semibold">Cuerpo del correo:</p>
                   <textarea v-model="formNewTask.cuerpo_mail" class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"></textarea>
                </div>
              </div>
              <div class="float-right my-2">
                  <button class="px-2 py-1 text-xl font-semibold text-white bg-blue-500 rounded-lg">
                     Guardar
                  </button>
              </div>
           </div>
        </vue-bottom-sheet>
      </div>
</template>
<style >
  .fab {
    background-color: transparent;
    height: 64px;
    width: 64px;
    border-radius: 32px;
    transition: height 300ms;
    transition-timing-function: ease;
    position: fixed;
    right: 50px;
    bottom: 50px;
    text-align: center;
    overflow: hidden;
  }
  
  .fab:hover {
    height: 250px;
  }
  
  .fab:hover .mainop {
    transform: rotate(180deg);
  }
  
  .mainop {
    width: 64px;
    height: 64px;
    position: fixed;
    right: 50px;
    bottom: 50px;
    transition: transform 300ms;

    border-radius: 32px;
    z-index: 6;
    display: flex;
    justify-content: center;
  }
  
  .mainopShadow {
    width: 64px;
    height: 64px;
    border-radius: 32px;
    position: fixed;
    right: 50px;
    bottom: 50px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  }
  
  .mainop i {
    margin-top: 16px;
    font-size: 32px;
    color: #fff;
  }
  
  .minifab {
    position: relative;
    width: 48px;
    height: 48px;
    border-radius: 24px;
    z-index: 5;
    float: left;
    margin-bottom: 8px;
    margin-left: 8px;
    margin-right: 8px;
    transition: box-shadow 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
  }
  
  .minifab:hover {
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  }
  
  .minifabIcon {
    height: 24px;
    width: 24px;
    margin-top: 12px;
  }
  
  .bottom-sheet__content[data-v-f0c780e0] /*es del bottom sheet de las tareas*/
  {
    height: auto;
  }
</style>