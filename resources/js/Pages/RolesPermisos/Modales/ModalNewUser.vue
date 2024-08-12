<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import Select from '@/Components/Select.vue';

const props = defineProps({
       show: {
           type: Boolean,
           default: false,
       },
       roles:Object
   });

   const emit = defineEmits(["close"])
   const close = () => 
   {
     emit('close');
   }

    //Formulario
    const formNewUser = useForm({
       nombre: '',
       ap_paterno:'',
       ap_materno:'',
       email:'',
       role_id:-1,
       gerente:'',
       coordinador:'',
       password:''
    });

   const saveNewUser = () => 
   {
     if(formNewUser.nombre !== '' && formNewUser.email !==''
        && formNewUser.role_id !== -1 && formNewUser.password !== ''
     )
     {
        formNewUser.post(route('saveUser'),{
        onSuccess : () => 
            {
                formNewUser.reset();
               close();
            },
         preserveScroll:true,
         preserveState:true
       });
     }
     else
     {
        alert('Hacen falta campos')
     }
   }
</script>
<template>
    <DialogModal :maxWidth="'xl'"  :show="show" @close="close()">
        <template #title>
           <div class="flex flex-row justify-between px-6 py-4">
              <h1>Nuevo usuario</h1>
              <span @click="close()">
                 Cerrar
              </span>
           </div>
         </template>
         <template #content>
            <div class="px-6 py-4">
                <div class="flex flex-row justify-between">
                    <div class="w-full mx-2">
                        <InputLabel value="Nombre:" class="my-2" />
                        <TextInput v-model="formNewUser.nombre" class="w-full" :required="true" />
                    </div>
                    <div class="w-full mx-2">
                        <InputLabel value="Apellido paterno:" class="my-2" />
                        <TextInput v-model="formNewUser.ap_paterno" class="w-full" />
                    </div>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="w-full mx-2">
                        <InputLabel value="Apellido materno:" class="my-2" />
                        <TextInput v-model="formNewUser.ap_materno" class="w-full" />
                    </div>
                    <div class="w-full mx-2">
                        <InputLabel value="Email:" class="my-2" />
                        <TextInput v-model="formNewUser.email" class="w-full" />
                    </div>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="w-full mx-2">
                        <InputLabel value="Contraseña:" class="my-2" />
                        <TextInput v-model="formNewUser.password" class="w-full" />
                    </div>
                </div>
                <div class="w-full mx-2">
                    <InputLabel value="Rol:" class="my-2" />
                    <Select v-model="formNewUser.role_id" class="w-full">
                        <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                            {{ rol.nombre }}
                        </option>
                    </Select>
                </div>
                <button @click="saveNewUser" class="w-full my-2 bg-[#697FEA] text-white text-lg rounded-full">
                    Guardar nuevo usuario
                </button>
            </div>
         </template>
      </DialogModal>
</template>