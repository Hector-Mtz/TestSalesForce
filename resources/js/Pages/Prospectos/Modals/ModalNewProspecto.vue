<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';


const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
      sedes:Object,
      asignaciones:Object,
      producto_interes:Object,
      campana_canal:Object,
      origenes:Object
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
                 <div class="grid grid-cols-2 px-4 justify-items-center">
                    <div class="mx-2"> <!--columna 1-->
                      <div class="my-2">
                         <InputLabel class="text-sm" value="Producto de interés" />
                         <Select class="w-full rounded-xl">
                            <option v-for="producto_intere in producto_interes" :key="producto_intere.id" :value="producto_intere.id">
                               {{producto_intere.nombre}}
                            </option>
                         </Select>
                      </div>
                      <div class="my-2">
                         <InputLabel class="text-sm" value="Campaña / canal" />
                         <Select class="w-full rounded-xl">
                            <option v-for="campana_canale in campana_canal" :key="campana_canale.id" :value="campana_canale.id">
                               {{campana_canale.nombre}}
                            </option>
                         </Select>
                      </div>
                      <div class="my-2">
                        <InputLabel class="text-sm" value="Asignación" />
                        <Select class="w-full rounded-xl">
                           <option v-for="asignacion in asignaciones" :key="asignacion.id" :value="asignacion.id">
                              {{asignacion.nombre}}
                           </option>
                        </Select>
                     </div>
                    </div>             <!--columna 1-->
                    <div class="mx-2"><!--columna 2-->
                        <div class="my-2">
                            <InputLabel class="text-sm" value="Sede" />
                            <Select class="w-full rounded-xl">
                               <option v-for="sede in sedes" :key="sede.id" :value="sede.id">
                                  {{sede.nombre}}
                               </option>
                            </Select>
                         </div>
                    </div>            <!--columna 2-->
                 </div>
             </div>
             <div>
                <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información del prospecto</h3>
                 </div>
                 <div class="grid grid-cols-2 px-4 justify-items-center">
                    <div class="mx-2">
                        <div class="my-2">
                            <InputLabel class="text-sm" value="Estado del prospecto" />
                            <Select class="w-full rounded-xl">
                                <option v-for="producto_intere in producto_interes" :key="producto_intere.id" :value="producto_intere.id">
                                    {{producto_intere.nombre}}
                                 </option>
                            </Select>
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Nombre" />
                            <input type="text" placeholder="Nombre" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Apellidos" />
                            <input type="text" placeholder="Apellidos" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                    </div>
                    <div class="mx-2">
                        <div class="my-2">
                            <InputLabel class="text-sm" value="Origen del prospecto" />
                            <Select class="w-full rounded-xl">
                                <option v-for="origen in origenes" :key="origen.id" :value="origen.id">
                                    {{origen.nombre}}
                                 </option>
                            </Select>
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Email" />
                            <input type="text" placeholder="Email" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                         <div class="my-2">
                            <InputLabel class="text-sm" value="Teléfono" />
                            <input type="text" placeholder="Teléfono" class="border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                         </div>
                    </div>
                </div>
             </div>
         </template>
      </DialogModal>
</template>