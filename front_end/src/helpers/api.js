import {apiHeaders} from "@/helpers/globals.js";
import {addAlert} from "@/helpers/addAlert.js";

const api_url = 'http://172.17.1.8/gonzaga-barber/public/api/';

export async function request(url, options = {}) {
    try {
        const fullUrl = api_url + url;
        const res = await fetch(fullUrl, {
            headers: apiHeaders.value,
            ...options,
        })
        if (res.status === 204) {
            return [null, null];
        }
        const data = await res.json();
        if (typeof data?.errors === 'object') {
            for (const errorsKey in data.errors) {
                data.errors[errorsKey].forEach(message => {
                    addAlert(message, 'danger');
                })
            }
        }
        if (data?.error) {
            addAlert(data.error, 'danger');
        }
        return [res, data];
    } catch (e) {
        addAlert('Request api error', 'warning');
        return [null, null];
    }
}

export const api = {
    get: async (url) => {
        return await request(url, {
            method: 'GET',
        });
    },
    post: async (url, body) => {
        return await request(url, {
            body: JSON.stringify({...body}),
            method: 'POST',
        });
    },
    put: async (url, body) => {
        return await request(url, {
            body: JSON.stringify({...body}),
            method: 'PUT',
        });
    },
    delete: async (url) => {
        return await request(url, {
            method: 'DELETE',
        });
    },
}