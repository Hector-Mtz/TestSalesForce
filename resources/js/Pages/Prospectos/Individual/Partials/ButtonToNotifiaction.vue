<script setup>


const props = defineProps({
    toastProps: Object
});

const emit = defineEmits(["openModalDup"])
const openModal = () => 
{
  emit('openModalDup');
}

</script>
<template>
    <button @click="openModal">
        <p>Existen <span v-if="toastProps.data.duplicados">
            {{ toastProps.data.duplicados.length }}</span> 
        duplicados</p>
    </button>
</template>
