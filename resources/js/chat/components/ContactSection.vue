<template>

    <div>
        <div class="p-4">
            <h4 class="mb-4">جهات الإتصال</h4>

            <!--<div class="search-box chat-search-box">-->
                <!--<div class="input-group bg-light  input-group-lg rounded-3">-->
                    <!--<div class="input-group-prepend">-->
                        <!--<button class="btn btn-link text-decoration-none text-muted pe-1 ps-3" type="button">-->
                            <!--<i class="ri-search-line search-icon font-size-18"></i>-->
                        <!--</button>-->
                    <!--</div>-->
                    <!--<input type="text" class="form-control bg-light" placeholder="إبحث عن جهة إتصال">-->
                <!--</div>-->
            <!--</div>-->
        </div>

        <!-- Start contact lists -->
        <div class="p-4 chat-message-list chat-group-list" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -24px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 24px;">

                            <div v-for="(contactSet, firstChar, index) in contacts">
                                <div class="p-3 fw-bold text-primary">
                                    {{ firstChar.toUpperCase() }}
                                </div>

                                <ul class="list-unstyled contact-list">
                                    <li v-for="contact in contactSet" :key="contact.id" @click="showMessagesModal(contact)">
                                        <div v-if="contact.id != authUser.id" class="d-flex align-items-center">
                                            <div class="flex-1">
                                                <h5 class="font-size-14 m-0">{{ contact.name }}</h5>
                                            </div>
                                            <!-- <div class="dropdown">
                                                <a href="#" class="text-muted dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-more-2-fill"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Share <i class="ri-share-line float-end text-muted"></i></a>
                                                    <a class="dropdown-item" href="#">Block <i class="ri-forbid-line float-end text-muted"></i></a>
                                                    <a class="dropdown-item" href="#">Remove <i class="ri-delete-bin-line float-end text-muted"></i></a>
                                                </div>
                                            </div> -->
                                        </div>
                                    </li>

                                </ul>
                            </div>

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
        <!-- end contact lists -->

        <!-- Start send message Modal -->
        <div ref="messagesModal" class="modal fade" id="sendmessage-exampleModal" tabindex="-1" role="dialog" aria-labelledby="sendmessage-exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-size-16" id="addgroup-exampleModalLabel">إرسال رسالة إلى {{ contactInfo.name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <img v-if="contactInfo.avatar && contactInfo.avatar != ''" :src="asset(contactInfo.avatar)" class="rounded-circle avatar-lg img-thumbnail" alt="">
                            <div v-else class="avatar-first-character avatar-title rounded-circle avatar-lg img-thumbnail bg-soft-primary text-primary" style="font-size:35px">
                                {{ firstCharacterOfName }}
                            </div>
                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="addgroupdescription-input" class="form-label">الرسالة</label>
                                <textarea v-model="contactMessage" class="form-control" id="addgroupdescription-input" rows="3" placeholder="إكتب رسالتك"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">إغلاق</button>
                        <button @click="sendContactMessage(contactInfo)" type="button" class="btn btn-primary">إرسل</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End send message Modal -->

    </div>

</template>


<script>

    import { mapActions, mapGetters } from 'vuex'

    export default {
        sockets: {
            contact: function (data) {
                this.recieveContactMessage(data)
            },
            registered: function (data) {
                this.$socket.emit('contact', data)
            }
        },
        data: function() {
            return {
                contactInfo: {
                    id: '',
                    name: '',
                    avatar: '',
                },
                contactMessage: '',
                threadId: '',
                messageInfo: ''
            }
        },
        computed: {
            firstCharacterOfName(){
                return this.contactInfo.name ? this.contactInfo.name[0].toUpperCase() : ''
            },
            contacts(){
                return this.$store.state.contacts
            },
            authUser(){
                return this.$store.state.authUser
            },
            currentThreadID: function (){
                return this.$store.state.currentThreadID
            },
        },
        methods: {
            axiosURL(url){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                return (window._backpack_url || '') + '/' + url
            },
            showMessagesModal(contact){
                this.contactInfo.name = contact.name
                this.contactInfo.avatar = contact.avatar
                this.contactInfo.id = contact.id
                $(this.$refs.messagesModal).modal('show')
            },
            async createUserThreadIfNot(users){
                await axios.post(this.axiosURL('api/createUserThread'), {users: users})
                    .then(response => (
                        this.threadId = response.data
                    ))
            },
            async saveMessageToDB(text, thread){
                await axios.post(this.axiosURL('api/createMessage'), { text: text, thread: thread, attachments: {}, record: {} })
                    .then(response => (
                    this.messageInfo = response.data
                ))
            },
            ...mapActions({
                async sendContactMessage (dispatch) {
                    const { contactMessage, contactInfo, authUser, messageInfo } = this
                    if (contactMessage.trim()) {
                        await this.createUserThreadIfNot([authUser.id, contactInfo.id])
                        const thread = { id: this.threadId, type: 'user', users: [authUser, contactInfo] }
                        await this.saveMessageToDB(contactMessage.trim(), thread)

                        const messageBody = {
                            id: this.messageInfo.id,
                            text: contactMessage,
                            timestamp: Date.parse(this.messageInfo.timestamp),
                            attachments: {},
                            record: {},
                            author: authUser,
                            thread: thread,
                            contact: contactInfo
                        }

                        dispatch('sendContactMessage', messageBody)
                        this.$socket.emit('subscribe', {message: messageBody, thread: this.threadId, contact: contactInfo.id})
                        this.contactMessage = ''
                        $(this.$refs.messagesModal).modal('hide')
                    }
                },
                recieveContactMessage (dispatch, data) {
                    dispatch('sendContactMessage', {
                        id: data.id,
                        text: data.text,
                        timestamp: data.timestamp,
                        attachments: {},
                        record: {},
                        author: data.author,
                        thread: data.thread,
                        contact: data.contact
                    })
                },
            }),
        },
        mounted() {
            console.log('ContactSection Component mounted.')
        }
    }

</script>

<style lang="scss">

    .avatar-first-character{
        height: 96px;
        width: 96px;
        margin-left: auto;
        margin-right: auto;
    }

</style>

