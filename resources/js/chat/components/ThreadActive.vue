<template>

    <div @click="switchThread(thread.id)" class="item">
        <a href="#" class="user-status-box">
            <div class="avatar-xs mx-auto d-block chat-user-img online">

                <img v-if="thread.user.avatar != ''" :src="asset(thread.user.avatar)" alt="user-img" class="img-fluid rounded-circle">
                <span v-else class="avatar-title rounded-circle bg-soft-primary text-primary">
                    {{ firstCharacterOfName }}
                </span>

                <span class="user-status"></span>
            </div>

            <h5 class="font-size-13 text-truncate mt-3 mb-1">{{ thread.user.name }}</h5>
        </a>
    </div>

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'

    export default {
        props: [
            'thread',
        ],
        computed: {
            firstCharacterOfName: function(){
                return this.thread.user.name[0].toUpperCase()
            }
        },
        methods: mapActions(['switchThread']),
        mounted() {
            console.log('ThreadActive Component mounted.')
        }
    }

</script>

<style lang="scss">

</style>
