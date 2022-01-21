<template>

    <li v-if="user" :class="classObject">
        <a href="#" @click="switchThread(id)">
            <div v-if="threadUser" class="d-flex">

                <div class="chat-user-img align-self-center me-3 ms-0" :class="statusObject">

                    <img v-if="threadUser.avatar != ''" :src="asset(threadUser.avatar)" class="rounded-circle avatar-xs" alt="">
                    <div v-else class="avatar-xs">
                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                            {{ firstCharacterOfName }}
                        </span>
                    </div>

                    <span v-if="threadUser.status" class="user-status"></span>
                </div>

                <div class="flex-1 overflow-hidden">
                    <h5 class="text-truncate font-size-15 mb-1">{{ threadUser.name }}</h5>
                    <p class="chat-user-message text-truncate mb-0">

                        <template v-if="userTyping && userTyping == 1">

                            يكتب
                            <span class="animate-typing">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </span>

                        </template>
                        <template v-if="lastMessage">

                            <template v-if="lastMessage.text">{{ lastMessage.text }}</template>

                            <template v-if="lastMessage.record && lastMessage.record.path">

                                <i class="ri-volume-up-fill align-middle me-1 ms-0"></i>

                                تسجيل صوتى

                            </template>

                            <template v-if="lastMessage.attachments && lastMessage.attachments.files">

                                <i class="ri-file-text-fill align-middle me-1 ms-0"></i>

                                {{ lastMessage.attachments.files[lastMessage.attachments.files.length-1].name }}

                            </template>

                            <template v-if="lastMessage.attachments && lastMessage.attachments.photos">

                                <i class="ri-image-fill align-middle me-1 ms-0"></i>

                                {{ lastMessage.attachments.photos[lastMessage.attachments.photos.length-1].name }}

                            </template>

                        </template>

                    </p>
                </div>

                <div v-if="lastMessage && lastMessage.timestamp" class="font-size-11">{{ lastMessage.timestamp | time }}</div>

                <div v-if="unreadMessages" class="unread-message">
                    <span class="badge badge-soft-danger rounded-pill">{{ unreadMessages }}</span>
                </div>
            </div>
        </a>
    </li>
    <li v-else :class="classObject">
        <a href="#" @click="switchThread(id)">
            <div class="d-flex align-items-center">
                <div class="chat-user-img me-3 ms-0">
                    <div class="avatar-xs">
                        <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                            {{ firstCharacterOfName }}
                        </span>
                    </div>
                </div>
                <div class="flex-1 overflow-hidden">
                    <h5 class="text-truncate font-size-14 mb-0">#{{ group.name }}  <span v-if="unreadMessages" class="badge badge-soft-danger rounded-pill float-end">+{{ unreadMessages }}</span> </h5>
                </div>
            </div>
        </a>
    </li>

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'

    export default {
        data: function() {
            return {

            }
        },
        props: [
            'id',
            'user',
            'users',
            'group',
            'active',
            'userTyping',
            'lastMessage',
            'unreadMessages',
        ],
        computed: {
            classObject: function () {
                return {
                    active: this.active && this.active == 1,
                    typing: this.userTyping && this.userTyping == 1,
                    unread: this.unreadMessages,
                }
            },
            authUser(){
                return this.$store.state.authUser
            },
            threadUser(){
                return this.users[0].id == this.authUser.id ? this.users[1] : this.users[0]
            },
            statusObject: function () {
                return {
                    online: this.threadUser && this.threadUser.status == 'online',
                    away: this.threadUser && this.threadUser.status == 'away',
                    '': !this.threadUser || this.threadUser && this.threadUser.status == 'offline',
                }
            },
            firstCharacterOfName: function(){
                if(this.user && this.threadUser && this.threadUser.name)
                    return this.threadUser.name[0].toUpperCase()
                else if (this.group && this.group.name)
                    return this.group.name[0].toUpperCase()
                else
                    return ''
            },
        },
        methods: {
            ...mapActions(['switchThread'])
        },
        mounted() {
            console.log('ChatUser Component mounted.')
        }
    }

</script>

<style lang="scss">

</style>
