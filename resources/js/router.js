import {createWebHistory, createRouter} from "vue-router";
import Home from "./components/Home.vue";
import Incomes from "./components/incomes/Incomes.vue";
import Expenses from "./components/expenses/Expenses.vue";
import IncomesForm from "./components/incomes/IncomesForm.vue";
import ExpenseForm from "./components/expenses/ExpenseForm.vue";

const routes = [
    {
        path: "/",
        component: Home,
    },
    {
        path: "/expenses",
        component: Expenses
    },
    {
        path: "/incomes",
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
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
