<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, onMounted, onUpdated  } from 'vue';
import SpinProgress from '@/Components/SpinProgress.vue';
import ListDataInput from '@/Components/ListDataInput.vue';

const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       ruleta_sede_actual:Object
   });
const emit = defineEmits(["close"])
let showSpin=ref(false);
const page = usePage();
const close = () => 
{
  emit('close');
  formNewAsesor.reset();
}
//Formulario
const formNewAsesor = useForm({
   asesor:'',
   ruleta_sede:'',
   creado_por:page.props.auth.user.id,
});

let listusers = ref([]);
const getListUsers = async () => {
    try {

        const resp = await axios.get(route('users.list'));
        listusers.value = resp.data;
    } catch (error) {
        console.log(error);
        if (error.response && error.response.data.hasOwnProperty('errors')) {

            alert(error.response.data.message)
        } else {
            alert("Error GET USERS")
        };
    }
}

onUpdated(() => 
{
    formNewAsesor.ruleta_sede = props.ruleta_sede_actual.id;
    getListUsers();
})

const saveNewAsesor = () => 
{
    try 
    {
      formNewAsesor.post(route('saveRuletaAsesor'),{
        preserveScroll:true,
        preserveState:true,
        onSuccess:() =>{
            formNewAsesor.asesor = '';
        }
      });
    } 
    catch (error) 
    {
        
    }
}

</script>
<template>
    <DialogModal   :max-width="'3xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between">
              <div class="bg-[#5562a3] p-2 px-6 rounded-br-lg">
                <h1 class="text-white">Agregar asesores a ruleta {{ruleta_sede_actual.nombre}}</h1>
              </div>
              <span class="p-2" @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
            <div class="p-4">
                <div>
                    <h2 class="font-bold">Nuevo aseor</h2>
                    <ListDataInput list="list_users" v-model="formNewAsesor.asesor"  :options="listusers" class="flex-1" />
                </div>
                {{ formNewAsesor }}
                <table class="w-full my-4">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
         </template>
         <template #footer>
            <button  @click="saveNewAsesor" class="bg-[#5562a3] p-2 px-6 rounded-br-lg rounded-tl-lg text-white font-bold text-xl flex flex-row gap-x-4 items-center">
               <p>Guardar</p>
               <SpinProgress :inprogress="showSpin" />
           </button>
         </template>
      </DialogModal>
</template>