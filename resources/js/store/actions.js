import axiosInstance from "../plugins/axios";

export default {
    loadIncomes({ commit }) {
        this.$axios
            .get('/incomes')
            .then(resp => {
                console.log(resp)
                const data = resp.data
                if(data) {
                    commit('setIncomes', data.incomes)
                }
            })
        // Vue.prototype.$http.get('data.json')
        //     .then(resp => {
        //         const data = resp.data
        //         if(data) {
        //             commit('setStocks', data.stocks)
        //             commit('setPortfolio', {
        //                 funds: data.funds,
        //                 stockPortfolio: data.stockPortfolio
        //             })
        //         }
        //     })
    }
}
