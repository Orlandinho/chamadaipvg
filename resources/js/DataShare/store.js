import { reactive } from 'vue'

export const alert = reactive({
    id: Number,
    type: String,
    title: String,
    message: String,
})
