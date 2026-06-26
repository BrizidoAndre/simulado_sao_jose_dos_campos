import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "@/views/LoginView.vue";
import {token} from "@/helpers/globals.js";
import CustomersView from "@/views/CustomersView.vue";
import WorkersView from "@/views/WorkersView.vue";
import PlansView from "@/views/PlansView.vue";
import SubscriptionsView from "@/views/SubscriptionsView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: LoginView,
        },
        {
            path: '/',
            name: 'home',
            component: HomeView,
            meta: {
                auth: true,
            }
        },
        {
            path: '/customers',
            name: 'customers',
            component: CustomersView,
            meta: {
                auth: true,
            }
        },
        {
            path: '/workers',
            name: 'workers',
            component: WorkersView,
            meta: {
                auth: true,
            }
        },
        {
            path: '/plans',
            name: 'plans',
            component: PlansView,
            meta: {
                auth: true,
            }
        },
        {
            path: '/subscriptions',
            name: 'subscriptions',
            component: SubscriptionsView,
            meta: {
                auth: true,
            }
        },
    ],
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
})

router.beforeEach((to, from) => {
    if (to.meta?.auth && !token.value) {
        return {
            name: 'login',
        };
    }
    return true;
})
export default router
