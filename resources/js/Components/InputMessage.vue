<script setup>
defineProps([
    'message',
    'type',
]);
</script>

<template>
    <div v-if="type === 'error'">
        <div v-show="message">
            <p class="p-4 mb-2 text-sm text-white bg-red-400 rounded-lg dark:bg-green-200 dark:text-green-800">
                {{ message }}
            </p>
        </div>
    </div>
    <div v-else-if="type === 'success'">
        <div v-show="message">
            <p class="p-4 mb-2 text-sm text-white bg-green-600 rounded-lg dark:bg-green-200 dark:text-green-800">
                {{ message }}
            </p>
        </div>
    </div>
</template>
