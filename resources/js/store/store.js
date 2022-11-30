import { createStore } from 'vuex';
import actions from "../store/actions.js";
import expenses from '../store/modules/expenses.js'
import incomes from '../store/modules/incomes.js'

export default createStore({
    actions,
    modules: {
        expenses,
        incomes
    }
});
