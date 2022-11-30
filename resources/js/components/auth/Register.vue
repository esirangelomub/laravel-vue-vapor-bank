<template>
    <h3 class="font-weight-medium text-blue mt-5 mb-5 text-uppercase w-100 text-center">
        Register
    </h3>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation>
        <v-text-field
            color="blue"
            label="Name"
            placeholder="Name"
            v-model="name"
            :rules="nameRules"
            variant="outlined"
            class="my-3">
        </v-text-field>

        <v-text-field
            color="blue"
            label="Email"
            placeholder="Email"
            type="email"
            v-model="email"
            :rules="emailRules"
            variant="outlined"
            class="my-3">
        </v-text-field>

        <v-text-field
            color="blue"
            label="Password"
            placeholder="Password"
            type="password"
            v-model="password"
            :rules="passwordRules"
            variant="outlined"
            class="my-3">
        </v-text-field>

        <v-btn
            class="my-3"
            block
            color="blue"
            @click="save()">
            Sign Up
        </v-btn>

        <v-divider class="mt-10 mb-8"></v-divider>

        <v-btn variant="plain"
               color="blue"
               block
               flat to="/auth/login">
            Already have an account?
        </v-btn>
    </v-form>


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
        name: '',
        nameRules: [
            v => !!v || 'Name is required',
        ],
        email: '',
        emailRules: [
            v => !!v || 'Email is required',
        ],
        password: '',
        passwordRules: [
            v => !!v || 'Password is required',
        ],
    }),
    methods: {
        save() {
            const account = {
                account_types_id: 1,
                name: this.name,
                email: this.email,
                password: this.password,
            }
            this.$axios
                .post('/account', account)
                .then(response => {
                    this.showSnackBar(response.data)
                    this.$refs.form.reset();
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
    }
}
</script>

<style scoped>

</style>
