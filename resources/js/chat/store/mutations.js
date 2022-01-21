import Vue from 'vue'
import { contacts } from './getters'

export default {

  receiveAuthUserData (state, authUserData) {

    state.authUser = {
      id: authUserData.id,
      name: authUserData.name,
      avatar: authUserData.avatar,
      email: authUserData.email,
      hash: authUserData.hash,
    }

    authUserData.threads.forEach(thread => {

      if (thread.messages.edges.length > 0){
        var latestMessage

        thread.messages.edges.forEach(edge => {

          var message = edge.node
          message.cursor = edge.cursor

          message.attachments = JSON.parse(message.attachments)
          message.record = JSON.parse(message.record)

          // create new thread if the thread doesn't exist
          if (!state.threads[message.thread.id]) {
            var meta = {
              totalCount: thread.messages.totalCount,
              pageInfo: thread.messages.pageInfo
            }
            createThread(state, message.thread.id, message.thread, message, meta)
          }
          // mark the latest message
          if (!latestMessage || message.timestamp > latestMessage.timestamp) {
            latestMessage = message
          }

          // add message
          addMessage(state, message)

        })

        // set initial thread to the one with the latest message
        setCurrentThread(state, latestMessage.thread.id)
        state.filteredUserThreads = Object.values(state.threads).filter(thread => thread.type === 'user')
        state.filteredGroupThreads = Object.values(state.threads).filter(thread => thread.type === 'group')
      }

    })

  },

  receiveAll (state, messages) {

    if (messages.length > 0){
      var latestMessage
      messages.forEach(message => {

        message.attachments = JSON.parse(message.attachments)
        message.record = JSON.parse(message.record)

        // create new thread if the thread doesn't exist
        if (!state.threads[message.thread.id]) {
          createThread(state, message.thread.id, message.thread, message)
        }
        // mark the latest message
        if (!latestMessage || message.timestamp > latestMessage.timestamp) {
          latestMessage = message
        }
        // add message
        addMessage(state, message)
      })

      // set initial thread to the one with the latest message
      setCurrentThread(state, latestMessage.thread.id)
      state.filteredUserThreads = Object.values(state.threads).filter(thread => thread.type === 'user')
      state.filteredGroupThreads = Object.values(state.threads).filter(thread => thread.type === 'group')
    }

    // state.contacts = state.contacts.sort((a, b) => a.name.localeCompare(b.name))
    // state.contacts = state.contacts.sort((a, b) => a.name !== b.name ? a.name < b.name ? -1 : 1 : 0)

  },

  recieveMessage (state, message) {
    addMessage(state, message)
  },

  recieveContactMessage (state, { message, thread, reciever }) {

      if (state.threads.hasOwnProperty(thread.id)){
          if (!state.threads[thread.id].messages.filter(m => m == message.id)){
            state.threads[thread.id].messages.push(message.id)
          }
          state.threads[thread.id].lastMessage = message
      }
      else{
          Vue.set(state.threads, thread.id, {
              id: thread.id,
              type: thread.type,
              user: reciever,
              messages: [message.id],
              lastMessage: message,
              unreadMessages: 0,
              users: thread.users,
              users_typing: [],
              page: 1
          })
      }

      setCurrentThread(state, thread.id)
      addMessage(state, message)
      state.filteredUserThreads = Object.values(state.threads).filter(thread => thread.type === 'user')
  },

  recieveGroupMessage (state, { message, thread }) {

    if (state.threads.hasOwnProperty(thread.id)){
        if (!state.threads[thread.id].messages.filter(m => m == message.id)){
          state.threads[thread.id].messages.push(message.id)
        }
        state.threads[thread.id].lastMessage = message
    }
    else{
        Vue.set(state.threads, thread.id, {
            id: thread.id,
            type: thread.type,
            group: {
              name: thread.name,
              description: thread.description
            },
            messages: [message.id],
            lastMessage: message,
            unreadMessages: 0,
            users: thread.users,
            users_typing: [],
            page: 1
        })
    }

    setCurrentThread(state, thread.id)
    addMessage(state, message)
    state.filteredGroupThreads = Object.values(state.threads).filter(thread => thread.type === 'group')
  },

  recievePreviousPagedMessages(state, data){

    state.threads[state.currentThreadID].page += 1
    state.threads[state.currentThreadID].pageInfo.startCursor = data.pageInfo.startCursor
    state.threads[state.currentThreadID].pageInfo.hasNextPage = data.pageInfo.hasNextPage

    data.edges.reverse().forEach(edge => {

      var message = edge.node
      message.cursor = edge.cursor

      message.isRead = message.thread.id === state.currentThreadID
      const thread = state.threads[message.thread.id]
      if (!thread.messages.some(id => id === message.id)) {
        thread.messages.unshift(message.id)
      }

      if (message.attachments.files)
      {
        message.attachments.files.forEach(file => {
          if (state.threadAttachments[message.thread.id] == undefined) state.threadAttachments[message.thread.id] = []
          state.threadAttachments[message.thread.id].push(file)
        })
      }
    
      if (message.attachments.photos)
      {
        message.attachments.photos.forEach(photo => {
          if (state.threadPhotos[message.thread.id] == undefined) state.threadPhotos[message.thread.id] = []
          state.threadPhotos[message.thread.id].push(photo)
        })
      }

      Vue.set(state.messages, message.id, message)
    })

  },

  recievePreviousMessages(state, data){

    state.threads[state.currentThreadID].page += 1

    data.reverse().forEach(message => {
      message.isRead = message.thread.id === state.currentThreadID
      const thread = state.threads[message.thread.id]
      if (!thread.messages.some(id => id === message.id)) {
        thread.messages.unshift(message.id)
      }

      if (message.attachments.files)
      {
        message.attachments.files.forEach(file => {
          if (state.threadAttachments[message.thread.id] == undefined) state.threadAttachments[message.thread.id] = []
          state.threadAttachments[message.thread.id].push(file)
        })
      }
    
      if (message.attachments.photos)
      {
        message.attachments.photos.forEach(photo => {
          if (state.threadPhotos[message.thread.id] == undefined) state.threadPhotos[message.thread.id] = []
          state.threadPhotos[message.thread.id].push(photo)
        })
      }

      Vue.set(state.messages, message.id, message)
    })

  },

  setSubscribedThreads(state, subscribedThreads){
    state.subscribedThreads = subscribedThreads
  },

  setAuthUserData (state, authUser) {
    state.authUser = authUser
  },

  setActiveThreads(state, activeThreads){
      state.activeThreads = activeThreads
  },

  addActiveThread (state, {threadData, user}) {
    Vue.set(state.activeThreads, threadData.id, {
      id: threadData.id, 
      type: threadData.type, 
      user: threadData.user, 
      users: threadData.users
    })
  },

  removeActiveThread (state, user) {
    for (const [key, thread] of Object.entries(state.activeThreads)) {
      if (thread.user.id == user){
        Vue.delete(state.activeThreads, thread.id);
      }
    }
  },

  filterUserThreads (state, filteredResult) {

      var filteredThreads = {}
      for (const [key, thread] of Object.entries(state.threads)) {

          thread.users.filter(u => {
            if (filteredResult.includes(u.id)){
                filteredThreads[thread.id] = thread
            }
          })
      }
      state.filteredUserThreads = filteredThreads
  },

  filterGroupThreads (state, filteredResult) {

    var filteredThreads = {}
    for (const [key, thread] of Object.entries(state.threads)) {
        if (filteredResult.includes(thread.id)){
          filteredThreads[thread.id] = thread
        }
    }

    state.filteredGroupThreads = filteredThreads
  },

  addUserTyping (state, { user, thread}) {

      const result = state.threads[thread.id].users_typing.find( ({ id }) => id == user.id )

      if (!result)
          state.threads[thread.id].users_typing.push(user)
  },

  removeUserTyping (state, { user, thread}) {

      const result = state.threads[thread.id].users_typing.find( ({ id }) => id != user.id )

      state.threads[thread.id].users_typing = result ? result : [];
  },

  switchThread (state, id) {
      setCurrentThread(state, id)
      state.showChatOnly = 1
  },

  returnToThread (state){
      state.showChatOnly = 0
  },

  hideProfile (state) {
      state.toggleProfile = 0
  },

  showProfile (state) {
      state.toggleProfile = 1
  },

  showEmojiPicker (state) {
      state.emojiPickerStatus = true
  },

  hideEmojiPicker (state) {
      state.emojiPickerStatus = false
  },

  toggleEmojiPicker (state) {
      state.emojiPickerStatus = !state.emojiPickerStatus
  },

  setContacts (state, contacts) {
      state.contacts = contacts
  },

  disableLoadingStatus (state) {
      state.loadingStatus = false
  }

}

function createThread (state, id, thread, message, meta) {
  state.subscribedThreads.push(thread.id)
  if (thread.type == 'user'){
    Vue.set(state.threads, id, {
        id: thread.id,
        type: thread.type,
        user: message.author,
        messages: [message.id],
        lastMessage: message,
        unreadMessages: 0,
        users: message.thread.users,
        users_typing: [],
        totalMessagesCount: meta.totalCount,
        pageInfo: meta.pageInfo,
        page: 1
    })
    var contact = message.thread.users[0].id == message.author.id ? message.thread.users[1] : message.thread.users[0]
    if (!state.contacts[contact.name[0]]){
      state.contacts[contact.name[0]] = []
    }
    state.contacts[contact.name[0]].push(contact)
  }
  else{
    Vue.set(state.threads, id, {
      id: thread.id,
      type: thread.type,
      group: {
        name: thread.name,
        description: thread.description,
      },
      messages: [message.id],
      lastMessage: message,
      unreadMessages: 0,
      users: message.thread.users,
      users_typing: [],
      totalMessagesCount: meta.totalCount,
      pageInfo: meta.pageInfo,
      page: 1
    })
  }
}

function addMessage (state, message) {
  // add a `isRead` field before adding the message
  message.isRead = message.thread.id === state.currentThreadID
  // add it to the thread it belongs to
  const thread = state.threads[message.thread.id]
  if (!thread.messages.some(id => id === message.id)) {
    thread.messages.push(message.id)
    thread.lastMessage = message
  }

  if (message.attachments.files)
  {
    message.attachments.files.forEach(file => {
      if (state.threadAttachments[message.thread.id] == undefined) state.threadAttachments[message.thread.id] = []
      state.threadAttachments[message.thread.id].push(file)
    })
  }

  if (message.attachments.photos)
  {
    message.attachments.photos.forEach(photo => {
      if (state.threadPhotos[message.thread.id] == undefined) state.threadPhotos[message.thread.id] = []
      state.threadPhotos[message.thread.id].push(photo)
    })
  }

  // add it to the messages map
  Vue.set(state.messages, message.id, message)
}

function setCurrentThread (state, id) {
  state.currentThreadID = id
  if (!state.threads[id]) {
    debugger
  }
  // mark thread as read
  state.threads[id].lastMessage.isRead = true
}
