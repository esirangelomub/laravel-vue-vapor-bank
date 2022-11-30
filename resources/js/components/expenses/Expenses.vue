<template>
    <div>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-3 text-white"
                :title="'Balance'"
                :subtitle="$filters.currency(balance)">
        </v-card>
        <v-list>
            <template v-for="item in expenses">
                <v-list-item
                    :title="item.description"
                    :subtitle="$filters.formatDate(item.created_at)"
                    class="text-blue py-3">
                    <template v-slot:append>
                                <span class="font-weight-bold text-red">
                                    {{ $filters.currency(item.expense_value) }}
                                </span>
                    </template>
                </v-list-item>
                <v-divider class="divider-light"></v-divider>
            </template>
        </v-list>

        <v-btn
            flat
            to="/expenses/create"
            color="blue"
            icon="mdi-plus"
            fab
            size="large"
            class="fab-button"></v-btn>
    </div>
</template>

<script>

export default {
    data: () => ({
        tab: null,
        expenses: []
    }),
    computed: {
        balance() {
            return 1234545
        }
    },
    mounted () {
        this.$axios
            .get('/expense')
            .then(response => (this.expenses = response.data.data))
    }
}
</script>

<style scoped>
    .text-red::before {
        content: '-';
    }
    .fab-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
</style>
