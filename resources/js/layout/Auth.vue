<template>
    <v-app-bar
        class="box-shadow-none"
        color="blue"
        height="200">
        <v-app-bar-title class="headline headline-bottom text-uppercase mr-4 text-center ">
            <strong>BNB</strong> Bank
        </v-app-bar-title>
    </v-app-bar>
    <v-main>
        <v-container fluid class="pt-0 pl-0 pr-0">
            <v-card width="full"
                    rounded="0"
                    class="box-shadow-none">
                <v-card-text>
                    <router-view />
                </v-card-text>
            </v-card>
        </v-container>
    </v-main>
</template>
<script>
export default {

};
</script>

<style scoped>
    .box-shadow-none {
        box-shadow: none !important;
    }
    .headline-bottom {
        position: absolute;
        bottom: 10px;
        width: 100%;
        margin-inline-start: 0 !important;
    }
</style>
