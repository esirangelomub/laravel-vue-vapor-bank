<template>
    <h3 class="font-weight-medium mt-5 mb-5 text-uppercase w-100 text-center" :class="!this.isAdmin ? 'text-blue': 'text-green'">
        Login
    </h3>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation>

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
            @click="login()">
            <span v-html="!this.isAdmin ? 'Login': 'Login Admin'"></span>
        </v-btn>

        <v-divider class="mt-10 mb-8"></v-divider>

        <v-btn variant="plain"
               :color="!this.isAdmin ? 'blue': 'green'"
               block
               :to="!this.isAdmin ? '/auth_register': '/auth_register/admin'">
            Do not have an account?
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
import {useRoute} from "vue-router/dist/vue-router";

export default {
    data: () => ({
        valid: true,
        snackbar: false,
        message: '',
        message_type: 'blue',
        email: '',
        emailRules: [
            v => !!v || 'Email is required',
        ],
        password: '',
        passwordRules: [
            v => !!v || 'Password is required',
        ],
        scope: 'customer-all'
    }),
    computed: {
        isAdmin() {
            const route = useRoute();
            const isAdmin = route.params.scope ?? false;
            this.scope = isAdmin ? 'customer-all': 'admin-all'
            return isAdmin;
        }
    },
    methods: {
        login() {
            this.$axios
                .post('/token', {
                    email: this.email,
                    password: this.password,
                    scope: this.scope
                })
                .then(response => {
                    if (!response.data.data.token) {
                        this.showSnackBar({
                            status: false,
                            message: "Unauthorised!"
                        });
                        return;
                    }

                    localStorage.setItem('access_token', response.data.data.token);
                    this.showSnackBar({
                        status: true,
                        message: "Login successful!"
                    });
                    setTimeout(() => {
                        this.$router.push({ name: !this.isAdmin ? 'home' : 'approve' })
                    }, 500);
                })
                .catch(error => {
                    this.showSnackBar(error.response.data);
                });
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
