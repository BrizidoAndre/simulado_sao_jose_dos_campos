import {computed, ref, watch} from "vue";

export const token = ref('');
export const apiHeaders = computed(() => {
    const headers = new Headers();
    headers.append('Authorization', 'Bearer ' + token.value);
    headers.append('Content-type', 'appliation/json');
    headers.append('Accept', 'appliation/json');
    return headers
})

export function syncStorage(value, key) {
    const localKey = 'br_' + key;
    if (sessionStorage[localKey]) {
        value.value = JSON.parse(sessionStorage[localKey]);
    }
    watch(value, value => {
        sessionStorage[localKey] = JSON.stringify(value);
    })
}

syncStorage(token, 'token_api');