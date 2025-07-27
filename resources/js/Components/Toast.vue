<!-- resources/js/Components/Toast.vue -->
<script setup>
import {ref, watch, onMounted} from 'vue'
import {usePage} from '@inertiajs/vue3'

const visible = ref(false)
const message = ref('')
const page = usePage()

watch(
    () => page.props.flash?.success,
    (val) => {
        if (val) {
            message.value = val
            visible.value = true

            setTimeout(() => {
                visible.value = false
                message.value = ''
            }, 3000) // 3秒後に消える
        }
    },
    {immediate: true}
)
</script>

<template>
    <transition name="fade">
        <div
            v-if="visible"
            class="fixed top-4 right-4 bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded shadow-lg z-50"
        >
            {{ message }}
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
