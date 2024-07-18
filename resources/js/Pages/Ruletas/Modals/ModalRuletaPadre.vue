<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import Select from '@/Components/Select.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, onMounted, onUpdated  } from 'vue';
import axios from 'axios';
import SpinProgress from '@/Components/SpinProgress.vue';

const page = usePage();
const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       ruleta_padre_act:Object,
       sedes:Object,
       ruletas_sede:Object
   });

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');
  formEditRuleta.reset();
  showSpin.value = false;
}
let showSpin=ref(false);
//Formulario
const formEditRuleta = useForm({
   sede:'',
   ruletas_hijo:[],
   ruleta_padre:-1
});

onUpdated(() => 
{
   formEditRuleta.ruletas_hijo=[];
   formEditRuleta.sede = props.ruleta_padre_act.sede;
   formEditRuleta.ruleta_padre = props.ruleta_padre_act.id;

   for (let index = 0; index < props.ruletas_sede.length; index++) 
  {
    const ruleta_sede = props.ruletas_sede[index];
    formEditRuleta.ruletas_hijo.push({id:ruleta_sede.id, nombre:ruleta_sede.nombre, incluir:false});
  }
})

const saveEditRuleta = () => 
{
   showSpin.value = true;
   formEditRuleta.post(route('updateRuletaPadre'),{
      preserveScroll:true,
      preserveState:true,
      onSuccess:() => 
      {
         close();
      }
   })
}

</script>
<template>
    <DialogModal   :max-width="'3xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Ruleta padre {{ruleta_padre_act.nombre}}</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
            <div class="flex flex-row items-center p-2 gap-x-6">
               <div class="w-1/2">
                  <div class="my-2">
                     <h4 class="font-semibold">Sede:</h4>
                     <Select class="w-full" v-model="formEditRuleta.sede">
                        <option v-for="sede in sedes" :key="sede.id" :value="sede.id">
                           {{sede.nombre}}
                        </option>
                     </Select>
                  </div>
                  <div class="my-2">
                     <h4 class="font-semibold">Ruletas hijo:</h4>
                     <div class="h-16 p-2 mt-2 overflow-auto bg-gray-100 rounded-lg shadow-md">
                        <div class="flex items-center" v-for="ruleta_hijo in formEditRuleta.ruletas_hijo" :key="ruleta_hijo.id" >
                           <input type="checkbox" class="mx-2 rounded-full"  v-model="ruleta_hijo.incluir" />
                           {{ruleta_hijo.nombre}}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="w-1/2">
                  <div class="my-2">
                     <h4 class="font-semibold">Creador de ruleta:</h4>
                     <p>{{ruleta_padre_act.usuario_nombre}}</p>
                  </div>
                  <div class="my-2">
                     <h4 class="font-semibold">Fecha de creación:</h4>
                     <p v-if="ruleta_padre_act.created_at">{{ruleta_padre_act.created_at.substring(0,10)}}</p>
                  </div>
               </div>
            </div>
         </template>
         <template #footer>
            <button  @click="saveEditRuleta" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
               <p>Guardar</p>
               <SpinProgress :inprogress="showSpin" />
           </button>
         </template>
      </DialogModal>
</template>