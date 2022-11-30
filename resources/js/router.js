import {createWebHistory, createRouter} from "vue-router";
import Home from "./components/Home.vue";
import Incomes from "./components/incomes/Incomes.vue";
import Expenses from "./components/expenses/Expenses.vue";
import IncomesForm from "./components/incomes/IncomesForm.vue";
import ExpenseForm from "./components/expenses/ExpenseForm.vue";
import Auth from "./layout/Auth.vue";
import Register from "./components/auth/Register.vue";
import Login from "./components/auth/Login.vue";
import Main from "./layout/Main.vue";

const routes = [
    {
        path: "/",
        redirect: "/auth_register/:scope?",
        component: Auth,
        children: [
            {
                path: "/auth_register/:scope?",
                component: Register,
            },
            {
                path: "/auth_login/:scope?",
                name: "login",
                component: Login,
            },
        ],
    },
    {
        path: "/app",
        redirect: "/app/home",
        component: Main,
        children: [
            {
                path: "/app/home",
                name: "home",
                component: Home
            },
            {
                path: "/app/expenses",
                component: Expenses
            },
            {
                path: "/app/incomes",
                component: Incomes
            },
            {
                path: "/incomes/create",
                component: IncomesForm
            },
            {
                path: "/expenses/create",
                component: ExpenseForm
            },
        ]
    },

    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
