<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import SpinProgress from '@/Components/SpinProgress.vue';
import { ref, onUpdated} from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
const props = defineProps({
    show: {
           type: Boolean,
           default: false,
       },
    typeMontoE:String,
    montoE:Object

});
let showSpin=ref(false);
const emit = defineEmits(["close"])
const close = () => 
{
  formMontoE.cantidad = '';
  emit('close');
}

//Formulario
const formMontoE = useForm({
  id:-1,
  cantidad:'',
});

onUpdated(() => 
{
    if(props.montoE)
    {
        formMontoE.cantidad = props.montoE.cantidad;
    }
});

const saveMontoE = () => 
{
  showSpin.value = true;
  try 
  {
     if(props.typeMontoE == 'new') 
     {
        formMontoE.post(route('saveMontoE'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
             formMontoE.reset();
             close();
             showSpin.value = false;
          },
          onError:()=>{
              showSpin.value = false;
          }
       });  
     }
     else
     {
       formMontoE.id = props.montoE.id;
       formMontoE.post(route('saveEditMontoE'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
             formMontoE.reset();
             close();
             showSpin.value = false;
          },
          onError:()=>{
              showSpin.value = false;
          }
       });  
     }

  } catch (error) {
    alert(error)
    showSpin.value = false;
  }    
}

</script>
<template>
    <DialogModal  :show="show" @close="close()">
        <template #title>
            <div class="flex flex-row justify-between">
               <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                 <h1 class="text-white">
                  <span v-if="typeMontoE == 'new'" >
                     Nuevo monto de enganche
                  </span>
                  <span v-else>
                     Edición del monto de encanche
                  </span>
                 </h1>
               </div>
               <span class="p-2" @click="close()">
                  Cerrar
               </span>
            </div>
          </template>
          <template #content>
            <div class="flex flex-row justify-around my-2">
               <div>
                   <p class="text-lg font-semibold">Cantidad</p>
                   <input v-model="formMontoE.cantidad" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                   <p class="font-semibold text-red-500">{{formMontoE.errors.cantidad}}</p>
               </div>
            </div>
         </template>
         <template #footer>
            <button @click="saveMontoE" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
                <p>Guardar</p>
                <SpinProgress :inprogress="showSpin" />
            </button>
         </template>
    </DialogModal>
</template>