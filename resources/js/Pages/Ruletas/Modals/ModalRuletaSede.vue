<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, onMounted, onUpdated  } from 'vue';
import SpinProgress from '@/Components/SpinProgress.vue';
import Select from '@/Components/Select.vue';

const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       ruleta_sede_actual:Object,
       sedes:Object,
       producto_interes:Object,
       asignaciones:Object
   });
const emit = defineEmits(["close"])
let showSpin=ref(false);
const close = () => 
{
  emit('close');
  formEditRuleta.reset();
  showSpin.value = false;
}
//Formulario
const formEditRuleta = useForm({
   id:-1,
   nombre:'',
   sedes:[],
   productos_interes:[],
   asignacion:''
});

onUpdated(() => 
{
  formEditRuleta.nombre = props.ruleta_sede_actual.nombre
  formEditRuleta.id = props.ruleta_sede_actual.id
  formEditRuleta.asignacion = props.ruleta_sede_actual.tipo_asignacion
  formEditRuleta.sedes = [];
  formEditRuleta.productos_interes = [];

  for (let index = 0; index < props.sedes.length; index++) 
  {
    const sede = props.sedes[index];
    formEditRuleta.sedes.push({id:sede.id,sede:sede.nombre, inluir:false});
  }

  if(props.ruleta_sede_actual.sedes.length > 0)
  {
    for (let index = 0; index < formEditRuleta.sedes.length; index++) 
    {
      const sedeForm = formEditRuleta.sedes[index];
      for (let index2 = 0; index2 < props.ruleta_sede_actual.sedes.length; index2++) 
      {
        const sedeT = props.ruleta_sede_actual.sedes[index2];
        if(sedeT.id == sedeForm.id)
        {
           sedeForm.inluir = true;
        }
      }
    }
  }

  for (let index2 = 0; index2 < props.producto_interes.length; index2++) 
  {
    const producto = props.producto_interes[index2];
    formEditRuleta.productos_interes.push({id:producto.id,producto:producto.nombre, incluir:false});
  }

  if(props.ruleta_sede_actual.productos.length > 0)
  {
    for (let index = 0; index < formEditRuleta.productos_interes.length; index++) 
    {
      const prodForm = formEditRuleta.productos_interes[index];
      for (let index2 = 0; index2 < props.ruleta_sede_actual.productos.length; index2++) 
      {
        const prodT = props.ruleta_sede_actual.productos[index2];
        if(prodT.id == prodForm.id)
        {
          prodForm.incluir = true;
        }
      }
    }
  }

})


const saveEditRuleta = () => 
{
  showSpin.value = true;
  formEditRuleta.post(route('updateRuletaSede'),{
    preserveScroll:true,
    preserveState:true,
    onSuccess:()=>{
      close();
    }
  });
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
            <div class="flex flex-row p-4 gap-x-4">
                <div class="w-1/2">
                  <div class="my-2">
                     <h2 class="font-bold">Ruleta padre</h2>
                     <p>{{ruleta_sede_actual.ruleta_padre}}</p>
                  </div>
                  <div class="my-2">
                     <h2 class="font-bold">Creador de la ruleta</h2>
                     <p>{{ruleta_sede_actual.usuario_nombre}}</p>
                  </div>
                  <div class="my-2">
                    <h2 class="font-bold">Fecha de creación</h2>
                    <p v-if="ruleta_sede_actual.created_at">{{ruleta_sede_actual.created_at.substring(0,10)}}</p>
                  </div>
                  <div class="my-2">
                    <Select v-model="formEditRuleta.asignacion" class="w-full">
                      <option v-for="asignacion in asignaciones" :key="asignacion.id" :value="asignacion.id">
                          {{asignacion.nombre}}
                      </option>
                    </Select>
                  </div>
                </div>
                <div class="w-1/2">
                  <div class="my-2">
                    <h2 class="font-bold">Nombre de ruleta</h2>
                    <input v-model="formEditRuleta.nombre" type="text"  class="w-full border-gray-300 shadow-sm rounded-xl dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                  </div> 
                  <div class="my-2">
                    <h2 class="font-bold">Sedes</h2>
                    <div class="h-16 p-2 mt-2 overflow-auto bg-gray-100 rounded-lg shadow-md">
                      <div class="flex" v-for="sedeForm in formEditRuleta.sedes" :key="sedeForm.sede">
                        <input type="checkbox"  v-model="sedeForm.inluir" />
                        <p>
                            {{sedeForm.sede}}
                        </p>
                    </div>
                    </div>
                  </div>   
                  <div class="my-2">
                    <h2 class="font-bold">Productos de interés</h2>
                    <div class="h-16 p-2 mt-2 overflow-auto bg-gray-100 rounded-lg shadow-md">
                      <div class="flex" v-for="prodForm in formEditRuleta.productos_interes" :key="prodForm.sede">
                        <input type="checkbox"  v-model="prodForm.incluir" />
                        <p>
                            {{prodForm.producto}}
                        </p>
                    </div>
                    </div>
                  </div>         
                </div>
            </div>
         </template>
         <template #footer>
            <button  @click="saveEditRuleta" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
               <p>Guardar</p>
               <SpinProgress :inprogress="showSpin" />
           </button>
         </template>
      </DialogModal>
</template>