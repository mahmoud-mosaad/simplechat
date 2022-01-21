export const threads = state => state.threads

export const contacts = state => state.contacts

export const currentThread = state => {
  return state.currentThreadID
    ? state.threads[state.currentThreadID]
    : {}
}

export const currentMessages = state => {
  const thread = currentThread(state)
    return thread.messages
    ? thread.messages.map(id => state.messages[id])
    : []
}

export const unreadCount = ({ threads }) => {
  return Object.keys(threads).reduce((count, id) => {
    return threads[id].lastMessage.isRead ? count : count + 1
  }, 0)
}

// export const sortedMessages = (state, getters) => {
//   const messages = getters.currentMessages
//   return messages.slice().sort((a, b) => a.timestamp - b.timestamp)
// }

export const sortedMessages = (state, getters) => {

    const messages = getters.currentMessages

    var sorted_messages = messages.slice().sort((a, b) => a.timestamp - b.timestamp)

    var wrappers = []
    var currentUser = null
    var currentMessages = []

    sorted_messages.forEach(message => {
        if (message != null){
            if (currentUser == null)
                currentUser = message.author

            if (currentUser.id != message.author.id){

                wrappers.push({
                    id: (Math.random() + 1).toString(36).substring(7),
                    userId: currentUser.id,
                    userName: currentUser.name,
                    userAvatar: currentUser.avatar,
                    messages: currentMessages,
                })

                currentMessages = []
                currentUser = message.author
            }

            currentMessages.push(
                {
                    text: message.text,
                    timestamp: message.timestamp,
                    attachments: message.attachments,
                    record: message.record,
                }
            )
        }
    })

    if (currentMessages.length){
        wrappers.push({
            id: (Math.random() + 1).toString(36).substring(7),
            userId: currentUser.id,
            userName: currentUser.name,
            userAvatar: currentUser.avatar,
            messages: currentMessages,
        })
    }

    return wrappers
}

export const activeThreads = state => {
    // return state.activeThreads
    return Object.values(state.activeThreads).filter(thread => thread)
}

export const userThreads = state => {
    return Object.values(state.threads).filter(thread => thread.type === 'user')
}

export const groupThreads = state => {
    return Object.values(state.threads).filter(thread => thread.type === 'group')
}
