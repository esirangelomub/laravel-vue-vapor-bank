<template>
    <div>
        <v-tabs
            v-model="tab"
            fixed-tabs
            center-active
            class="bg-blue-lighten-3 text-white">
            <v-tab value="one">PENDING</v-tab>
            <v-tab value="two">ACCEPTED</v-tab>
            <v-tab value="three">REJECTED</v-tab>
        </v-tabs>

        <v-window v-model="tab">
            <v-window-item value="one">
                <v-list>
                    <v-list-subheader class="font-weight-medium text-blue mt-2 mb-2 text-uppercase">
                        Pending Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesPending">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-blue py-3">
                            <template v-slot:append>
                                <span class="font-weight-bold text-blue">
                                    {{ $filters.currency(item.deposit_value) }}
                                </span>
                            </template>
                        </v-list-item>
                        <v-divider class="divider-light"></v-divider>
                    </template>
                </v-list>
            </v-window-item>

            <v-window-item value="two">
                <v-list>
                    <v-list-subheader class="font-weight-medium text-blue mt-2 mb-2 text-uppercase">
                        Accepted Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesAccepted">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-blue py-3">
                            <template v-slot:append>
                                <span class="font-weight-bold text-blue">
                                    {{ $filters.currency(item.deposit_value) }}
                                </span>
                            </template>
                        </v-list-item>
                        <v-divider class="divider-light"></v-divider>
                    </template>
                </v-list>
            </v-window-item>

            <v-window-item value="three">
                <v-list>
                    <v-list-subheader class="font-weight-medium text-blue mt-2 mb-2 text-uppercase">
                        Rejected Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesRejected">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-blue py-3">
                            <template v-slot:append>
                                <span class="font-weight-bold text-blue">
                                    {{ $filters.currency(item.deposit_value) }}
                                </span>
                            </template>
                        </v-list-item>
                        <v-divider class="divider-light"></v-divider>
                    </template>
                </v-list>
            </v-window-item>
        </v-window>

        <v-btn
            flat
            to="/incomes/create"
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
    .fab-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
</style>
