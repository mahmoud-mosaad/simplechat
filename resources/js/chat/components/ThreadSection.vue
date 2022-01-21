<template>

    <div v-if="type == 'users'" class="px-2">
        <h5 class="mb-3 px-3 font-size-16">أحدث الرسائل</h5>

        <div class="chat-message-list" data-simplebar="init">

            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="left: -17px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">

                                <ul class="list-unstyled chat-list chat-user-list">

                                    <thread v-for="userThread in filteredUserThreads" :key="userThread.id"

                                            :id="userThread.id "
                                            :active="userThread.id === currentThreadID"
                                            :user="userThread.user"
                                            :users="userThread.users"
                                            :last-message="userThread.lastMessage"
                                            :unread-messages="userThread.unreadMessages"

                                    ></thread>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 890px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
    </div>
    <div v-else class="p-4 chat-message-list chat-group-list" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -24px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 24px;">

                            <ul class="list-unstyled chat-list">

                                <thread v-for="groupThread in filteredGroupThreads" :key="groupThread.id"

                                    :id="groupThread.id "
                                    :active="groupThread.id === currentThreadID"
                                    :group="groupThread.group"
                                    :users="groupThread.users"
                                    :last-message="groupThread.lastMessage"
                                    :unread-messages="groupThread.unreadMessages"

                                ></thread>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
    </div>

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'
    import Thread from './Thread.vue'

    export default {
        data: function() {
            return {

            }
        },
        components: {
            'thread': Thread,
        },
        props: [
            'type',
        ],
        computed: {
            currentThreadID(){
                return this.$store.state.currentThreadID
            },
            filteredUserThreads(){
                return Object.values(this.$store.state.filteredUserThreads).filter(thread => thread.type === 'user')
            },
            filteredGroupThreads(){
                return Object.values(this.$store.state.filteredGroupThreads).filter(thread => thread.type === 'group')
            },
            ...mapGetters(['userThreads', 'groupThreads', 'unreadCount'])
        },
        methods: mapActions(['switchThread']),
        mounted() {
            console.log('ThreadSection Component mounted.')
        }
    }

</script>

<style lang="scss">

</style>

