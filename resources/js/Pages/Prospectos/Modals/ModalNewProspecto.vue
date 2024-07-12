<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';


const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       }
   });

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');
}

</script>
<template>
    <DialogModal   :max-width="'2xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Nuevo prospecto</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
             <div>
                 <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información de venta</h3>
                 </div>
                 
             </div>
             <div>
                <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información del prospecto</h3>
                 </div>
             </div>
         </template>
      </DialogModal>
</template>