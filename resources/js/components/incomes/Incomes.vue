<template>
    <div>
        <v-tabs
            v-model="tab"
            bg-color="primary">
            <v-tab value="one">PENDING</v-tab>
            <v-tab value="two">ACCEPTED</v-tab>
            <v-tab value="three">REJECTED</v-tab>
        </v-tabs>

        <v-window v-model="tab">
            <v-window-item value="one">
                <v-list>
                    <v-list-item
                        v-for="item in incomesPending"
                        :title="item.description"
                        :subtitle="$filters.formatDate(item.created_at)">
                        <template v-slot:append>
                            {{ $filters.currency(item.deposit_value) }}
                        </template>
                    </v-list-item>
                </v-list>
            </v-window-item>

            <v-window-item value="two">
                <v-list>
                    <v-list-item
                        v-for="item in incomesAccepted"
                        :title="item.description"
                        :subtitle="$filters.formatDate(item.created_at)">
                        <template v-slot:append>
                            {{ $filters.currency(item.deposit_value) }}
                        </template>
                    </v-list-item>
                </v-list>
            </v-window-item>

            <v-window-item value="three">
                <v-list>
                    <v-list-item
                        v-for="item in incomesRejected"
                        :title="item.description"
                        :subtitle="$filters.formatDate(item.created_at)">
                        <template v-slot:append>
                            {{ $filters.currency(item.deposit_value) }}
                        </template>
                    </v-list-item>
                </v-list>
            </v-window-item>
        </v-window>

        <v-btn
            flat
            to="/incomes/create"
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
        incomes: []
    }),
    computed: {
        incomesPending() {
            return this.incomes.filter(element => element.status === 'PENDING')
        },
        incomesAccepted() {
            return this.incomes.filter(element => element.status === 'ACCEPTED')
        },
        incomesRejected() {
            return this.incomes.filter(element => element.status === 'REJECTED')
        }
    },
    mounted () {
        this.$axios
            .get('/income')
            .then(response => (this.incomes = response.data.data))
    }
}
</script>

<style scoped>

</style>
