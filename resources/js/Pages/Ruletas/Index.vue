<script setup>
import { ref} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
<template>
    <AppLayout title="Prospectos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Ruletas
                </h2>
                <button  class="px-4 py-1 border rounded-lg">
                    Nueva ruleta
                </button>
            </div>
        </template>
    </AppLayout>
</template>