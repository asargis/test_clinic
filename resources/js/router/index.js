import { createWebHistory, createRouter } from 'vue-router'

const Register = () => import('@/components/Register.vue')

const routes = [
    {
        name: "register",
        path: "/",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


export default router
