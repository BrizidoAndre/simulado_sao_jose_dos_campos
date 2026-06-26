import {ref} from "vue";

export const toasts = ref([]);
export const addToast = (message, type = 'primary') => {
    const id = Math.random();
    toasts.value.push({
        id,
        message,
        type
    })

    setTimeout(() => {
        toasts.value = toasts.value.filter(t => t.id !== id);
    }, 3000)
}