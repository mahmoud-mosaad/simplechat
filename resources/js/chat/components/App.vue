<template>

    <div v-if="loadingStatus" class="center-div">
        <fingerprint-spinner
            :animation-duration="2500"
            :size="128"
            color="#7269ef"
        />
    </div>
    <chat-app v-else></chat-app>

</template>

<script>

    import ChatApp from './ChatApp.vue'
    import { FingerprintSpinner } from 'epic-spinners'

    export default {
        computed: {
            loadingStatus(){
                return this.$store.state.loadingStatus
            },
        },
        components: {
            'chat-app': ChatApp,
            'fingerprint-spinner': FingerprintSpinner,
        },
        mounted(){
            console.log('App Component mounted.')
        }
    }

</script>

<style lang="scss">

    .center-div
    {
        position: absolute;
        margin: auto;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 100px;
        border-radius: 3px;
    }

</style>
