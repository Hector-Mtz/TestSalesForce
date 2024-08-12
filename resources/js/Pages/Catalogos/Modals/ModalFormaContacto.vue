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
    typeFormaContacto:String,
    formaContactoA:Object

});
let showSpin=ref(false);
const emit = defineEmits(["close"])
const close = () => 
{
  formFormaContacto.forma = '';
  emit('close');
}

//Formulario
const formFormaContacto = useForm({
  id:-1,
  forma:'',
});

onUpdated(() => 
{
    if(props.formaContactoA)
    {
        formFormaContacto.forma = props.formaContactoA.forma;
    }
});

const saveFormaContacto = () => 
{
  showSpin.value = true;
  try 
  {
     if(props.typeFormaContacto == 'new') 
     {
        formFormaContacto.post(route('saveFormaContacto'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
            formFormaContacto.reset();
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
        formFormaContacto.id = props.formaContactoA.id;
        formFormaContacto.post(route('saveEditFormaContacto'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
            formFormaContacto.reset();
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
                  <span v-if="typeFormaContacto == 'new'" >
                     Nueva forma de contacto
                  </span>
                  <span v-else>
                     Edición de forma de contacto
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
                   <p class="text-lg font-semibold">Forma de contacto</p>
                   <input v-model="formFormaContacto.forma" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                   <p class="font-semibold text-red-500">{{formFormaContacto.errors.forma}}</p>
               </div>
            </div>
         </template>
         <template #footer>
            <button @click="saveFormaContacto" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
                <p>Guardar</p>
                <SpinProgress :inprogress="showSpin" />
            </button>
         </template>
    </DialogModal>
</template>