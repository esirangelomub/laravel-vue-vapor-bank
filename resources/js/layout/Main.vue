<template>
    <Header></Header>
    <v-main>
        <v-container fluid>
            <router-view></router-view>
        </v-container>
    </v-main>
</template>

<script>
import Header from "../components/Header.vue";

export default {
    components: {Header}
}
</script>

<style scoped>

</style>
