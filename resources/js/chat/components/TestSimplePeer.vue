<template>

    <div>

        <div id="peerDiv" class="embed-responsive-item"></div>
        <div class="content">
            <div class="embed-responsive embed-responsive-16by9 local-video">
                <video id="local-screen" class="embed-responsive-item local-video2" muted></video>
            </div>
            <div id="local-screen2" class="embed-responsive embed-responsive-16by9 local-video loc">
            </div>
            <!-- <div id="remote-screen" class="embed-responsive embed-responsive-16by9 remote-screen-video">
                <video class="embed-responsive-item remote-screen-video2" muted></video>
            </div> -->
            <div class="videoContainer">
                <div class="container-fluid call-body">
                <div class="row d-flex">
                    <div class="circle settings">
                        <span class="text-center justify-content-center align-self-center">
                            <i class="far fa-sun" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="circle settings">
                        <span class="text-center justify-content-center align-self-center">
                            <i class="fas fa-user-plus" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <div id="remoteVideos">
                            <div class="line">
                                <!--
                                <video autoplay loop muted class="person remote-video selected-video">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.mp4" type="video/mp4">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.webm" type="video/webm">
                                </video>
                                -->
                            </div>
                            <div class="line">
                                <!--
                                <video autoplay loop muted class="person remote-video">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.mp4" type="video/mp4">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.webm" type="video/webm">
                                </video>
                                -->
                            </div>
                        </div>
                        <!--
                            <img class="line person" src="images/00.png" alt="user name">
                            <img class="line person" src="images/00.png" alt="user name">
                            <img class="line person" src="images/00.png" alt="user name">
                        -->
                    </div>
                </div>
                <div class="row">
                    <div class="video-controls col d-flex justify-content-center">
                        <div id="muteMic" class="circle mic">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-microphone-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="muteVideo" class="circle settings">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-video-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="shareScreen" class="circle settings">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-desktop" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="emoji" class="circle settings">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="far fa-smile" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="cancel-call" class="circle cancel">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-phone-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                </div>
                <!-- background static video -->
            </div>
        </div>

    </div>

</template>

<script>

    import { mapActions, mapGetters } from 'vuex'
    import Peer from 'simple-peer'
    // import wrtc from 'wrtc'

    export default {
        data: function() {
            return {
                channel: null,
                stream: null,
                peers: {},
                client: {
                    peer: {},
                    gotAnswer: false
                },
                clientDisplay: {},
                streamDisplay: null,
                callEnded: false
            }
        },
        components: {
        
        },
        computed: {
            callInfo(){
                return this.$store.state.callInfo
            },
        },
        sockets: {
            refuseCall: function (callInfo){
                this.receiveRefusedCall(callInfo)
            },
        },
        methods: {
            CreateVideo(stream) {
                let video = document.createElement('video')
                video.id = 'peerVideo'
                video.srcObject = stream
                video.class = 'embed-responsive-item'
                document.querySelector('#peerDiv').appendChild(video)
                video.play()
            },
        },
        mounted() {
            console.log('SimplePeer Component mounted.')

            // let url = new URL(window.location.href)

            // console.log(url.searchParams.has('init'))

            // const p = new Peer({
            //     initiator: url.searchParams.has('init'),
            //     trickle: false
            // })

            // p.on('error', err => console.log('error', err))

            // p.on('signal', data => {
            //     console.log('SIGNAL', JSON.stringify(data))
            //     document.querySelector('#outgoing').textContent = JSON.stringify(data)
            // })

            // document.querySelector('form').addEventListener('submit', ev => {
            //     ev.preventDefault()
            //     p.signal(JSON.parse(document.querySelector('#incoming').value))
            // })

            // p.on('connect', () => {
            //     console.log('CONNECT')
            //     p.send('whatever' + Math.random())
            // })

            // p.on('data', data => {
            //     console.log('data: ' + data)
            // })


                // get video/voice stream
                // navigator.mediaDevices.getUserMedia({
                // video: true,
                // audio: true
                // }).then(gotMedia).catch(() => {})



let Peer = require('simple-peer')
let io = require('socket.io-client')

let socket = io()
const video = document.querySelector('video')
let client = {}
let client_display = {}
let stream_display = null
let callEnded = false

navigator.mediaDevices.getUserMedia({video: true, audio: true})
    .then(stream => {

        console.log(stream)

        document.getElementById('muteMic').onclick = function(){
            stream.getAudioTracks()[0].enabled =
                !(stream.getAudioTracks()[0].enabled)
        }

        document.getElementById('muteVideo').onclick = function(){
            stream.getVideoTracks()[0].enabled =
                !(stream.getVideoTracks()[0].enabled)
        }

        document.getElementById('cancel-call').onclick = function(){
            socket.emit('CancelCall')
        }

        document.getElementById('shareScreen').onclick = function(){
            navigator.mediaDevices.getDisplayMedia({video: true})
            .then(displayStream => {
                stream_display = displayStream
                const vid = document.getElementById('local-screen')
                vid.srcObject = stream_display
                vid.play()
                stream_display.getVideoTracks()[0].onended = function () {
                    if (!callEnded){
                        console.log('call Ended')
                        const vid = document.getElementById('local-screen')
                        vid.srcObject = stream
                        vid.play()
                        socket.emit('StopShareScreen')
                    }
                }
                socket.emit('ShareScreen')
            })
            .catch(err => console.log(err))
            // .catch(err => document.write(err))
        }

        socket.emit('NewClient')
        video.srcObject = stream
        video.play()

        function InitPeer(type) {
            let peer = new Peer({ initiator: (type == 'init') ? true : false, stream: stream, trickle: false })
            peer.on('stream', function (stream) {
                CreateVideo(stream)
            })
            peer.on('close', function () {
                document.getElementById("peerVideo").remove()
                peer.destroy()
            })
            return peer
        }

        // function RemoveVideo(){
        //     document.getElementById("peerVideo").remove()
        // }

        function MakePeer() {
            client.gotAnswer = false
            let peer = InitPeer('init')
            peer.on('signal', function(data){
                if (!client.gotAnswer){
                    socket.emit('Offer', data)
                }
            })
            client.peer = peer
        }

        function FrontAnswer(offer) {
            let peer = InitPeer('notInit')
            peer.on('signal', (data) => {
                socket.emit('Answer', data)
            })
            peer.signal(offer)
            client.peer = peer
        }

        function SignalAnswer(answer) {
            client.gotAnswer = true
            let peer = client.peer
            peer.signal(answer)    
        }

        function CreateVideo(stream) {
            let video = document.createElement('video')
            video.id = 'peerVideo'
            video.srcObject = stream
            video.class = 'embed-responsive-item'
            document.querySelector('#peerDiv').appendChild(video)
            video.play()
        }

        function SessionActive() {
            document.write('Session Active. Please come back later')
        }

        function CancelCall(){
            console.log('cancel call')
            callEnded = true
            let peer = client.peer
            let peer_display = client_display.peer
            peer_display.destroy()
            peer.destroy()
        }

        function InitPeer_Screen(type) {
            let peer = new Peer({ initiator: (type == 'init') ? true : false, stream: stream_display, trickle: false })
            peer.on('stream', function (_stream) {
                CreateVideo(_stream)
            })
            peer.on('close', function () {
                document.getElementById("peerVideo").remove()
                peer.destroy()
            })
            return peer
        }

        function MakePeer_Screen() {
            client_display.gotAnswer = false
            let peer = InitPeer_Screen('init')
            peer.on('signal', function(data){
                if (!client_display.gotAnswer){
                    socket.emit('OfferScreen', data)
                }
            })
            client_display.peer = peer
        }

        function FrontAnswer_Screen(offer) {
            let peer = InitPeer('notInit', stream_display)
            peer.on('signal', (data) => {
                socket.emit('AnswerScreen', data)
            })
            peer.signal(offer)
            client_display.peer = peer
        }

        function SignalAnswer_Screen(answer) {
            client_display.gotAnswer = true
            let peer = client_display.peer
            peer.signal(answer)
        }

        function StopShareScreen(){
            let video = document.createElement('video')
            video.id = 'peerVideo'
            video.srcObject = stream
            video.class = 'embed-responsive-item'
            document.querySelector('#peerDiv').appendChild(video)
            video.play()
        }

        socket.on('BackOffer', FrontAnswer)
        socket.on('BackAnswer', SignalAnswer)
        socket.on('SessionActive', SessionActive)
        socket.on('CreatePeer', MakePeer)
        socket.on('CancelCall', CancelCall)
        socket.on('ShareScreen', MakePeer_Screen)
        socket.on('BackOfferScreen', FrontAnswer_Screen)
        socket.on('BackAnswerScreen', SignalAnswer_Screen)
        socket.on('StopShareScreen', StopShareScreen)

        // socket.on('RemoveVideo', RemoveVideo)

    })
    .catch(err => console.log(err))
    // .catch(err => document.write(err))





        }
    }


    //     function gotMedia (stream) {
    // var peer1 = new Peer({ initiator: true, stream: stream })
    // var peer2 = new Peer()

    // peer1.on('signal', data => {
    //     peer2.signal(data)
    // })

    // peer2.on('signal', data => {
    //     peer1.signal(data)
    // })

    // peer2.on('stream', stream => {
    //     // got remote video stream, now let's show it in a video tag
    //     var video = document.querySelector('video')

    //     if ('srcObject' in video) {
    //     video.srcObject = stream
    //     } else {
    //     video.src = window.URL.createObjectURL(stream) // for older browsers
    //     }

    // })
    // }

</script>

<style lang="scss">

      #outgoing {
        width: 600px;
        word-wrap: break-word;
        white-space: normal;
      }

</style>

