<template>
    <div>
        <v-app-bar
            color="primary"
            density="compact">

            <template v-slot:prepend>
                <v-app-bar-nav-icon @click.stop="rail = !rail"></v-app-bar-nav-icon>
            </template>

            <v-app-bar-title class="headline text-uppercase mr-4">
                <span>BNB</span>
                <span class="font-weight-light">Bank</span>
            </v-app-bar-title>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            :rail="rail"
            permanent
            @click="rail = false">
            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item prepend-icon="mdi-home-city" title="Home" value="home" to="home"></v-list-item>
                <v-list-item prepend-icon="mdi-account" title="Expenses" value="account" to="/app/expenses"></v-list-item>
                <v-list-item prepend-icon="mdi-account-group-outline" title="Incomes" value="users" to="/app/incomes"></v-list-item>
                <v-divider></v-divider>
                <v-list-item prepend-icon="mdi-account-group-outline" title="Logout" value="logout" to="/auth/login"></v-list-item>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    data () {
        return {
            drawer: true,
            items: [
                { title: 'Home', icon: 'mdi-home-city' },
                { title: 'My Account', icon: 'mdi-account' },
                { title: 'Users', icon: 'mdi-account-group-outline' },
            ],
            rail: true,
        }
    },
    computed: {

    },
    methods: {

    }
}
</script>

<style scoped>

</style>
