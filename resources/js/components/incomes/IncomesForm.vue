<template>
    <div>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-text-field
                label="Amount"
                placeholder="Amount"
                type="text"
                v-model="deposit_value"
                :rules="depositValueRules"
                prepend-icon="mdi-vuetify"
                clearable
                variant="outlined">
                <template v-slot:append>
                    <span class="blue">USD</span>
                </template>
            </v-text-field>

            <v-text-field
                label="Description"
                placeholder="Description"
                type="text"
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
                DEPOSIT CHECK
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
        message_type: 'success',
        deposit_value: '',
        depositValueRules: [
            v => !!v || 'Amount is required',
        ],
        description: '',
        descriptionValueRules: [
            v => !!v || 'Description is required',
        ],
        deposit_voucher_path: 'https://img.freepik.com/vetores-gratis/modelo-de-cheque-em-branco-plano_23-2148998618.jpg?w=2000',
    }),
    methods: {
        save () {
            const income = {
                accounts_id: null,
                status: 'PENDING',
                deposit_value: this.deposit_value,
                description: this.description,
                deposit_voucher_path: this.deposit_voucher_path,
            }
            this.$axios
                .post('/income', income)
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
