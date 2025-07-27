<!-- resources/js/Layouts/AppLayout.vue -->
<script setup>
import Toast from '@/Components/Toast.vue'
</script>

<template>
    <div class="min-h-screen bg-gray-50 text-gray-800 p-4 relative">
        <!-- トースト通知 -->
        <Toast />

        <!-- ページ内容 -->
        <slot />
    </div>
</template>
