<script setup>
 import { ref, watch } from 'vue';
 
 var props = defineProps({
     roles:Object
 });

const emit = defineEmits(["selectRol"])

const filaActual = ref(null);
const selectFila = (fila) => 
{
  emit('selectRol', fila)
  filaActual.value = fila.id;
}

</script>
<template>
    <div class="w-full">
        <table class="w-full">
            <thead class="">
                <tr class="border-b-2 border-[#697FEA]">
                    <th class="font-semibold">Nombre</th>
                </tr>
            </thead>
            <tbody class="" style="overflow-y:scroll; height:10px;">
                  <tr v-for="rol in roles" :key="rol.id" @click="selectFila(rol)" :class="{'bg-[#9B9B9B] text-white':(rol.id==filaActual)}" >
                      <td class="py-2 text-center">{{ rol.nombre }}</td>
                  </tr>
            </tbody>
        </table>
     </div>
</template>