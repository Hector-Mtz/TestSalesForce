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
    typeIdioma:String,
    idioma:Object

});
let showSpin=ref(false);
const emit = defineEmits(["close"])
const close = () => 
{
  formIdioma.nombre = '';
  emit('close');
}

//Formulario
const formIdioma = useForm({
  id:-1,
  nombre:'',
});

onUpdated(() => 
{
    if(props.idioma)
    {
        formIdioma.nombre = props.idioma.nombre;
    }
});

const saveIdioma = () => 
{
  showSpin.value = true;
  try 
  {
     if(props.typeIdioma == 'new') 
     {
        formIdioma.post(route('saveIdioma'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
            formIdioma.reset();
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
       formIdioma.id = props.idioma.id;
       formIdioma.post(route('saveEditIdioma'),
       {
          preserveScroll:true,
          preserveState:true,
          onSuccess:()=>
          {
             formIdioma.reset();
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
                  <span v-if="typeIdioma == 'new'" >
                     Nuevo idioma
                  </span>
                  <span v-else>
                     Edición del idioma
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
                   <p class="text-lg font-semibold">Nombre del idioma</p>
                   <input v-model="formIdioma.nombre" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                   <p class="font-semibold text-red-500">{{formIdioma.errors.nombre}}</p>
               </div>
            </div>
         </template>
         <template #footer>
            <button @click="saveIdioma" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
                <p>Guardar</p>
                <SpinProgress :inprogress="showSpin" />
            </button>
         </template>
    </DialogModal>
</template>