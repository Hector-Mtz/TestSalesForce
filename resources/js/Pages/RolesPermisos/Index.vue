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
import ModalEditUser from './Modales/ModalEditUser.vue';

const props = defineProps({
    usuarios:Object,
    roles:Object,
    permisos:Object,
    coordinadores:Object,
    gerentes:Object
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
    newPermission.value = false;
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

//funciones de edicion
const modalEdit = ref(false) ;
let userActual = ref(null);
const editarUsuario = (user) => 
{
  modalEdit.value = true;
  userActual.value = user;
}

const closeEditarUsuario = () => 
{
    modalEdit.value = false;
    userActual.value = null
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
                       <td class="flex items-center text-center gap-x-2">
                         <button @click="editarUsuario(usuario)">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#2563eb " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                         </button>
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
         <ModalNewUser @close="closeNewuser" :show="newUser" :roles="roles" :coordinadores="coordinadores" :gerentes="gerentes" />
         <ModalEditUser @close="closeEditarUsuario" :show="modalEdit" :roles="roles" :coordinadores="coordinadores" :gerentes="gerentes" :userActual="userActual" />
    </AppLayout>
</template>