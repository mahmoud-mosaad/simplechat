<template>

    <li :class="classObject">

        <div v-if="splitter" class="chat-day-title">
            <span class="title">{{ splitter }}</span>
        </div>
        <div v-else class="conversation-list">
            <div class="chat-avatar">
                <img v-if="userAvatar && userAvatar != ''" :src="asset(userAvatar)" alt="">
                <div v-else class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                        {{ firstCharacterOfName }}
                    </span>
                </div>

            </div>

            <div class="user-chat-content">

                <div v-if="typingOnly" class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <p class="mb-0">
                            typing
                            <span class="animate-typing">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </span>
                        </p>
                    </div>
                </div>
                <message v-else v-for="msg in messages" :key="msg.messageId"

                    :text="msg.text"
                    :timestamp="msg.timestamp"
                    :attachments="msg.attachments"
                    :record="msg.record"

                ></message>

                <div class="conversation-name">{{ userName }}</div>
            </div>
        </div>

    </li>

</template>

<script>

    import Message from './Message.vue'

    export default {
        data: function() {
            return {

            }
        },
        components: {
            'message': Message,
        },
        props: [
            'userId',
            'userName',
            'userAvatar',
            'typingOnly',
            'messages',
            'splitter',
        ],
        computed: {
            authUserId(){
                return this.$store.state.authUser.id
            },
            firstCharacterOfName: function(){
                return this.userName[0].toUpperCase()
            },
            classObject: function () {
                return {
                    right: this.splitter || this.userId == this.authUserId,
                    '': !this.splitter && this.userId != this.authUserId,
                }
            }
        },
        mounted() {
            console.log('MessageWrapper Component mounted.')
        }
    }

</script>

<style lang="scss">

</style>
