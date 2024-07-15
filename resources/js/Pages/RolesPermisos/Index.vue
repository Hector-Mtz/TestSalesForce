<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
//Componentes
import Permisions from './Partials/Permissions.vue';
import Roles from './Partials/Roles.vue';
import { ref } from 'vue';

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
               <h1 class="text-xl font-semibold">Usuarios</h1>
               <table class="w-full my-2">
                  <thead class="border-b">
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
                    <h1 class="text-xl font-semibold">Roles</h1>
                    <Roles :roles="roles" @selectRol="selectRol"  />
                </div>
                <div  class="p-2 bg-white rounded-lg shadow-sm">
                    <h1 class="text-xl font-semibold">Permisos</h1>
                    <Permissions :permisos="permisos" :rol="rol" />
                </div>
            </div>
         </div>
    </AppLayout>
</template>