<template>

    <!-- start chat conversation section -->
    <div class="w-100 overflow-hidden position-relative">
        <div class="p-3 p-lg-4 border-bottom user-chat-topbar">
            <div class="row align-items-center">
                <div class="col-sm-7 col-7">
                    <div class="d-flex align-items-center">
                        <div class="d-block d-lg-none me-2 ms-0">
                            <a @click="returnToThread" href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                        </div>
                        <div class="me-3 ms-0">
                            <img v-if="currentThread.type == 'user' && threadUser && threadUser.avatar != ''" :src="asset(threadUser.avatar)" class="rounded-circle avatar-xs" alt="">
                            <div v-else class="avatar-xs">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                    {{ firstCharacterOfName }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 @click="showProfile" class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">{{ currentThread.type == 'user' ? ( threadUser ? threadUser.name : '' ) : currentThread.group.name }}</a> <i class="ri-record-circle-fill font-size-10 text-success d-inline-block ms-1"></i></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-5">
                    <ul class="list-inline user-chat-nav text-end mb-0">
                        <!-- <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-search-line"></i>
                                </button>
                                <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-md">
                                    <div class="search-box p-2">
                                        <input type="text" class="form-control bg-light border-0" placeholder="Search..">
                                    </div>
                                </div>
                            </div>
                        </li> -->

                        <li v-if="!makingCall" class="list-inline-item">
                            <button @click="startCall(false)" type="button" class="btn nav-btn"> <!-- data-bs-toggle="modal" data-bs-target="#audiocallModal" -->
                                <i class="ri-phone-line"></i>
                            </button>
                        </li>

                        <li v-if="!makingCall" class="list-inline-item"> <!--  d-none d-lg-inline-block me-2 ms-0 -->
                            <button @click="startCall(true)" type="button" class="btn nav-btn"> <!--   data-bs-toggle="modal" data-bs-target="#videocallModal" -->
                                <i class="ri-vidicon-line"></i>
                            </button>
                        </li>

                        <li class="list-inline-item"><!--  d-none d-lg-inline-block me-2 ms-0 -->
                            <button @click="showProfile" type="button" class="btn nav-btn user-profile-show">
                                <i class="ri-user-2-line"></i>
                            </button>
                        </li>

                        <!-- <li class="list-inline-item">
                            <div class="dropdown">
                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-more-fill"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a @click="showProfile" class="dropdown-item d-block d-lg-none user-profile-show" href="#">View profile <i class="ri-user-2-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" href="#">Archive <i class="ri-archive-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" href="#">Muted <i class="ri-volume-mute-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- end chat user head -->

        <!-- start chat conversation -->
        <div class="chat-conversation p-3 p-lg-4" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: -24px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="left: -17px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 24px;">
                                <ul class="list-unstyled mb-0">

                                    <infinite-loading :identifier="identifier" direction="top" @infinite="infiniteHandler">
                                        <span slot="no-more"></span>
                                    </infinite-loading>

                                    <message-wrapper v-for="messagewrapper in wrappedMessages" :key="messagewrapper.id"

                                        :user-id="messagewrapper.userId"
                                        :user-name="messagewrapper.userName"
                                        :user-avatar="messagewrapper.userAvatar"
                                        :messages="messagewrapper.messages"
                                        :splitter="messagewrapper.splitter"

                                    ></message-wrapper>

                                    <message-wrapper v-for="typingUser in typingUsers" :key="typingUser.id"

                                        :user-id="typingUser.id"
                                        :user-name="typingUser.name"
                                        :user-avatar="typingUser.avatar"
                                        :typing-only="true"

                                    ></message-wrapper>

                                    <li ref="messagesList"></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 1150px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar simplebar-visible" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar simplebar-visible" style="height: 46px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
        <!-- end chat conversation end -->

        <!-- start chat input section -->
        <div class="chat-input-section p-3 p-lg-4 border-top mb-0">

            <div class="row g-0">

                <div class="col">
                    <input v-model="message" @keyup.enter="sendMessage" @input="startTyping" @blur="stopTyping"  type="text" class="form-control form-control-lg bg-light border-light" placeholder="إدخل رسالتك...">
                </div>
                <div class="col-auto">
                    <div class="chat-input-links ms-md-2 me-md-0">
                        <ul class="list-inline mb-0">

                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Emoji">
                                <button @click="toggleEmojiPicker" type="button" class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                    <i class="ri-emotion-happy-line"></i>
                                </button>
                                <emoji-picker v-if="emojiPickerStatus" class="emoji-picker" :data="emojiIndex" set="twitter" @select="showEmoji" />
                            </li>

                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Attached File">

                                <form @change="filesPending" id="files_form" enctype="multipart/form-data" :class="classUploadedFile" class="file-input btn btn-link text-decoration-none font-size-16 waves-effect" style="display:inline-block">

                                    <label for="file_upload" class="file-name btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                        <span v-if="filesUploaded">{{ filesInfo }}</span>
                                        <i v-else class="ri-attachment-2"></i>
                                        <!--<i v-else class="ri-attachment-line"></i>-->
                                    </label>
                                    <input id="file_upload" name="file_upload" type="file" multiple class="file" />

                                    <button type="submit" style="display:none">Upload</button>
                                    <!-- for upload progress -->
                                    <!--<div id="upload-progress"></div>-->
                                </form>

                            </li>

                            <li class="list-inline-item">

                                <!--@start="cLog('started')"-->
                                <!--@stop="cLog('stopped')"-->

                                <voice-recorder
                                    class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect waves-light"
                                    :class="classRecordAudio"
                                    @error="error = $event"
                                    @result="applyAudio"
                                    @start="toggleRecordAudio"
                                    @initiated="initRecordAudio"
                                >

                                    <span slot="isInitiating">
                                        <i class="ri-mic-off-line"></i>
                                    </span>
                                    <i class="ri-mic-line"></i>
                                    <span slot="isRecording">
                                        <i class="ri-stop-line"></i>
                                    </span>
                                    <span slot="isCreating">
                                        <i class="ri-rss-line"></i>
                                    </span>

                                </voice-recorder>

                            </li>

                            <li class="list-inline-item">
                                <button @click="sendMessage" type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                    <i class="ri-send-plane-2-fill"></i>
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!-- end chat input section -->



        <!-- call Modal -->
        <div class="modal fade" ref="callModal" id="audiocallModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center p-4">
                            <div class="avatar-lg mx-auto mb-4">
                                <!-- <img src="./avatar-4.jpg" alt="" class="img-thumbnail rounded-circle"> -->
                            </div>

                            <h5 class="text-truncate">Doris Brown</h5>
                            <p v-if="requestedCall.options" class="text-muted">Start {{ requestedCall.options.video ? 'Video' : 'Audio' }} Call</p>

                            <div class="mt-5">
                                <ul class="list-inline mb-1">
                                    <li class="list-inline-item px-2 me-2 ms-0">
                                        <button type="button" @click="refuseCallInfo(requestedCall)" class="btn btn-danger avatar-sm rounded-circle" data-bs-dismiss="modal">
                                            <span class="avatar-title bg-transparent font-size-20">
                                                <i class="ri-close-fill"></i>
                                            </span>
                                        </button>
                                    </li>
                                    <li class="list-inline-item px-2">
                                        <button type="button" @click="acceptCallInfo(requestedCall)" class="btn btn-success avatar-sm rounded-circle">
                                            <span class="avatar-title bg-transparent font-size-20">
                                                <i v-if="requestedCall.options" :class="requestedCall.options.video ? 'ri-vidicon-fill' : 'ri-phone-fill'"></i>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
        <!-- end call modal -->


    </div>
    <!-- end chat conversation section -->

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'
    import MessageWrapper from './MessageWrapper.vue'
    import AudioPlayer from './AudioPlayer.vue'
    import VoiceRecorder from "./VoiceRecorder.vue"
    import InfiniteLoading from 'vue-infinite-loading'
    import {Howl, Howler} from 'howler'
    import data from "emoji-mart-vue-fast/data/all.json"
    import "emoji-mart-vue-fast/css/emoji-mart.css"
    import { Picker, EmojiIndex } from "emoji-mart-vue-fast"
    var emojiIndex = new EmojiIndex(data)

    export default {
        data: function() {
            return {
                message: '',
                emojiIndex: emojiIndex,
                emojisOutput: "",
                filesUploaded: false,
                filesUploadedSize: 0,
                filesInfo: '',
                attachments: {
                    photos: [],
                    files: []
                },
                requestedCall: {},
                callSound: {},
                audioInitiated: false,
                audioRecorded: false,
                voiceRecorded: {
                    blob: null,
                    path: '',
                    duration: null,
                    type: null
                },
                error: null,
                createdMessageInfo: {},
                identifier: 1
            }
        },
        sockets: {
            chat: function (data) {
                this.recieveMessage(data)
            },
            audio: function (data) {
                this.recieveAudioRecord(data)
            },
            startTyping: function (data) {
                this.addUserTyping(data)
            },
            stopTyping: function (data) {
                this.removeUserTyping(data)
            },
            requestCall: function (callInfo){
                this.requestedCall = callInfo
                this.callSound = new Howl({
                    src: '/ding.mp3',
                    autoplay: true,
                    loop: true,
                    volume: 0.5,
                    onend: function() {
                        // console.log('Finished!');
                    }
                })
                this.callSound.play()
                $(this.$refs.callModal).modal('show')
            },
            refuseCall: function (callInfo){
                this.receiveRefusedCall(callInfo)
            },
            endCall: function (callInfo){
                this.receiveRefusedCall(callInfo)
                this.callSound.stop()
                $(this.$refs.callModal).modal('hide')
            },
            acceptCall: function (callInfo){
                this.receiveAcceptedCall(callInfo)
            },
        },
        components: {
            'message-wrapper': MessageWrapper,
            'emoji-picker': Picker,
            'audio-player': AudioPlayer,
            'voice-recorder': VoiceRecorder,
            'infinite-loading': InfiniteLoading
        },
        props: [
            'splitter',
        ],
        watch: {
            'message': function () {
                if (this.message == '')
                    this.stopTyping()
            },
            'emojisOutput': function () {
                this.message += this.emojisOutput
                this.emojisOutput = ''
            },
            'thread.lastMessage': function () {
                this.$nextTick(() => {
                    const ul = this.$refs.messagesList
                    ul.scrollIntoView({behavior: "smooth", block: "end", inline: "end"})
                })
            },
            'thread.users_typing': function () {
                this.$nextTick(() => {
                    const ul = this.$refs.messagesList
                    ul.scrollIntoView({behavior: "smooth", block: "end", inline: "end"})
                })
            },
            'thread.id': function () {
                this.identifier += 1;
            },
        },
        computed: {
            classUploadedFile: function () {
                return {
                    'file-input-uploaded': this.filesUploaded,
                    '': !this.filesUploaded,
                }
            },
            classRecordAudio: function () {
                return {
                    'btn-mic-notallow': !this.audioInitiated,
                    'btn-mic': this.audioInitiated && !this.audioRecorded,
                    'btn-mic-stop': this.audioInitiated && this.audioRecorded,
                }
            },
            firstCharacterOfName: function(){
                return this.currentThread.type == 'user' ? ( this.threadUser ? this.threadUser.name[0].toUpperCase() : '' ) : this.currentThread.group.name[0].toUpperCase()
            },
            emojiPickerStatus: function(){
                return this.$store.state.emojiPickerStatus
            },
            authUser(){
                return this.$store.state.authUser
            },
            typingUsers(){
                return this.currentThread ? this.currentThread.users_typing : []
            },
            currentThread: function (){
                return !this.$store.state.currentThreadID ? null : this.$store.state.threads[this.$store.state.currentThreadID]
            },
            currentThreadID: function (){
                return this.$store.state.currentThreadID
            },
            threadUser(){
                return !this.currentThread ? null : (this.authUser.id == this.currentThread.users[0].id ? this.currentThread.users[1] : this.currentThread.users[0])
            },
            makingCall(){
                return this.$store.state.makingCall
            },
            ...mapGetters({
                thread: 'currentThread',
                wrappedMessages: 'sortedMessages'
            })
        },
        methods: {
            axiosURL(url){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                return (window._backpack_url || '') + '/' + url
            },
            axiosURLNode(url){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                return ('http://localhost:3000' || '') + '/' + url
            },
            infiniteHandler($state) {


                // axios.get(this.axiosURL('api/messages'), {
                //     params: {
                //         thread: this.currentThreadID,
                //         page: this.currentThread.page + 1
                //     },
                // }).then(({ data }) => {
                //     if (data.length) {
                //         this.loadMoreThreadMessages(data)
                //         $state.loaded()
                //     } else {
                //         // $state.reset()
                //         $state.complete()
                //     }
                // })


                axios
                    .post(this.axiosURLNode('graphql'), 
                        {
                            query: require('../gql/queries/thread.gql').loc.source.body.toString(), 
                            variables: {
                                id: this.currentThread.id, 
                                last: 5,
                                before: this.currentThread.pageInfo.startCursor
                            }
                        },
                        {
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            }
                        }
                    )
                    .then(response => {
                        if (response.data.data.thread.messages.edges.length) {

                            this.loadMoreThreadMessages(response.data.data.thread.messages)

                            if (response.data.data.thread.messages.pageInfo.hasNextPage){
                                $state.loaded()
                            }
                            else {
                                // $state.reset()
                                $state.complete()
                            }
                        }
                    })

            },
            async applyAudio(data) {

                // this.$refs.audio.src = URL.createObjectURL(data.blob)

                var formData = new FormData();
                formData.append("audio_data", data.blob);

                await axios.post(this.axiosURL('chat/saveAudioBlob'), formData)
                    .then(response => (this.voiceRecorded.path = response.data))

                this.voiceRecorded.blob = URL.createObjectURL(data.blob)
                this.voiceRecorded.duration = data.duration
                this.voiceRecorded.type = data.type

                this.toggleRecordAudio()

                this.sendAudioRecord()

            },
            cLog(content) {
                // console.log(content);
            },
            showEmoji(emoji) {
                this.emojisOutput = this.emojisOutput + emoji.native;
            },
            startTyping(){
                if (this.currentThread && this.currentThread.type == 'user')
                    this.$socket.emit('startTyping', {thread: this.currentThread, user: this.authUser})
            },
            stopTyping(){
                if (this.currentThread && this.currentThread.type == 'user')
                    this.$socket.emit('stopTyping', {thread: this.currentThread, user: this.authUser})
            },
            initRecordAudio(){
                this.audioInitiated = true
            },
            toggleRecordAudio(){
                this.audioRecorded = !this.audioRecorded
            },
            filesPending(e){

                if (e.target.files.length > 0){

                    this.filesUploaded = true

                    var fileNameAndSize = ''

                    // Get the selected file
                    const file = e.target.files[0]
                    // Get the file name and size
                    const { name: fileName, size, type } = file
                    // Convert size in bytes to kilo bytes
                    const fileSize = (size / 1000).toFixed(2)
                    // Set the text content
                    fileNameAndSize = `${fileName} - ${fileSize}KB`

                    this.filesInfo = e.target.files.length == 1 ? fileNameAndSize : e.target.files.length + ' Files'
                    this.filesUploadedSize = size

                    return true
                }

                return false

            },
            async uploadFiles(){

                const form = $('#files_form')
                const formData = new FormData(form[0])
                for (const p of formData)
                    if (p[1].size <= 0) return;

                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
                const config = {
                    onUploadProgress: progressEvent => (this.filesInfo = (progressEvent.loaded / this.filesUploadedSize * 100).toFixed(2) + ' %')
                }
                await axios.post('http://localhost:3000/file/upload', formData, config)
                    .then(response => (this.attachments = response.data))

                if (!this.attachments.files.length && !this.attachments.photos.length)
                    this.attachments = {}

                if (!this.attachments.files.length)
                    this.attachments = {photos: this.attachments.photos}

                if (!this.attachments.photos.length)
                    this.attachments = {files: this.attachments.files}

            },
            async saveMessageToDB(text, attachments, record, thread){
                await axios.post(this.axiosURL('api/createMessage'), { text: text, thread: thread, attachments: attachments, record: record })
                    .then(response => (
                        this.createdMessageInfo = response.data
                    ))
            },
            refuseCallInfo (callInfo){
                this.$socket.emit('refuseCall', callInfo)
                this.requestedCall = {}
                this.callSound.stop()
            },
            ...mapActions({
                loadMoreThreadMessages (dispatch, data) {
                    dispatch('recievePreviousPagedMessages', data)
                },
                async sendMessage (dispatch) {

                    var uploadFs = this.filesPending
                    if (this.filesUploaded)
                        await this.uploadFiles()

                    const {message, currentThread, authUser, attachments, createdMessageInfo} = this
                    if (this.filesUploaded || message.trim()) {
                        await this.saveMessageToDB(message.trim(), this.filesUploaded ? attachments : {}, {}, currentThread)
                        const messageBody = {
                            id: this.createdMessageInfo.id,
                            text: message.trim(),
                            timestamp: this.createdMessageInfo.timestamp,
                            attachments: this.filesUploaded ? attachments : {},
                            record: {},
                            author: authUser,
                            thread: currentThread
                        }
                        dispatch('sendMessage', messageBody)
                        this.$socket.emit('chat', {message: messageBody, thread: this.currentThreadID})
                        this.message = ''
                    }
                    this.attachments = {}
                    this.filesUploaded = false
                    this.filesInfo = ''

                },
                recieveMessage (dispatch, data) {
                    dispatch('sendMessage', {
                        id: data.id,
                        text: data.text,
                        timestamp: data.timestamp,
                        attachments: data.attachments,
                        record: {},
                        author: data.author,
                        thread: data.thread
                    })

                },
                async sendAudioRecord (dispatch) {

                    const {voiceRecorded, currentThread, authUser} = this
                    await this.saveMessageToDB('', {}, voiceRecorded, currentThread)
                    const messageBody = {
                        id: this.createdMessageInfo.id,
                        timestamp: this.createdMessageInfo.timestamp,
                        text: '',
                        thread: currentThread,
                        author: authUser,
                        attachments: {},
                        record: voiceRecorded
                    }

                    dispatch('sendAudioRecord', messageBody)
                    this.$socket.emit('audio', {message: messageBody, thread: this.currentThreadID})
                    this.voiceRecorded = {}

                },
                recieveAudioRecord (dispatch, data) {

                    dispatch('sendAudioRecord', {
                        id: data.id,
                        text: data.text,
                        timestamp: data.timestamp,
                        attachments: {},
                        record: data.record,
                        author: data.author,
                        thread: data.thread
                    })

                },
                addUserTyping (dispatch, data) {

                    dispatch('addUserTyping', {
                        thread: data.thread,
                        user: data.user,
                    })

                },
                removeUserTyping (dispatch, data) {

                    dispatch('removeUserTyping', {
                        thread: data.thread,
                        user: data.user,
                    })

                },
                startCall(dispatch, video){
                    dispatch('startCall', {
                        options: {
                            audio: true,
                            video: video
                        },
                        threadId: this.currentThreadID
                    })
                },
                acceptCallInfo (dispatch, callInfo){
                    this.callSound.stop()
                    dispatch('startCall', callInfo)
                    this.$socket.emit('acceptCall', callInfo)
                },
                receiveRefusedCall (dispatch, callInfo){
                    dispatch('endCall', callInfo)
                    this.requestedCall = {}
                },
                receiveAcceptedCall (dispatch, callInfo){
                    dispatch('establishCall', callInfo)
                    this.$socket.emit('newPeer')
                },
            }),
            ...mapActions(['returnToThread', 'showProfile', 'toggleEmojiPicker', 'showEmojiPicker', 'hideEmojiPicker'])
        },
        mounted() {
            console.log('MessageSection Component mounted.')
            this.$nextTick(() => {
                const ul = this.$refs.messagesList
                ul.scrollIntoView({behavior: "smooth", block: "end", inline: "end"})
            })
        }
    }

</script>

<style lang="scss">

    .emoji-picker {
        position: absolute;
        z-index: 999;
        bottom: 80px;
        left: 20px;
    }

    .file {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }

    .file-input label {
        position: relative;
        width: inherit;
        height: inherit;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .file-name {
        position: absolute;
    }

    .file-input-uploaded{
        background-color: #DAF7A6;
        /*max-width: 40%;*/
        /*max-height: 20px;*/
        /*text-overflow: ellipsis;*/
        /*white-space: nowrap;*/
        /*overflow: hidden;*/
    }

    .btn-mic{
        /*background-color: #A6F7B4;*/
        background-color: #F8FEEF;
    }

    .btn-mic-stop{
        background-color: #F7B2A6;
    }

    .btn-mic-notallow{
        background-color: #F9FD7E;
    }

</style>

