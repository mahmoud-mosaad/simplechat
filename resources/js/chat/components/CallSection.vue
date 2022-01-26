<template>

    <div class="user-chat w-100 overflow-hidden"> <!-- class="chat-leftsidebar me-lg-1 ms-lg-0" -->
            
        <div id="peerDiv" class="embed-responsive-item">
            <video id="peerVideo" ref="videoThere" class="embed-responsive-item" autoplay></video>
        </div>
        <div class="content">
            <div class="embed-responsive embed-responsive-16by9 local-video">
                <video id="local-screen" ref="videoHere" class="embed-responsive-item local-video" muted autoplay></video>
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
                            <i class="far fa-sun" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <div id="remoteVideos">
                            <div class="line">
                                
                                <video autoplay loop muted class="person remote-video selected-video">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.mp4" type="video/mp4">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.webm" type="video/webm">
                                </video>
                               
                            </div>
                            <div class="line">
                                
                                <video autoplay loop muted class="person remote-video">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.mp4" type="video/mp4">
                                    <source src="http://inserthtml.com/demos/javascript/background-videos/flowers.webm" type="video/webm">
                                </video>
                               
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
                        <div @click="toggleCallAudio" id="muteMic" class="circle settings"> <!-- mic -->
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-microphone-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div @click="toggleCallVideo" id="muteVideo" class="circle settings">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-video-slash" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="shareScreen" class="circle settings">
                            <span class="text-center justify-content-center align-self-center">
                                <i class="fas fa-desktop" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div @click="endCall" id="cancel-call" class="circle cancel">
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
            endCall: function (callInfo){
                this.receiveRefusedCall(callInfo)
            },
            acceptCall: function (callInfo){
                this.receiveAcceptedCall(callInfo)
            },
            cancelCall: function (){
                this.callEnded = true
                this.client.peer.destroy()
                this.clientDisplay.peer.destroy()
            },
            increaseCallPeers: function (callInfo){
                this.increaseCallPeers(callInfo)
            },
            createPeer: function () {
                const { client, $socket, callInfo } = this
                client.gotAnswer = false
                // let peer = this.InitPeer('init')
                // peer.on('signal', function(data){
                //     console.log('ashdkashdjkashkjdhaskjdhkjashdkjhkhjkasd')
                //     // if (!client.gotAnswer){
                //     //     console.log('offer')
                //         $socket.emit('Offer', {data, callInfo: callInfo})
                //     // }
                // })

                console.log(this.stream)

                var peer = new Peer({
                    initiator: true,
                    stream: this.stream,
                    trickle: false
                })
                peer.on('close', function () {
                    peer.destroy()
                })
                peer.on('signal', data => {
                    $socket.emit('Offer', {data: JSON.stringify(data), callInfo: callInfo})
                })

                client.peer = peer
            },
            sessionActive: function () {
                // document.write('Session Active. Please come back later')
            },
            BackOffer: function (offer) {
                const { client, $socket, callInfo } = this

                console.log(this.stream)

                var peer = new Peer({
                    initiator: false,
                    stream: this.stream,
                    trickle: false    
                })

                peer.on('stream', stream => {
                    console.log('dsfjkdshkfhkdshdfdsjk stream')
                    // got remote video stream, now let's show it in a video tag
                    var video = document.querySelector('video')

                    if ('srcObject' in video) {
                        video.srcObject = stream
                        console.log(video.srcObject)
                    } else {
                        video.src = window.URL.createObjectURL(stream) // for older browsers
                        console.log(video.src)
                    }

                })
                peer.on('close', function () {
                    peer.destroy()
                })

                peer.signal(JSON.parse(offer.data))

                peer.on('signal', data => {
                    if (!client.gotAnswer){
                        client.gotAnswer = true
                        console.log('sssssssssssssssssssssssssssssss')
                        $socket.emit('Answer', {data: JSON.stringify(data), callInfo: callInfo})
                    }
                })

                client.peer = peer


                // let peer = this.InitPeer('notInit')
                // peer.on('signal', (data) => {
                //     console.log('answer')
                //     $socket.emit('Answer', {data, callInfo: callInfo})
                // })
                peer.on('error', err => console.log('error', err))
                peer.on('data', data => {
                    console.log('data: ' + data)
                })
                peer.on('connect', () => {
                    console.log('CONNECT')
                    peer.send('1')
                    peer.send('1')
                    peer.send('1')
                    peer.send('1')
                    
                })
                // peer.signal(offer.data)

            },
            BackAnswer: function (answer) {
                // console.log(answer)
                const { client} = this
                client.gotAnswer = true
                let peer = client.peer
                peer.on('error', err => console.log('error', err))
                peer.on('data', data => {
                    console.log('data: ' + data)
                })
                peer.on('connect', () => {
                    console.log('CONNECT')
                    peer.send('2')
                    peer.send('2')
                    peer.send('2')
                    peer.send('2')
                    
                })
                // peer.signal(answer.data)
                peer.signal(JSON.parse(answer.data))
            },
            ShareScreen: function () {
                this.clientDisplay.gotAnswer = false
                let peer = this.InitPeer_Screen('init')
                peer.on('signal', function(data){
                    if (!this.clientDisplay.gotAnswer){
                        this.$socket.emit('OfferScreen', data)
                    }
                })
                this.clientDisplay.peer = peer
            },
            BackOfferScreen: function (offer) {
                let peer = this.InitPeer('notInit', this.streamDisplay)
                peer.on('signal', (data) => {
                    this.$socket.emit('AnswerScreen', data)
                })
                peer.signal(offer)
                this.clientDisplay.peer = peer
            },
            BackAnswerScreen: function (answer) {
                this.clientDisplay.gotAnswer = true
                let peer = this.clientDisplay.peer
                peer.signal(answer)
            },
            StopShareScreen: function (){
                let video = document.createElement('video')
                video.id = 'peerVideo'
                video.srcObject = stream
                video.class = 'embed-responsive-item'
                document.querySelector('#peerDiv').appendChild(video)
                video.play()
            },
            RemoveVideo: function (){
                document.getElementById("peerVideo").remove()
            }
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
            InitPeer(type) {
                const { stream, $refs } = this
                let peer = new Peer({ initiator: (type == 'init') ? true : false, stream: stream, trickle: false})
                peer.on('stream', function (stream) {
                    // this.CreateVideo(stream)
                    // $refs.videoThere.srcObject = stream
                    // $refs.videoThere.play()
                    let video = document.createElement('video')
                    video.id = 'peerVideo'
                    video.srcObject = stream
                    video.class = 'embed-responsive-item'
                    document.querySelector('#peerDiv').appendChild(video)
                    video.play()
                    console.log('asdjkahskjdhasjdhkjashdkhaskjdasd stream')
                })
                peer.on('close', function () {
                    $("#peerVideo").remove()
                    peer.destroy()
                })
                return peer
            },
            InitPeer_Screen(type) {
                let peer = new Peer({ initiator: (type == 'init') ? true : false, stream: this.streamDisplay, trickle: false })
                peer.on('stream', function (_stream) {
                    this.CreateVideo(_stream)
                })
                peer.on('close', function () {
                    document.getElementById("peerVideo").remove()
                    peer.destroy()
                })
                return peer
            },
            startVideoChat(userId) {
              this.getPeer(userId, true)
            },
            getPeer(userId, initiator) {
                if(this.peers[userId] === undefined) {
                    let peer = new Peer({
                        initiator,
                        stream: this.stream,
                        trickle: false
                    })
                    peer.on('signal', (data) => {
                        this.channel.trigger(`client-signal-${userId}`, {
                            userId: this.user.id,
                            data: data
                        })
                    })
                    .on('stream', (stream) => {
                        const videoThere = this.$refs['video-there']
                        videoThere.srcObject = stream;
                    })
                    .on('close', () => {
                        const peer = this.peers[userId]
                        if(peer !== undefined) {
                            peer.destroy()
                        }
                        delete this.peers[userId]
                    })
                    this.peers[userId] = peer
                } 
                return this.peers[userId]
            },
            async setupCall() {

                this.stream = await navigator.mediaDevices.getUserMedia(this.callInfo.options)                
                this.$refs.videoHere.srcObject = this.stream
                this.$socket.emit('requestCall', this.callInfo)

                console.log(this.stream)

                // this.$refs.videoThere.srcObject = this.stream
                // this.$refs.videoThere.play()


                // const pusher = this.getPusherInstance()
                // this.channel = pusher.subscribe('presence-video-chat')
                // this.channel.bind(`client-signal-${this.user.id}`, (signal) => 
                // {
                //     const peer = this.getPeer(signal.userId, false)
                //     peer.signal(signal.data)
                // })

                // document.getElementById('shareScreen').onclick = function(){
                //     navigator.mediaDevices.getDisplayMedia({video: true})
                //     .then(displayStream => {
                //         this.streamDisplay = displayStream
                //         const vid = document.getElementById('local-screen')
                //         vid.srcObject = this.streamDisplay
                //         vid.play()
                //         this.streamDisplay.getVideoTracks()[0].onended = function () {
                //             if (!this.callEnded){
                //                 console.log('call Ended')
                //                 const vid = document.getElementById('local-screen')
                //                 vid.srcObject = stream
                //                 vid.play()
                //                 this.$socket.emit('StopShareScreen')
                //             }
                //         }
                //         this.$socket.emit('ShareScreen')
                //     })
                //     .catch(err => console.log(err))
                //     // .catch(err => document.write(err))
                // }

            },
            endCall(){
                this.$socket.emit('endCall', this.callInfo)
            },
            ...mapActions({
                receiveRefusedCall (dispatch, callInfo){
                    dispatch('endCall', callInfo)
                },
                receiveAcceptedCall (dispatch, callInfo){
                    dispatch('establishCall', callInfo)
                    this.$socket.emit('newPeer', callInfo)
                },
                toggleCallAudio (dispatch){
                    const {stream} = this
                    stream.getAudioTracks()[0].enabled =
                        !(stream.getAudioTracks()[0].enabled)

                    dispatch('toggleCallAudio')
                },
                toggleCallVideo (dispatch){
                    const {stream} = this
                    stream.getVideoTracks()[0].enabled =
                        !(stream.getVideoTracks()[0].enabled)
                    
                    dispatch('toggleCallVideo')
                },
                increaseCallPeers (dispatch, callInfo){
                    dispatch('increaseCallPeers', callInfo)
                }
            }),
            ...mapActions(['switchThread'])
        },
        mounted() {
            console.log('CallSection Component mounted.')
            this.setupCall()
        }
    }

</script>

<style lang="scss">

    .circle{
        border-radius: 50%;
        height: 50px;
        width: 50px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
        margin-right: 10px;
    }
    
    .settings{
        /*     background: rgb(146, 130, 132, 0.7); */
        /* background-color: #141416; */
        background: rgba(0, 0, 0, 0.7);
    }
    
    .settings i{
        font-size: large;
        color: white;
    }
    
    .cancel{
        background-color: rgb(215, 44, 64, 0.7);
    }

    .mic{
        background-color: rgba(255, 255, 255, 0.7);
    }
    
    .call-body{
        padding: 40px 40px 20px;
    }
    
    .line{
        display: inline-block;
    }
    
    .person{
        height: 50px;
        border-radius: 5px;
        /* margin: 0 2.5px; */
    }
    
    
    .videoContainer {
        position: relative;
        width: 100%;
        height: 100vh;
        background-attachment: scroll;
        overflow: hidden;
    }
    
    .videoContainer video {
        min-width: 100%;
        min-height: 100%;
        position: relative;
        z-index: 1;
    }
    
    .videoContainer .call-body {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 2;
    }
    
    .video-controls{
        position: absolute;
        bottom: 30px;
    }
    
    .local-user{
        position: absolute;
        bottom: 30px;
        right: 30px;
        width: 200px;
        z-index: 3;
    }
    
    .flex-container{
        display: flex;
    
    }
    
    .flex-item {
        height: 50px;
        line-height: 50px;
    }
    
    
    .local-user2{
        position: absolute;
        bottom: 190px;
        right: 30px;
        width: 200px;
        z-index: 3;
    }



    /**/


    #peerVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
    }

    .content {
        position: fixed;
        /* background: rgba(0, 0, 0, 0.5);
        color: #f1f1f1; */
        width: 100%;
        height: 100%;
    }

    .local-video{
        position: fixed;
        width: 200px;
        height: 100px;
        right: 100px;
        bottom: 20px;
    }

    .local-video2{
        border-radius: 4px;
    }

    .remote-screen-video{
        position: fixed;
        width: 200px;
        height: 100px;
        left: 20px;
        bottom: 20px;
    }

    .remote-screen-video2{
        border-radius: 4px;
    }

    .remote-video{
        /* margin-right: -3px; */
        border-radius: 4px;
    }

    .selected-video{
        border: 3px solid rgba(255, 255, 255, 0.7);
    }

    .loc{
        bottom: 120px;
    }

</style>

