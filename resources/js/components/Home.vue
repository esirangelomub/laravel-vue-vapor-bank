<template>
    <div>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-3 text-white"
                :title="'Balance'"
                :subtitle="$filters.currency(balance)">
        </v-card>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-4 text-blue"
                :title="'Incomes'"
                :subtitle="$filters.currency(total_incomes)">

            <template v-slot:append>
                <div class="append-flex">
                    <v-btn variant="plain" icon="mdi-plus" size="large" to="/app/incomes" flat></v-btn>
                    <small>DEPOSIT A CHECK</small>
                </div>
            </template>
        </v-card>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-5 text-blue"
                :title="'Expenses'"
                :subtitle="$filters.currency(total_expenses)">

            <template v-slot:append>
                <div class="append-flex">
                    <v-btn variant="plain" icon="mdi-plus" to="/app/expenses" flat></v-btn>
                    <small>PURCHASE</small>
                </div>
            </template>
        </v-card>

        <v-list>
            <v-list-subheader class="font-weight-medium text-blue mt-2 mb-2 text-uppercase">
                Transactions
            </v-list-subheader>
            <template v-for="transaction in transactions">
                <v-list-item
                    :title="transaction.name"
                    :subtitle="$filters.formatDate(transaction.created_at)"
                    class="text-blue py-3">
                    <template v-slot:append>
                        <span class="font-weight-bold"
                              :class="transaction.type === 'expense' ? 'text-red' : 'text-blue'">
                                {{ $filters.currency(transaction.value) }}
                        </span>
                    </template>
                </v-list-item>
                <v-divider class="divider-light"></v-divider>
            </template>
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
    computed: {
        balance() {
            return 1234545
        }
    },
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
                this.transactions = data.sort((a, b) => new Date(a.created_at).getTime() - new Date(b.created_at).getTime())
            })

    }
}
</script>

<style scoped>
    .text-red::before {
        content: '-';
    }
    .append-flex {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 110px;
        margin-top: -15px;
    }
    .append-flex small {
        margin-top: -10px;
        font-size: 70%
    }
</style>
