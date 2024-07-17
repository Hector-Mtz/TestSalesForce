<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import axios from 'axios';
import SpinProgress from '@/Components/SpinProgress.vue';

const page = usePage();
const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       sedes:Object,
       asignaciones:Object,
       producto_interes:Object,
   });

const emit = defineEmits(["close"])
const close = () => 
{
  emit('close');
  formNewRuleta.reset();
  showForm.value = false;
}

let showSpin=ref(false);
let showForm = ref(false);
const changeView = () => 
{
    showForm.value = true;
}
//Formulario
const formNewRuleta = useForm({
       nombre: '',
       sede:'',
       tipo_ruleta:'',
              
    });

</script>
<template>
    <DialogModal   :max-width="'3xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Nueva ruleta</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
            <div class="px-4 my-2">
                <div v-if="!showForm" class="flex flex-col">
                    <InputLabel class="text-sm" value="Tipo de ruleta" />
                    <div class="flex flex-row items-center my-3 gap-x-2">
                        <input  type="radio" value="ruleta_sede" id="ruleta_sede" v-model="formNewRuleta.tipo_ruleta" />
                        <label  class="font-bold text-gray-500" for="ruleta_sede">Ruleta sede</label>
                    </div>
                    <div class="flex flex-row items-center gap-x-2">
                        <input  type="radio" value="ruleta_padre" id="ruleta_padre" v-model="formNewRuleta.tipo_ruleta" />
                        <label  class="font-bold text-gray-500" for="ruleta_padre">Ruleta padre</label>
                    </div>
                    <button @click="changeView" v-if="formNewRuleta.tipo_ruleta !== ''" class="my-4 bg-[#5562a3] text-white rounded-xl py-2 mx-16">
                        Siguiente
                    </button>
                </div>
            </div>
            <div v-if="showForm">
                <div class="px-4 py-1 my-2 bg-gray-400">
                    <h3 class="text-white">Información</h3>
                 </div>
                 <div class="px-4 py-2">
                    <div class="my-2">
                        <InputLabel class="text-sm" value="Nombre de la ruleta" />
                        <input v-model="formNewRuleta.nombre" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                     </div>
                     <div class="my-2">
                        <InputLabel class="text-sm" value="Sede" />
                        <div>

                        </div>
                     </div>
                     <div class="my-2">
                        <InputLabel class="text-sm" value="Producto de interés" />
                        <div>

                        </div>
                     </div>
                     <div class="my-2">
                        <InputLabel class="text-sm" value="Asignación" />
                     </div>
                 </div>
            </div>
         </template>
         <template #footer>

         </template>
      </DialogModal>
</template>