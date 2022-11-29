<template>
    <div>
        <v-list>
            <v-list-item
                :title="'Incomes'"
                :subtitle="total_incomes">
                <template v-slot:append>
                    <v-btn
                        to="/incomes"
                        color="grey-lighten-1"
                        icon="mdi-plus"
                        variant="text"></v-btn>
                </template>
            </v-list-item>
            <v-list-item
                :title="'Expenses'"
                :subtitle="total_expenses">
                <template v-slot:append>
                    <v-btn
                        to="/expenses"
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
                :subtitle="transaction.created_at">
                <template v-slot:append>
                    {{transaction.value}}
                </template>
            </v-list-item>
        </v-list>
    </div>
</template>

<script>
export default {
    data: () => ({
        total_incomes: 7000,
        total_expenses: 2300,
        transactions: [
            {
                name: 't-shirt',
                created_at: '2022-01-01 10:20:00',
                value: '$40,00',
                type: 'expense'
            },
            {
                name: 'Freelancer Work',
                created_at: '2022-01-10 15:20:00',
                value: '$3000,00',
                type: 'income'
            }
        ]
    }),
    computed: {
        funds() {
            return this.$store.getters.funds
        }
    }
}
</script>

<style scoped>

</style>
