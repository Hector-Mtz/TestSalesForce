<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       duplicados:Object
 })

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
                <h1 class="text-white">Duplicados</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
              <div class="p-4">
                <h1 class="mb-4 text-xl">Prospectos ({{ duplicados.length }})</h1>
                  <table class="w-full">
                    <thead class="border-b-4">
                        <tr>
                            <th class="text-lg">Nombre y apellidos</th>
                            <th class="text-lg">Email</th>
                            <th class="text-lg">Teléfono</th>
                            <th class="text-lg">Sede</th>
                            <th class="text-lg">Producto de interés</th>
                            <th class="text-lg">Estado del prospecto</th>
                            <th class="text-lg">Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="duplicado in duplicados" :key="duplicado.id">
                           <td class="text-base text-center">
                              <a :href="'/viewProspecto/'+duplicado.id" class="text-blue-500">
                                {{ duplicado.nombre + ' ' + duplicado.apellidos }}
                              </a>
                           </td>
                           <td class="text-base text-center">
                             {{ duplicado.email }}
                           </td>
                           <td class="text-base text-center">
                             {{ duplicado.telefono }}
                           </td>
                           <td class="text-base text-center">
                            {{ duplicado.sede_name }}
                           </td>
                           <td class="text-base text-center">
                             {{ duplicado.producto_name }}
                           </td>
                           <td class="text-base text-center">
                             {{ duplicado.status_name }}
                           </td>
                           <td class="text-base text-center">
                            {{ new Date(duplicado.created_at )}}
                           </td>
                        </tr>
                    </tbody>
                  </table>
              </div>
         </template>
      </DialogModal>
</template>