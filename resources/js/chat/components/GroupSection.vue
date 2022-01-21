<template>


    <div>
        <div class="p-4">
            <div class="user-chat-nav float-end">
                <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Create group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-link text-decoration-none text-muted font-size-18 py-0" data-bs-toggle="modal" data-bs-target="#addgroup-exampleModal">
                        <i class="ri-group-line me-1 ms-0"></i>
                    </button>
                </div>

            </div>
            <h4 class="mb-4">المجموعات</h4>

            <!-- Start add group Modal -->
            <div ref="createGroupModal" class="modal fade" id="addgroup-exampleModal" tabindex="-1" role="dialog" aria-labelledby="addgroup-exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-size-16" id="addgroup-exampleModalLabel">إنشاء مجموعة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <div class="modal-body p-4">
                            <form id="add_group_form">

                                <div class="mb-4">
                                    <label for="addgroupname-input" class="form-label">الإسم</label>
                                    <input required v-model="groupName" name="name" type="text" class="form-control" id="addgroupname-input" placeholder="إدخل إسم المجموعة">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">الأعضاء</label>
                                    <div class="mb-3">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#groupmembercollapse" aria-expanded="false" aria-controls="groupmembercollapse">
                                            إختر الأعضاء
                                        </button>
                                    </div>

                                    <div class="collapse" id="groupmembercollapse">
                                        <div class="card border">
                                            <div class="card-header">
                                                <h5 class="font-size-15 mb-0">جهات الإتصال</h5>
                                            </div>
                                            <div class="card-body p-2">
                                                <div data-simplebar="init" style="max-height: 250px;">
                                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                                                    <div class="simplebar-content" style="padding: 0px;">
                                                                        <div v-for="(contactSet, office, index) in contacts">
                                                                            <div class="p-3 fw-bold text-primary">
                                                                                {{ office }}
                                                                            </div>

                                                                            <ul class="list-unstyled contact-list">
                                                                                <li v-for="(contact, idx) in contactSet" :key="contact.id">
                                                                                    <div v-if="contact.id != authUser.id" class="form-check">
                                                                                        <input name="users[]" :value="contact.id" type="checkbox" class="form-check-input" :id="'memberCheck' + index + idx">
                                                                                        <label class="form-check-label" :for="'memberCheck' + index + idx">{{ contact.name }}</label>
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
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="addgroupdescription-input" class="form-label">الوصف</label>
                                    <textarea v-model="groupDescription" name="description" class="form-control" id="addgroupdescription-input" rows="3" placeholder="إدخل وصف المجموعة"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="addgroupmessage-input" class="form-label">رسالة إفتتاحية</label>
                                    <textarea required v-model="groupMessage" name="message" class="form-control" id="addgroupmessage-input" rows="3" placeholder="إدخل إفتتاحية المجموعة"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">إغلاق</button>
                            <button @click="sendGroupMessage(messageInfo)" type="button" class="btn btn-primary">إنشىء المجموعة</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End add group Modal -->

            <div class="search-box chat-search-box">
                <div class="input-group rounded-3">
                    <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
                        <i class="ri-search-line search-icon font-size-18"></i>
                    </span>
                    <input v-model="searchTerm" @input="filterThreads"  type="text" class="form-control bg-light" placeholder="إبحث بإسم المجموعة" aria-label="Search groups..." aria-describedby="basic-addon1">
                </div>
            </div> <!-- Search Box-->
        </div>

        <thread-section
            :type="'groups'"
        ></thread-section>

    </div>

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'
    import ThreadSection from './ThreadSection.vue'

    export default {
        sockets: {
            group: function (data) {
                this.recieveGroupMessage(data)
            },
            registeredGroup: function (data) {
                this.$socket.emit('group', data)
            }
        },
        data: function() {
            return {
                searchTerm: '',
                groupMessage: '',
                groupName: '',
                groupDescription: '',
                messageInfo: {}
            }
        },
        components: {
            'thread-section': ThreadSection,
        },
        computed: {
            classObject: function () {
                return {

                }
            },
            contacts(){
                return this.$store.state.contacts
            },
            authUser(){
                return this.$store.state.authUser
            },
        },
        methods: {
            axiosURL(url){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                return (window._backpack_url || '') + '/' + url
            },
            async saveMessageToDB(formData){
                await axios.post(this.axiosURL('api/createChatGroup'), formData)
                    .then(response => (
                    this.messageInfo = response.data
                ))
            },
            async addChatGroup(){
                const form = $('#add_group_form')
                const formData = new FormData(form[0])
                await this.saveMessageToDB(formData)
            },
            ...mapActions({
                async sendGroupMessage (dispatch) {
                    const { groupMessage, groupName, groupDescription, authUser, messageInfo } = this
                    if (groupName.trim() && groupMessage.trim()) {
                        await this.addChatGroup()

                        const thread = { id: this.messageInfo.thread_id, name: groupName.trim(), description: groupDescription.trim(), type: 'group', users: this.messageInfo.thread_users }

                        const messageBody = {
                            id: this.messageInfo.id,
                            text: groupMessage,
                            timestamp: Date.parse(this.messageInfo.timestamp),
                            attachments: {},
                            record: {},
                            author: authUser,
                            thread: thread
                        }

                        dispatch('sendGroupMessage', messageBody)
                        
                        thread.users.forEach(user => {
                            this.$socket.emit('subscribeGroup', {message: messageBody, thread: this.messageInfo.thread_id, contact: user.id})
                        })
                        
                        this.groupMessage = ''
                        this.groupName = ''
                        this.groupDescription = ''
                        $('#add_group_form')[0].reset()
                        $(this.$refs.createGroupModal).modal('hide')
                    }
                },
                recieveGroupMessage (dispatch, data) {
                    dispatch('sendGroupMessage', {
                        id: data.id,
                        text: data.text,
                        timestamp: data.timestamp,
                        attachments: {},
                        record: {},
                        author: data.author,
                        thread: data.thread,
                    })
                },
                filterThreads(dispatch){
                    const {searchTerm} = this
                    dispatch('filterThreads', {
                        searchTerm,
                        par: 'group'
                    })
                },
            })
        },
        mounted() {
            console.log('GroupSection Component mounted.')
        }
    }

</script>

<style lang="scss">

</style>

