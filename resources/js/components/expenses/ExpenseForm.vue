<template>
    <div>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-3 text-white"
                :title="'Balance'"
                :subtitle="$filters.currency(balance)">
        </v-card>
        <v-card width="full"
                height="full"
                rounded="0"
                class="box-shadow-none pt-10 px-2">
            <v-card-text>
                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation>
                    <v-text-field
                        label="Amount"
                        placeholder="Amount"
                        v-model="expense_value"
                        :rules="expenseValueRules"
                        prepend-icon="mdi-currency-usd">
                        <template v-slot:append>
                            <span class="blue">USD</span>
                        </template>
                    </v-text-field>

                    <v-text-field
                        label="Date"
                        placeholder="Date"
                        v-model="created_at"
                        :rules="createdAtRules"
                        prepend-icon="mdi-calendar">
                    </v-text-field>

                    <v-text-field
                        label="Description"
                        placeholder="Description"
                        v-model="description"
                        :rules="descriptionValueRules"
                        prepend-icon="mdi-text">
                    </v-text-field>
                </v-form>
            </v-card-text>
        </v-card>
        <div class="form-button px-3">
            <v-btn
                size="large"
                block
                color="blue"
                @click="save()">
                ADD PURCHASE
            </v-btn>
        </div>
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
    data: () => ({
        valid: true,
        snackbar: false,
        message: '',
        message_type: 'blue',
        expense_value: '',
        expenseValueRules: [
            v => !!v || 'Amount is required',
        ],
        created_at: '',
        createdAtRules: [
            v => !!v || 'Date is required',
        ],
        description: '',
        descriptionValueRules: [
            v => !!v || 'Description is required',
        ],
    }),
    computed: {
        balance() {
            return 1234545
        }
    },
    methods: {
        save () {
            const expense = {
                accounts_id: null,
                expense_value: this.expense_value,
                description: this.description,
                created_at: this.created_at
            }
            this.$axios
                .post('/expense', expense)
                .then(response => {
                    this.showSnackBar(response.data)
                })
                .catch(error => {
                    this.showSnackBar(error.response.data)
                })
        },
        showSnackBar(response) {
            this.snackbar = true;
            this.message = response.message
            this.message_type = response.status ? 'blue' : 'pink'
        }
    },
}
</script>

<style scoped>
    .box-shadow-none {
        box-shadow: none !important;
    }
    .form-button {
        width: 100%;
        position: absolute;
        bottom: 10px;
    }
</style>
