<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">予約一覧</h1>

        <table class="min-w-full border border-gray-300">
            <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">日付</th>
                <th class="p-2 border">時間</th>
                <th class="p-2 border">名前</th>
                <th class="p-2 border">電話</th>
                <th class="p-2 border">メール</th>
                <th class="p-2 border">備考</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="r in reservations" :key="r.id" class="border-t">
                <td class="p-2 border">{{ r.date }}</td>
                <td class="p-2 border">{{ r.start_time }} - {{ r.end_time }}</td>
                <td class="p-2 border">{{ r.name }}</td>
                <td class="p-2 border">{{ r.phone }}</td>
                <td class="p-2 border">{{ r.email }}</td>
                <td class="p-2 border">{{ r.notes }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue'
import axios from 'axios'

const reservations = ref([])

onMounted(async () => {
    const res = await axios.get(`${import.meta.env.VITE_API_URL}/reservations`)
    reservations.value = res.data
})
</script>
