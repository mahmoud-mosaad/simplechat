<template>

    <div class="user-chat w-100 overflow-hidden" :class="showChatResponsive">
        <div class="d-lg-flex">

            <message-section v-if="currentThread"></message-section>

            <!-- start User profile detail sidebar -->
            <div v-if="currentThread" class="user-profile-sidebar" :class="userProfileSidebar">
                <div class="px-3 px-lg-4 pt-3 pt-lg-4">
                    <div class="user-chat-nav text-end">
                        <button @click="hideProfile" type="button" class="btn nav-btn" id="user-profile-hide">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                </div>

                <div class="text-center p-4 border-bottom">
                    <div class="mb-4">
                        <img v-if="currentThread.type == 'user' && threadUser && threadUser.avatar != ''" :src="asset(threadUser.avatar)" class="rounded-circle avatar-lg img-thumbnail" alt="">
                        <div v-else class="avatar-first-character avatar-title rounded-circle avatar-lg img-thumbnail bg-soft-primary text-primary" style="font-size:35px">
                            {{ firstCharacterOfName }}
                        </div>
                    </div>

                    <h5 class="font-size-16 mb-1 text-truncate">{{ currentThread.type == 'user' ? ( threadUser ? threadUser.name : '' ) : currentThread.group.name }}</h5>
                    <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success me-1 ms-0"></i> متاح </p>
                </div>
                <!-- End profile user -->

                <!-- Start user-profile-desc -->
                <div class="p-4 user-profile-desc" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: -24px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                    <div class="simplebar-content" style="padding: 24px;">
                                        <div v-if="currentThread.type == 'group'" class="text-muted">
                                            <p class="mb-4">{{ currentThread.group.description }}</p>
                                        </div>

                                        <div class="accordion" id="myprofile">

                                            <div v-if="currentThread.type == 'group'" class="accordion-item card border mb-2">
                                                <div class="accordion-header" id="about3">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#aboutprofile" aria-expanded="true" aria-controls="aboutprofile">
                                                        <h5 class="font-size-14 m-0">
                                                            <i class="ri-user-2-line me-2 ms-0 align-middle d-inline-block"></i> الأعضاء
                                                        </h5>
                                                    </button>
                                                </div>
                                                <div id="aboutprofile" class="accordion-collapse collapse show" aria-labelledby="about3" data-bs-parent="#myprofile">
                                                    <div class="accordion-body">

                                                        <div v-for="user in currentThread.users" class="accordion-user d-flex">

                                                            <div class="chat-user-img align-self-center me-3 ms-0">

                                                                <img v-if="user.avatar != ''" :src="asset(user.avatar)" class="rounded-circle avatar-xs" alt="">
                                                                <div v-else class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        {{ user.name[0] }}
                                                                    </span>
                                                                </div>

                                                                <span class="user-status"></span>
                                                            </div>

                                                            <div class="accordion-user-text flex-1 overflow-hidden">
                                                                <h5 class="text-truncate font-size-15 mb-1"> {{ user.name }} </h5>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item card border mb-2">
                                                <div class="accordion-header" id="attachfile3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#attachprofile" aria-expanded="false" aria-controls="attachprofile">
                                                        <h5 class="font-size-14 m-0">
                                                            <i class="ri-attachment-line me-2 ms-0 align-middle d-inline-block"></i> الملفات
                                                        </h5>
                                                    </button>
                                                </div>
                                                <div id="attachprofile" class="accordion-collapse collapse" aria-labelledby="attachfile3" data-bs-parent="#myprofile">
                                                    <div class="accordion-body">

                                                        <div v-if="threadAttachments" v-for="(attachment, index) in threadAttachments" :key="'attach_' + index" class="card p-2 border mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-3 ms-0">
                                                                    <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                                                        <i class="ri-file-text-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <div class="text-start">
                                                                        <h5 class="font-size-14 mb-1">{{ attachment.name }}</h5>
                                                                        <p class="text-muted font-size-13 mb-0">{{ attachment.size | size }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="ms-4 me-0">
                                                                    <ul class="list-inline mb-0 font-size-18">
                                                                        <li class="list-inline-item">
                                                                            <a download :href="asset(attachment.link)" class="text-muted px-1">
                                                                                <i class="ri-download-2-line"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="accordion-item card border">
                                                <div class="accordion-header" id="attachphoto3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#photoprofile" aria-expanded="false" aria-controls="attachprofile">
                                                        <h5 class="font-size-14 m-0">
                                                            <i class="ri-image-line me-2 ms-0 align-middle d-inline-block"></i> الصور
                                                        </h5>
                                                    </button>
                                                </div>
                                                <div id="photoprofile" class="accordion-collapse collapse" aria-labelledby="attachphoto3" data-bs-parent="#myprofile">
                                                    <div class="accordion-body">

                                                        <div class="row">

                                                            <div v-if="threadPhotos" class="col-6" v-for="(photo, index) in threadPhotos" :key="'photo_' + index">

                                                                <a class="popup-img d-inline-block m-1" :href="asset(photo.src)" :title="photo.name">
                                                                    <div class="gallery">
                                                                        <div class="gallery-image">
                                                                            <img :src="asset(photo.src)" alt="" class="rounded border popup-image">
                                                                        </div>
                                                                    </div>
                                                                </a>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <!-- end profile-user-accordion -->
                                        </div>
                                        <!-- end user-profile-desc -->
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
                <!-- end User profile detail sidebar -->
            </div>
        </div>
        <!-- End User chat -->
    </div>

</template>


<script>

    import { mapActions, mapGetters } from 'vuex'
    import MessageSection from './MessageSection.vue'
    import MagnificPopupModal from './MagnificPopupModal'
    import $ from 'jquery'

    export default {
        data: function() {
            return {

            }
        },
        components: {
            'message-section': MessageSection,
        },
        computed: {
            userProfileSidebar: function () {
                return {
                    hideProfile: this.$store.state.toggleProfile == 0,
                    showProfile: this.$store.state.toggleProfile == 1,
                }
            },
            showChatResponsive: function () {
                return {
                    'user-chat-show': this.$store.state.showChatOnly == 1,
                }
            },
            currentThread: function(){
                return !this.$store.state.currentThreadID ? null : this.$store.state.threads[this.$store.state.currentThreadID]
            },
            authUser(){
                return this.$store.state.authUser
            },
            threadUser(){
                return !this.currentThread ? null : (this.authUser.id == this.currentThread.users[0].id ? this.currentThread.users[1] : this.currentThread.users[0])
            },
            firstCharacterOfName: function(){
                return this.currentThread ? (this.currentThread.type === 'user' ? this.currentThread.user.name[0].toUpperCase() : this.currentThread.group.name[0].toUpperCase()) : ''
            },
            threadAttachments(){
                return this.currentThread ? this.$store.state.threadAttachments[this.currentThread.id] : []
            },
            threadPhotos(){
                return this.currentThread ? this.$store.state.threadPhotos[this.currentThread.id] : []
            }
        },
        methods: {
            ...mapActions(['returnToThread', 'hideProfile'])
        },
        mounted() {
            console.log('ChatSection Component mounted.')

            $(".popup-img").magnificPopup({
                type:"image",
                closeOnContentClick:!0,
                mainClass:"mfp-img-mobile",
                image:{verticalFit:!0}
            })

        }
    }

</script>

<style lang="scss">

    .hideProfile{
        display: none;
    }
    .showProfile{
        display: inline-block;
    }

    .avatar-first-character{
        height: 96px;
        width: 96px;
        margin-left: auto;
        margin-right: auto;
    }

    .accordion-user{
        padding-bottom: 12px;
    }

    .accordion-user-text{
        margin-top: 5px;
    }

    .gallery {
        width:auto;
        height:auto;
        position: relative;
        padding: 0;
        margin: 0;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gallery-image{
        cursor: pointer;
        position: relative;
        display: block;
    }

    .gallery-image img{
        max-width: 150px;
        height: auto;
    }

    .gallery-image:hover{
        opacity: 0.8;
    }

</style>

