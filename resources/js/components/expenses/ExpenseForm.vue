<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-text-field
                label="Amount"
                placeholder="Amount"
                v-model="expense_value"
                :rules="expenseValueRules"
                prepend-icon="mdi-vuetify"
                clearable
                variant="outlined">
                <template v-slot:append>
                    <span class="blue">USD</span>
                </template>
            </v-text-field>

            <v-text-field
                label="Date"
                placeholder="Date"
                v-model="created_at"
                :rules="createdAtRules"
                prepend-icon="mdi-vuetify"
                clearable
                variant="outlined">
            </v-text-field>

            <v-text-field
                label="Description"
                placeholder="Description"
                v-model="description"
                :rules="descriptionValueRules"
                prepend-icon="mdi-vuetify"
                clearable
                variant="outlined">
            </v-text-field>

            <v-btn
                block
                color="blue"
                @click="save()">
                Add Purchase
            </v-btn>
        </v-form>
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
    methods: {
        save () {
            const expense = {
                accounts_id: 7,
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

</style>
