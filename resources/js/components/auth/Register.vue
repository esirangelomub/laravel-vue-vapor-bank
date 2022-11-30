<template>
    <h3 class="font-weight-medium mt-5 mb-5 text-uppercase w-100 text-center" :class="!this.isAdmin ? 'text-blue': 'text-green'">
        Register
    </h3>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation>
        <v-text-field
            v-if="!this.isAdmin"
            :color="!this.isAdmin ? 'blue': 'green'"
            label="Name"
            placeholder="Name"
            v-model="name"
            :rules="nameRules"
            variant="outlined"
            class="my-3">
        </v-text-field>

        <v-text-field
            :color="!this.isAdmin ? 'blue': 'green'"
            label="Email"
            placeholder="Email"
            type="email"
            v-model="email"
            :rules="emailRules"
            variant="outlined"
            class="my-3">
        </v-text-field>

        <v-text-field
            v-if="!this.isAdmin"
            :color="!this.isAdmin ? 'blue': 'green'"
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
            :color="!this.isAdmin ? 'blue': 'green'"
            @click="save()">
            <span v-html="!this.isAdmin ? 'Sign Up': 'Sign Up Admin'"></span>
        </v-btn>

        <v-divider class="mt-10 mb-8"></v-divider>

        <v-btn variant="plain"
               :color="!this.isAdmin ? 'blue': 'green'"
               block
               flat
               :to="!this.isAdmin ? '/auth_login/customer': '/auth_login/admin'">
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
import { useRoute } from 'vue-router'

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
        account_types_id: 1,
        scope: 'customer-all'
    }),
    computed: {
        isAdmin() {
            const route = useRoute();
            const isAdmin = route.params.scope === 'admin' ?? false;
            this.scope = !isAdmin ? 'customer-all': 'admin-all'
            this.account_types_id = !isAdmin ? 1 : 2
            return isAdmin;
        }
    },
    methods: {
        save() {
            const account = {
                account_types_id: this.account_types_id,
                name: this.name,
                email: this.email,
                password: this.password,
                scope: this.scope
            }
            this.$axios
                .post('/account', account)
                .then(response => {
                    localStorage.setItem('access_token', response.data.token);
                    this.showSnackBar(response.data)
                    setTimeout(() => {
                        this.$router.push({ name: !this.isAdmin ? 'home' : 'admin' })
                    }, 1000);
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
