<script setup>
import DialogModal from '@/Components/DialogModal.vue';

const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       ruleta_sede_actual:Object
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
                <h1 class="text-white">Ruleta sede: {{ruleta_sede_actual.nombre}}</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>

         </template>
         <template #footer>
            <button  @click="saveEditRuleta" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
               <p>Guardar</p>
           </button>
         </template>
      </DialogModal>
</template>