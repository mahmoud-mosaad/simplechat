import Vue from 'vue'
import Vuex from 'vuex'
import * as getters from './getters'
import * as actions from './actions'
import mutations from './mutations'
import createLogger from '../logger'

Vue.use(Vuex)

const state = {
    debug: true,
    loadingStatus: true,
    showChatOnly: 0,
    toggleProfile: 0,
    emojiPickerStatus: false,
    currentThreadID: null,
    authUser: {
        id: '',
        name: '',
        avatar: '',
    },
    threadAttachments: [],
    threadPhotos: [],
    contacts: {},
    filteredUserThreads: {},
    filteredGroupThreads: {},
    subscribedThreads: [],
    makingCall: false,
    showCallTab: false,
    callInfo: {
        threadId: '',
        options: {
            video: false,
            audio: false
        },
        established: false,
        status: {
            video: false,
            audio: false
        },
        peers: 0
    },
    activeThreads: [
        // {
        //     id: 1,
        //     name: 'Patrick',
        //     avatar: 'messenger2/avatar-2.jpg',
        // },
        // {
        //     id: 2,
        //     name: 'Doris',
        //     avatar: 'messenger2/avatar-4.jpg',
        // },
        // {
        //     id: 3,
        //     name: 'Emily',
        //     avatar: 'messenger2/avatar-5.jpg',
        // },
        // {
        //     id: 4,
        //     name: 'Steve',
        //     avatar: 'messenger2/avatar-6.jpg',
        // },
        // {
        //     id: 5,
        //     name: 'Teresa',
        //     avatar: '',
        // },
    ],
    threads: {
        /*
        id: {
          id,
          name,
          avatar,
          info,
          type,
          messages: [...ids],
          lastMessage,
          unreadMessagesCount,
          users: [
              {
                  id: '',
                  name: '',
                  avatar: '',
              }
          ],
          users_typing: [
              {
                  id: '',
                  name: '',
                  avatar: '',
              }
          ],

        }
        */
    },
    messages: {
        /*
        id: {
          id,
          threadId,
          threadName,
          authorName,
          text,
          timestamp,
          isRead
        }
        */
    },
    users: [
        // {
        //     id: 1,
        //     status: 'online',
        //     avatar: 'messenger2/avatar-2.jpg',
        //     name: 'Patrick Hendricks',
        // },
        // {
        //     id: 2,
        //     status: 'away',
        //     avatar: 'messenger2/avatar-3.jpg',
        //     name: 'Mark Messer',
        // },
        // {
        //     id: 3,
        //     status: 'offline',
        //     name: 'General',
        // },
        // {
        //     id: 4,
        //     active : 1,
        //     status: 'online',
        //     avatar: 'messenger2/avatar-4.jpg',
        //     name: 'Doris Brown',
        // },
        // {
        //     id: 5,
        //     status: 'offline',
        //     name: 'Designer',
        // },
        // {
        //     id: 6,
        //     status: 'away',
        //     avatar: 'messenger2/avatar-6.jpg',
        //     name: 'Steve Walker',
        // },
        // {
        //     id: 7,
        //     status: 'online',
        //     name: 'Albert Rodarte',
        // },
        // {
        //     id: 8,
        //     status: 'online',
        //     name: 'Mirta George',
        // },
        // {
        //     id: 9,
        //     status: 'away',
        //     avatar: 'messenger2/avatar-7.jpg',
        //     name: 'Paul Haynes',
        // },
        // {
        //     id: 10,
        //     status: 'online',
        //     name: 'Jonathan Miller',
        // },
        // {
        //     id: 11,
        //     status: 'away',
        //     avatar: 'messenger2/avatar-8.jpg',
        //     name: 'Ossie Wilson',
        // },
        // {
        //     id: 12,
        //     status: 'online',
        //     name: 'Sara Muller',
        // },
    ],
    messagewrappers: [
        // {
        //     userId: 4,
        //     userName: 'Doris Brown',
        //     userAvatar: 'messenger2/avatar-4.jpg',
        //     messageWrapperId: 1,
        //     messages: [
        //         {
        //             text: 'Good morning',
        //             timestamp: '10:00',
        //             attachments: {},
        //         },
        //     ],
        // },
        // {
        //     userId: 13,
        //     userName: 'Patricia Smith',
        //     userAvatar: 'messenger2/avatar-1.jpg',
        //     messageWrapperId: 2,
        //     messages: [
        //         {
        //             text: 'Good morning, How are you? What about our next meeting?',
        //             timestamp: '10:02',
        //             attachments: {},
        //         },
        //     ],
        // },
        // {
        //     splitter: 'Today',
        //     messageWrapperId: 6,
        // },
        // {
        //     userId: 4,
        //     userName: 'Doris Brown',
        //     userAvatar: 'messenger2/avatar-4.jpg',
        //     messageWrapperId: 3,
        //     messages: [
        //         {
        //             text: 'Yeah everything is fine',
        //             timestamp: '10:05',
        //             attachments: {},
        //         },
        //         {
        //             text: '& Next meeting tomorrow 10.00AM',
        //             timestamp: '10:05',
        //             attachments: {},
        //         },
        //     ],
        // },
        // {
        //     userId: 13,
        //     userName: 'Patricia Smith',
        //     userAvatar: 'messenger2/avatar-1.jpg',
        //     messageWrapperId: 4,
        //     messages: [
        //         {
        //             text: 'Wow that\'s great',
        //             timestamp: '10:06',
        //             attachments: {},
        //         },
        //     ],
        // },
        // {
        //     userId: 4,
        //     userName: 'Doris Brown',
        //     userAvatar: 'messenger2/avatar-4.jpg',
        //     messageWrapperId: 5,
        //     messages: [
        //         {
        //             text: '',
        //             timestamp: '10:09',
        //             attachments: {
        //                 photos: [
        //                     {
        //                         id: 1,
        //                         name: 'Project1',
        //                         src: 'messenger2/img-1.jpg',
        //                     },
        //                     {
        //                         id: 2,
        //                         name: 'Project2',
        //                         src: 'messenger2/img-2.jpg',
        //                     },
        //                     {
        //                         id: 3,
        //                         name: 'Project3',
        //                         src: 'messenger2/img-2.jpg',
        //                     },
        //                 ],
        //             },
        //         },
        //     ],
        // },
        // {
        //     userId: 13,
        //     userName: 'Patricia Smith',
        //     userAvatar: 'messenger2/avatar-1.jpg',
        //     messageWrapperId: 7,
        //     messages: [
        //         {
        //             text: '',
        //             timestamp: '12:16 PM',
        //             attachments: {
        //                 files: [
        //                     {
        //                         name: 'admin_v1.0.zip',
        //                         size: '12.5 MB',
        //                         link: 'messenger2/img-1.jpg',
        //                     },
        //                 ],
        //             },
        //         },
        //     ],
        // },
        // {
        //     userId: 4,
        //     userName: 'Doris Brown',
        //     userAvatar: 'messenger2/avatar-4.jpg',
        //     messageWrapperId: 8,
        //     messages: [
        //         {
        //             userTyping: 1,
        //         },
        //     ],
        // },
    ],
        // userThreads: [
    //     {
    //         id: 1,
    //         user: {
    //             id: 1,
    //             status: 'online',
    //             avatar: 'messenger2/avatar-2.jpg',
    //             name: 'Patrick Hendricks',
    //         },
    //         lastMessage: {
    //             text: 'Hey! there I\'m available',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 2,
    //         user: {
    //             id: 2,
    //             status: 'away',
    //             avatar: 'messenger2/avatar-3.jpg',
    //             name: 'Mark Messer',
    //         },
    //         lastMessage: {
    //             timestamp: Date.now() - 99999,
    //             attachments: {
    //                 photos: [
    //                     {
    //                         name: 'Images'
    //                     }
    //                 ]
    //             },
    //         },
    //         unreadMessages: 2,
    //     },
    //     {
    //         id: 3,
    //         user: {
    //             id: 3,
    //             status: 'offline',
    //             name: 'General',
    //         },
    //         lastMessage: {
    //             text: 'This theme is awesome!',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 4,
    //         active : 1,
    //         user: {
    //             id: 4,
    //             status: 'online',
    //             avatar: 'messenger2/avatar-4.jpg',
    //             name: 'Doris Brown',
    //         },
    //         lastMessage: {
    //             text: 'Nice to meet you',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 5,
    //         user: {
    //             id: 5,
    //             status: 'offline',
    //             name: 'Designer',
    //         },
    //         lastMessage: {
    //             text: 'Next meeting tomorrow 10.00AM',
    //             timestamp: Date.now() - 99999,
    //         },
    //         unreadMessages: 1,
    //     },
    //     {
    //         id: 6,
    //         user: {
    //             id: 6,
    //             status: 'away',
    //             avatar: 'messenger2/avatar-6.jpg',
    //             name: 'Steve Walker',
    //         },
    //         lastMessage: {
    //             timestamp: Date.now() - 99999,
    //             attachments: {
    //                 files: [
    //                     {
    //                         name: 'Admin-A.zip'
    //                     }
    //                 ]
    //             },
    //         },
    //     },
    //     {
    //         id: 7,
    //         user: {
    //             id: 7,
    //             status: 'online',
    //             name: 'Albert Rodarte',
    //         },
    //         userTyping: 1,
    //     },
    //     {
    //         id: 8,
    //         user: {
    //             id: 8,
    //             status: 'online',
    //             name: 'Mirta George',
    //         },
    //         lastMessage: {
    //             text: 'Yeah everything is fine',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 9,
    //         user: {
    //             id: 9,
    //             status: 'away',
    //             avatar: 'messenger2/avatar-7.jpg',
    //             name: 'Paul Haynes',
    //         },
    //         lastMessage: {
    //             text: 'Good morning',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 10,
    //         user: {
    //             id: 10,
    //             status: 'online',
    //             name: 'Jonathan Miller',
    //         },
    //         lastMessage: {
    //             text: 'Hi, How are you?',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 11,
    //         user: {
    //             id: 11,
    //             status: 'away',
    //             avatar: 'messenger2/avatar-8.jpg',
    //             name: 'Ossie Wilson',
    //         },
    //         lastMessage: {
    //             text: 'I\'ve finished it! See you so',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    //     {
    //         id: 12,
    //         user: {
    //             id: 12,
    //             status: 'online',
    //             name: 'Sara Muller',
    //         },
    //         lastMessage: {
    //             text: 'Wow that\'s great',
    //             timestamp: Date.now() - 99999,
    //         },
    //     },
    // ],
    // groupThreads : [
    //     {
    //         id: 1,
    //         group: {
    //             id: 1,
    //             name: 'General',
    //         },
    //     },
    //     {
    //         id: 2,
    //         group: {
    //             id: 2,
    //             name: 'Reporting',
    //         },
    //         unreadMessages: 23,
    //     },
    //     {
    //         id: 3,
    //         group: {
    //             id: 3,
    //             name: 'Designers',
    //         },
    //     },
    //     {
    //         id: 4,
    //         group: {
    //             id: 4,
    //             name: 'Project-alpha',
    //         },
    //     },
    //     {
    //         id: 5,
    //         group: {
    //             id: 5,
    //             name: 'Snacks',
    //         },
    //     },
    // ],
}

export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
  plugins: process.env.NODE_ENV !== 'production'
    ? [createLogger()]
    : []
})
