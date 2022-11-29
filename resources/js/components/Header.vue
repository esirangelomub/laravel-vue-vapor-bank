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
                <v-list-item prepend-icon="mdi-home-city" title="Home" value="home"></v-list-item>
                <v-list-item prepend-icon="mdi-account" title="My Account" value="account"></v-list-item>
                <v-list-item prepend-icon="mdi-account-group-outline" title="Users" value="users"></v-list-item>
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
