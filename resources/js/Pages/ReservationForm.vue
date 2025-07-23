<template>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">予約フォーム</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block font-semibold">名前</label>
                <input v-model="form.name" type="text" class="w-full border p-2 rounded" required/>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">メール</label>
                <input v-model="form.email" type="email" class="w-full border p-2 rounded" required/>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">予約日</label>
                <input v-model="form.date" type="date" class="w-full border p-2 rounded" required/>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">時間</label>
                <input v-model="form.time" type="time" class="w-full border p-2 rounded" required/>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                送信
            </button>
        </form>
        <p v-if="success" class="text-green-600 mt-4">予約を受け付けました！</p>
    </div>
</template>

<script setup>
import {ref} from 'vue'
import axios from 'axios'

const form = ref({
    name: '',
    email: '',
    date: '',
    time: '',
})

const success = ref(false)

const submitForm = async () => {
    try {
        await axios.post('/api/reservations', form.value)
        success.value = true
        form.value = {name: '', email: '', date: '', time: ''}
    } catch (error) {
        console.error('送信エラー:', error)
        alert('送信に失敗しました')
    }
}
</script>
