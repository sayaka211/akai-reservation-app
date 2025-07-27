<template>
    <AppLayout>
        <form @submit.prevent="submit" class="max-w-xl mx-auto space-y-4">
            <div class="p-6 max-w-4xl mx-auto">
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">お名前</label>
                    <input v-model="form.name" type="text" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">メールアドレス</label>
                    <input v-model="form.email" type="email" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">電話番号</label>
                    <input v-model="form.phone" type="tel" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">備考</label>
                    <textarea v-model="form.notes" class="w-full border rounded p-2"></textarea>
                </div>

                <!-- 日付選択 -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">日付を選択</label>
                    <input type="date" v-model="form.date" class="border rounded px-3 py-2 w-full"/>
                </div>

                <!-- 時間スロット -->
                <div>
                    <label class="block mb-2 font-semibold">時間を選択</label>
                    <div class="grid grid-cols-8 gap-2">
                        <div
                            v-for="time in timeSlots"
                            :key="time"
                            class="text-center px-2 py-3 rounded cursor-pointer border"
                            :class="{
            'bg-gray-300 text-gray-600 cursor-not-allowed': isReserved(time),
            'bg-blue-500 text-white': isSelected(time),
            'hover:bg-blue-100': !isReserved(time) && !isSelected(time)
          }"
                            @click="selectTime(time)"
                        >
                            {{ time }}
                        </div>
                    </div>
                </div>

                <!-- 確認と送信 -->

                <div class="mt-6">
                    <p class="mb-2">選択された時間: <strong>{{ form.start_time }} ~ {{ form.end_time }}</strong></p>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="!form.date || !form.start_time || !form.end_time"
                    >予約する</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<script setup>
import {router, useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = useForm({
    name: '',
    email: '',
    phone: '',
    date: '',
    start_time: '',
    end_time: '',
    notes: '',
})

// 予約済み時間（本来はAPIなどから取得）
const reservedTimes = ['10:00', '10:30', '11:00']

const timeSlots = []
for (let h = 9; h <= 21; h++) {
    for (let m of [0, 30]) {
        const hh = h.toString().padStart(2, '0')
        const mm = m.toString().padStart(2, '0')
        timeSlots.push(`${hh}:${mm}`)
    }
}

function isReserved(time) {
    return reservedTimes.includes(time)
}

function selectTime(time) {
    if (isReserved(time)) return;

    // 開始・終了が両方選択済みならリセットして新たに開始
    if (form.start_time && form.end_time) {
        form.start_time = time;
        form.end_time = '';
        return;
    }

    // 開始だけ選択済みなら、クリックした時刻が後なら終了に、それ以外なら再選択
    if (form.start_time && !form.end_time) {
        if (compareTimes(time, form.start_time) > 0) {
            // 終了時間の前に予約済みがないかチェック
            const range = getTimeRange(form.start_time, time);
            if (range.some(t => isReserved(t))) {
                alert('選択範囲に予約済みの時間があります。');
                return;
            }
            form.end_time = time;
        } else {
            form.start_time = time;
        }
        return;
    }

    // 最初のクリック：開始時間としてセット
    form.start_time = time;
}

function compareTimes(a, b) {
    const [h1, m1] = a.split(':').map(Number);
    const [h2, m2] = b.split(':').map(Number);
    return h1 !== h2 ? h1 - h2 : m1 - m2;
}

function getTimeRange(start, end) {
    const result = [];
    let [h, m] = start.split(':').map(Number);
    const [eh, em] = end.split(':').map(Number);

    while (h < eh || (h === eh && m < em)) {
        result.push(`${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`);
        m += 30;
        if (m >= 60) {
            m = 0;
            h += 1;
        }
    }
    return result;
}

function isSelected(time) {
    if (!form.start_time || !form.end_time) return false;
    const range = getTimeRange(form.start_time, form.end_time);
    return range.includes(time);
}


function submit() {
    form.post('/reserve');
}
</script>

<style scoped>
.grid-cols-8 {
    display: grid;
    grid-template-columns: repeat(8, minmax(0, 1fr));
}
</style>
