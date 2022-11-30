<template>
    <div>
        <v-tabs
            v-model="tab"
            fixed-tabs
            center-active
            class="bg-green text-white">
            <v-tab value="one">PENDING</v-tab>
            <v-tab value="two">ACCEPTED</v-tab>
            <v-tab value="three">REJECTED</v-tab>
        </v-tabs>

        <v-window v-model="tab">
            <v-window-item value="one">
                <v-list>
                    <v-list-subheader class="font-weight-medium text-green mt-2 mb-2 text-uppercase">
                        Pending Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesPending">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-green py-3">
                            <template v-slot:append>
                                <div>
                                    <span class="font-weight-bold text-green">
                                        {{ $filters.currency(item.deposit_value) }}
                                    </span>
                                    <v-btn-toggle color="green">
                                        <v-btn variant="tonal" size="x-small" @click="changeStatus('ACCEPTED', item)">
                                            <v-icon>mdi-check</v-icon>
                                        </v-btn>

                                        <v-btn variant="tonal" size="x-small" @click="changeStatus('REJECTED', item)">
                                            <v-icon>mdi-cancel</v-icon>
                                        </v-btn>
                                    </v-btn-toggle>
                                </div>
                            </template>
                        </v-list-item>
                        <v-divider class="divider-light"></v-divider>
                    </template>
                </v-list>
            </v-window-item>

            <v-window-item value="two">
                <v-list>
                    <v-list-subheader class="font-weight-medium text-green mt-2 mb-2 text-uppercase">
                        Accepted Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesAccepted">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-green py-3">
                            <template v-slot:append>
                                <span class="font-weight-bold text-green">
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
                    <v-list-subheader class="font-weight-medium text-green mt-2 mb-2 text-uppercase">
                        Rejected Incomes
                    </v-list-subheader>
                    <template v-for="item in incomesRejected">
                        <v-list-item
                            :title="item.description"
                            :subtitle="$filters.formatDate(item.created_at)"
                            class="text-green py-3">
                            <template v-slot:append>
                                <span class="font-weight-bold text-green">
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
            color="green"
            icon="mdi-plus"
            fab
            size="large"
            class="fab-button"></v-btn>

    </div>
    <v-snackbar
        v-model="snackbar">
        {{ message }}
        <template v-slot:actions>
            <v-btn
                :color="message_type"
                variant="text"
                @click="snackbar = false">
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>


export default {
    data() {
        return {
            tab: null,
            incomes: [],
            snackbar: false,
            message: '',
            message_type: 'blue',
        }
    },
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
        this.load()
    },
    methods: {
        changeStatus(status, item) {
            this.$axios
                .put(`/income/${item.id}`, {'status': status})
                .then(response => {
                    this.showSnackBar(response.data)
                    this.load();
                })
                .catch(error => {
                    this.showSnackBar(error.response.data)
                })
        },
        load() {
            this.$axios
                .get('/income')
                .then(response => (this.incomes = response.data.data))
        },
        showSnackBar(response) {
            this.snackbar = true;
            this.message = response.message
            this.message_type = response.status ? 'blue' : 'pink'
        }
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
