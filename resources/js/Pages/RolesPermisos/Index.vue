<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
//Componentes
import Permissions from './Partials/Permissions.vue';
import Roles from './Partials/Roles.vue';
import { ref } from 'vue';
//Modales
import ModalNewRol from './Modales/ModalNewRol.vue';
import ModalNewPermission from './Modales/ModalNewPermission.vue';
import ModalNewUser from './Modales/ModalNewUser.vue';

const props = defineProps({
    usuarios:Object,
    roles:Object,
    permisos:Object
   });  

const rol = ref(null);

const selectRol = (id) => 
{ 
  //console.log(id)
  rol.value = id
}

//Funciones para modales
let newRol = ref(false);

const openNewRolModal = () => 
{
    newRol.value = true;
}
const closeNewRolModal = () => 
{
   newRol.value = false;
}

let newPermission = ref(false);

const openNewPermissionModal = () =>
{
    newPermission.value = true;
}

const closeNewPermissionModal = () => 
{
    newPermission.false = false;
}

let newUser = ref(false);
const openNewUser = () => 
{
    newUser.value=true;
}

let closeNewuser = () =>
{
    newUser.value = false
}
</script>
<template>
    <AppLayout title="Roles y permisos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Roles y permisos
                </h2>
            </div>
        </template>
        <div class="grid grid-cols-2 gap-4 p-8">
            <div class="p-2 bg-white rounded-lg shadow-sm">
                <div class="flex flex-row justify-around my-1">
                    <h1 class="text-xl font-semibold">Usuarios</h1>
                    <button @click="openNewUser" class="bg-[#091a3e] text-white px-3 py-1 rounded-lg">
                        Nuevo usuario
                    </button>
                </div>
               <table class="w-full my-2">
                  <thead class="border-b-2 border-[#091a3e]">
                    <tr>
                        <th class="py-1">
                            Nombre
                        </th>
                        <th class="py-1">
                            Apellido paterno
                        </th>
                        <th class="py-1">
                            Apellido materno
                        </th>
                        <th class="py-1">
                            Email
                        </th>
                        <th class="py-1">
                            Rol
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="usuario in usuarios.data" :key="usuario.id">
                       <td class="text-center">
                          {{ usuario.name }}
                       </td>
                       <td class="text-center">
                        {{ usuario.ap_paterno }}
                       </td>
                       <td class="text-center">
                        {{ usuario.ap_materno }}
                       </td>
                       <td class="text-center">
                        {{ usuario.email }}
                       </td>
                       <td class="text-center">
                        {{ usuario.rol }}
                       </td>
                    </tr>
                  </tbody>
               </table>
            </div>
            <div class="grid grid-rows-2 gap-4 ">
                <div  class="p-2 bg-white rounded-lg shadow-sm">
                    <div class="flex flex-row justify-around my-1">
                        <h1 class="text-xl font-semibold">Roles</h1>
                        <button @click="openNewRolModal" class="bg-[#091a3e] text-white px-3 py-1 rounded-lg">
                            Nuevo rol
                        </button>
                    </div>
                    <Roles :roles="roles" @selectRol="selectRol"  />
                </div>
                <div  class="p-2 bg-white rounded-lg shadow-sm">
                    <div class="flex flex-row justify-around my-1">
                        <h1 class="text-xl font-semibold">Permisos</h1>
                        <button @click="openNewPermissionModal" class="bg-[#091a3e] text-white px-3 py-1 rounded-lg">
                            Nuevo permiso
                        </button>
                    </div>
                    <Permissions :permisos="permisos" :rol="rol" />
                </div>
            </div>
         </div>

         <ModalNewRol :show="newRol" @close="closeNewRolModal" />
         <ModalNewPermission :show="newPermission" @close="closeNewPermissionModal" />
         <ModalNewUser @close="closeNewuser" :show="newUser" :roles="roles" />
    </AppLayout>
</template>