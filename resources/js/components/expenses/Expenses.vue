<template>
    <div>
        <v-list>
            <v-list-item
                v-for="item in expenses"
                :title="item.description"
                :subtitle="$filters.formatDate(item.created_at)">
                <template v-slot:append>
                    {{ $filters.currency(item.expense_value) }}
                </template>
            </v-list-item>
        </v-list>
        <v-btn
            flat
            to="/expenses/create"
            color="success"
            icon="mdi-plus"
            size="x-large"
            absolute
            location="bottom right"
            fab></v-btn>
    </div>
</template>

<script>

export default {
    data: () => ({
        tab: null,
        expenses: []
    }),
    mounted () {
        this.$axios
            .get('/expense')
            .then(response => (this.expenses = response.data.data))
    }
}
</script>

<style scoped>

</style>
