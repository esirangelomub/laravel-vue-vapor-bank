<template>
    <div>
        <v-list>
            <v-list-item
                :title="'Incomes'"
                :subtitle="$filters.currency(total_incomes)">
                <template v-slot:append>
                    <v-btn
                        to="/app/incomes"
                        color="grey-lighten-1"
                        icon="mdi-plus"
                        variant="text"></v-btn>
                </template>
            </v-list-item>
            <v-list-item
                :title="'Expenses'"
                :subtitle="$filters.currency(total_expenses)">
                <template v-slot:append>
                    <v-btn
                        to="/app/expenses"
                        color="grey-lighten-1"
                        icon="mdi-plus"
                        variant="text"></v-btn>
                </template>
            </v-list-item>
        </v-list>

        <v-list>
            <v-list-item
                v-for="transaction in transactions"
                :title="transaction.name"
                :subtitle="$filters.formatDate(transaction.created_at)">
                <template v-slot:append>
                    {{ $filters.currency(transaction.value) }}
                </template>
            </v-list-item>
        </v-list>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        total_incomes: 0,
        total_expenses: 0,
        transactions: []
    }),
    mounted () {
        axios
            .all([
                this.$axios.get('/income'),
                this.$axios.get('/expense')
            ])
            .then(responses => {
                let data = [];
                responses.forEach(response => {
                    response.data.data.forEach(item => {
                        data.push({
                            type: item.deposit_value ? 'income' : 'expense',
                            name: item.description,
                            created_at: item.created_at,
                            value: item.deposit_value ? item.deposit_value : item.expense_value,
                        })
                        if (item.deposit_value) {
                            this.total_incomes += parseFloat(item.deposit_value)
                        }
                        if (item.expense_value) {
                            this.total_expenses += parseFloat(item.expense_value)
                        }
                    })
                })
                console.log(data)
                this.transactions = data.sort((a, b) => new Date(a.created_at).getTime() - new Date(b.created_at).getTime())
            })

    }
}
</script>

<style scoped>

</style>
