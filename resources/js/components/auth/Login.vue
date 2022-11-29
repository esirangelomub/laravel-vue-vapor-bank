<template>
    <v-container>
        <v-row justify="space-around">
            <v-card width="400">
                <v-img
                    height="200"
                    src="https://cdn.pixabay.com/photo/2020/07/12/07/47/bee-5396362_1280.jpg"
                    cover
                    class="text-white">
                </v-img>

                <v-card-text>
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation>

                        <v-text-field
                            label="Email"
                            placeholder="Email"
                            type="email"
                            v-model="email"
                            :rules="emailRules"
                            clearable
                            variant="outlined">
                        </v-text-field>

                        <v-text-field
                            label="Password"
                            placeholder="Password"
                            type="password"
                            v-model="password"
                            :rules="passwordRules"
                            clearable
                            variant="outlined">
                        </v-text-field>

                        <v-btn
                            block
                            color="blue"
                            @click="signIn()">
                            Sign In
                        </v-btn>

                        <v-divider class="mt-10 mb-8"></v-divider>

                        <v-btn variant="plain"
                               color="blue"
                               block
                               flat to="/auth/register">
                            Do not have an account?
                        </v-btn>
                    </v-form>
                </v-card-text>

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

            </v-card>
        </v-row>
    </v-container>
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
        signIn() {
            this.showSnackBar({
                status: true,
                message: "Login successful!"
            });
            setTimeout(() => {
                this.$router.push({ name: 'home' })
            }, 1000);
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
