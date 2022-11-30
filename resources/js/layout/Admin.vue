<template>
    <div>
        <v-app-bar
            color="green"
            class="box-shadow-none text-white"
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
                    color="green">
                <v-card-title class="headline text-uppercase align-center mr-4">
                    <span class="font-weight-regular">BNB</span>
                    <span class="font-weight-light">Bank</span>
                </v-card-title>
                <v-card-text>
                    <v-list density="compact" nav>
                        <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout" @click="logout()"></v-list-item>
                    </v-list>
                </v-card-text>
            </v-card>
        </v-navigation-drawer>
    </div>
    <v-main>
        <v-container fluid class="pt-0 pl-0 pr-0">
            <router-view></router-view>
        </v-container>
    </v-main>
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
                this.$router.push({ name: 'login' })
            }, 300);
        }
    }
}
</script>

<style scoped>

</style>
