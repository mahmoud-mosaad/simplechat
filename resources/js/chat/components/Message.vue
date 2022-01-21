<template>

    <div class="ctext-wrap">
        <div class="ctext-wrap-content">

            <p class="mb-0">
                {{ text }}
            </p>

            <ul id="popup-img" v-if="attachments.photos" class="popup-img list-inline message-img  mb-0">

                <template v-if="attachments.photos.length > 2">

                    <li v-for="photo in attachments.photos.slice(0, 1)" :key="photo.id" class="list-inline-item message-img-list "> <!-- me-2 ms-0 -->

                        <div>

                            <a @click.prevent="makePopup(attachments.photos, photo.id)" class="popup-img d-inline-block m-1" :href="suitsrc(photo.src)" :title="photo.name">
                                <img :src="suitsrc(photo.src)" alt="" class="rounded border popup-image">
                            </a>

                        </div>

                    </li>
                    <li v-for="photo in attachments.photos.slice(1, 2)" :key="photo.id" class="list-inline-item message-img-list "> <!-- me-2 ms-0 -->

                        <div>

                            <a @click.prevent="makePopup(attachments.photos, photo.id)" class="popup-img d-inline-block m-1" :href="suitsrc(photo.src)" :title="photo.name">
                                <div class="gallery">
                                    <div class="gallery-image">

                                        <img :src="suitsrc(photo.src)" alt="" class="rounded border popup-image">

                                        <div class="gallery-text">

                                            <h3>{{ attachments.photos.length - 1 }}+</h3>

                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                    </li>

                </template>
                <template v-else>
                    <li v-for="photo in attachments.photos" :key="photo.id" class="list-inline-item message-img-list "> <!-- me-2 ms-0 -->

                        <div>

                            <a @click.prevent="makePopup(attachments.photos, photo.id)" class="popup-img d-inline-block m-1" :href="suitsrc(photo.src)" :title="photo.name">
                                <img :src="suitsrc(photo.src)" alt="" class="rounded border popup-image">
                            </a>

                        </div>

                    </li>
                </template>

            </ul>

            <template v-if="attachments.files">

                <div v-for="file in attachments.files" :key="file.id" class="card p-2 mb-2">

                    <div class="d-flex flex-wrap align-items-center attached-file">
                        <div class="avatar-sm me-3 ms-0 attached-file-avatar">
                            <div class="avatar-title bg-soft-primary text-primary rounded font-size-20">
                                <i class="ri-file-text-fill"></i>
                            </div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <div class="text-start">
                                <h5 class="font-size-14 text-truncate mb-1">{{ file.name }}</h5>
                                <p class="text-muted text-truncate font-size-13 mb-0">{{ file.size | size }}</p>
                            </div>
                        </div>
                        <div class="ms-4 me-0">
                            <div class="d-flex gap-2 font-size-20 d-flex align-items-start">
                                <div>
                                    <a :download="file.name" :href="suitsrc(file.link)" class="text-muted">
                                        <i class="ri-download-2-line"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </template>

            <template v-if="record.path">

                <div id="audio" class="player-wrapper">
                    <audio-player :file="suitsrc(record.path)"></audio-player>
                </div>

            </template>

            <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">{{ timestamp | time }}</span></p>

        </div>

        <div class="dropdown align-self-start">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-more-2-fill"></i>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a>
                <a class="dropdown-item" href="#">Save <i class="ri-save-line float-end text-muted"></i></a>
                <a class="dropdown-item" href="#">Forward <i class="ri-chat-forward-line float-end text-muted"></i></a>
                <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a>
            </div>
        </div>

    </div>

</template>

<script>

    import AudioPlayer from './AudioPlayer.vue'
    import MagnificPopupModal from './MagnificPopupModal'
    import $ from 'jquery'

    export default {
        data: function() {
            return {
                showPhoto: false,
            }
        },
        props: [
            'text',
            'timestamp',
            'attachments',
            'record'
        ],
        components: {
            'audio-player': AudioPlayer,
        },
        computed: {

        },
        methods: {
            makePopup: function (photos, id){
                var vm = this
                var new_photos = []

                for(var key = 0; key < photos.length; key++){

                    // photos[key].src = vm.suitsrc(photos[key].src)

                    new_photos.push({
                        id: photos[key].id,
                        src: vm.suitsrc(photos[key].src)
                    })

                }

                new_photos.sort(function(x,y){ return x.id == id ? -1 : y.id == id ? 1 : 0; });

                $('.popup-img').magnificPopup({
                    items: new_photos,
                    gallery: {
                        enabled: true
                    },
                    type: 'image',
                    closeOnContentClick: !0,
                    mainClass: "mfp-img-mobile",
                    image: {
                        verticalFit: !0
                    }
                });

            },
            suitsrc: function (src) {
                var vm = this
                if (src.indexOf('http') == -1)
                    return vm.asset(src)

                return src
            }
        },
        mounted() {
            console.log('Message Component mounted.')
        }
    }

</script>

<style lang="scss">

    .gallery {
        width:150px;
        height:100px;
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

    .gallery-text{
        width: 150px;
        height: auto;
        /*height: 100px;*/
        position: absolute;
        top: 0; right: 0;
        bottom: 0; left: 0;
        text-align: center;
        background-color: rgba(0,0,0,0.8);
        opacity: 0.9;
        -webkit-transition: opacity 0.6s;
        -moz-transition: opacity 0.6s;
        transition: opacity 0.6s;
        vertical-align:middle;
        line-height:100px;
    }

    .gallery-text:hover{
        opacity: 0.7;
    }

    .gallery-text h3{
        color: white;
        display: inline-table;
        vertical-align:middle;
        line-height:100%;
    }

    .player-wrapper {
        align-items: center;
        background-color: #fff;
        background-image: linear-gradient(90deg, #fff 0, darken(#fff, 12%));
        justify-content: center;
    }

</style>
