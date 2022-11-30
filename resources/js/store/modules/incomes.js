export default {
    state: {
        incomes: []
    },
    mutations: {
        setIncomes(state, incomes) {
            state.incomes = incomes
        }
    },
    actions: {
        saveIncome({ commit }, order) {
            commit('saveIncome', order)
        },
        changeStatusIncome({ commit }, order) {
            commit('changeStatusIncome', order)
        },
        initIncomes({ commit }) {
            commit('setIncomes', incomes)
        }
    },
    getters: {
        incomes(state) {
            return state.incomes
        }
    }
}
