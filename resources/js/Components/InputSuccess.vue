<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="p-4 mb-2 text-sm text-white bg-green-600 rounded-lg dark:bg-green-200 dark:text-green-800">
            {{ message }}
        </p>
    </div>
</template>
