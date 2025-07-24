<template>
    <div class="max-w-xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">予約フォーム</h1>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label class="block mb-1">お名前</label>
                <input v-model="form.name" type="text" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">メールアドレス</label>
                <input v-model="form.email" type="email" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">電話番号</label>
                <input v-model="form.phone" type="tel" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">利用日</label>
                <input v-model="form.date" type="date" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">開始時間</label>
                <select v-model="form.start_time" class="w-full border rounded p-2" required>
                    <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">終了時間</label>
                <select v-model="form.end_time" class="w-full border rounded p-2" required>
                    <option v-for="time in timeOptions" :key="time" :value="time">{{ time }}</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1">備考</label>
                <textarea v-model="form.notes" class="w-full border rounded p-2"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">予約する</button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

// 30分刻みの時間帯を生成（例：09:00〜21:30）
const timeOptions = []
for (let hour = 0; hour < 24; hour++) {
    for (let minute of [0, 30]) {
        const h = hour.toString().padStart(2, '0')
        const m = minute.toString().padStart(2, '0')
        timeOptions.push(`${h}:${m}`)
    }
}

const form = reactive({
    name: '',
    email: '',
    phone: '',
    date: '',
    start_time: '',
    end_time: '',
    notes: '',
})

function submit() {
    router.post('/reserve', form)
}
</script>
