<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, onMounted, onUpdated  } from 'vue';
import axios from 'axios';

const page = usePage();
const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       ruleta_padre_act:Object
   });

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');

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
            <div class="flex flex-row justify-around p-2">
               <div>
                  <h4 class="font-semibold">Sede:</h4>

               </div>
               <div>
                  <h4 class="font-semibold">Creador de ruleta:</h4>
                  <p>{{ruleta_padre_act.usuario_nombre}}</p>
               </div>
            </div>
         </template>
         <template #footer>

         </template>
      </DialogModal>
</template>