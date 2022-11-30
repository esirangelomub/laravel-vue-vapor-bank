<template>
    <div>
        <v-app-bar
            class="box-shadow-none bg-blue-lighten-3 text-white"
            density="compact">

            <template v-slot:prepend>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            </template>

            <v-app-bar-title class="headline text-uppercase mr-4">
                {{ title }}
            </v-app-bar-title>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            temporary>
            <v-card width="full"
                    rounded="0"
                    color="blue">
                <v-card-title class="headline text-uppercase align-center mr-4">
                    <span class="font-weight-regular">BNB</span>
                    <span class="font-weight-light">Bank</span>
                </v-card-title>
                <v-card-text>
                    <v-list density="compact" nav>
                        <v-list-item prepend-icon="mdi-view-dashboard-outline" title="Home" value="home" to="/app/home"></v-list-item>

                        <v-list-item prepend-icon="mdi-call-made" title="Incomes" value="users"
                                     to="/app/incomes"></v-list-item>
                        <v-list-item prepend-icon="mdi-call-received" title="Expenses" value="account"
                                     to="/app/expenses"></v-list-item>
                        <v-divider></v-divider>
                        <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout" @click="logout()"></v-list-item>
                    </v-list>
                </v-card-text>
            </v-card>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            drawer: false
        }
    },
    computed: {
        title() {
            return 'Home'
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('access_token');
            setTimeout(() => {
                this.$router.push({ name: 'login', params: { scope: 'customer' } })
            }, 300);
        }
    }
}
</script>

<style scoped>
    .box-shadow-none {
        box-shadow: none !important;
    }
</style>
