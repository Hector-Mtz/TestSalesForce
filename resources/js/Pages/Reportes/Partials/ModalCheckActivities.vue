<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';

const page = usePage();
const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       arrayActividades:Object
   });

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');
}

</script>
<template>
    <DialogModal   :max-width="'5xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Actividades</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
             <div>
                <table class="w-full">
                  <thead>
                    <tr>
                        <th class="text-lg">Tipo de actividad</th>
                        <th class="text-lg">Comentarios</th>
                        <th class="text-lg">Mensaje de WhatsApp</th>
                        <th class="text-lg">Asunto de mail</th>
                        <th class="text-lg">Fecha de creación</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr v-for="actividad in arrayActividades" :key="actividad.id">
                         <td class="text-lg text-center">
                            {{ actividad.categoria_tarea }}
                         </td>
                         <td class="text-lg text-center">
                            {{ actividad.comentarios }}
                         </td>
                         <td class="text-lg text-center">
                            {{ actividad.mensaje_whats }}
                         </td>
                         <td class="text-lg text-center">
                            {{ actividad.asunto_mail }}
                         </td>
                         <td class="text-lg text-center">
                            {{ actividad.created_at.substring(0,10) }}
                         </td>
                      </tr>
                  </tbody>
                </table>
             </div>
         </template>
    </DialogModal>
</template>