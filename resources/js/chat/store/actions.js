import * as api from '../api'

export const getAllMessages = ({ commit }) => {
    api.getAllMessages(messages => {
        commit('receiveAll', messages)
    })
}

export const getAllContacts = ({ commit }) => {
    api.getAllContacts(contacts => {
        commit('setContacts', contacts)
    })
}

export const getAuthUserData = ({ commit }) => {
    api.getAuthUserData(authUser => {
        commit('getAuthUserData', authUser)
    })
}

export const getChatData = ({ commit }) => {
    api.getAuthUserData(authUserData => {
        commit('receiveAuthUserData', authUserData)
        // commit('setAuthUserData', authUser)
        // api.getAllMessages(messages => {
            // commit('receiveAll', messages)
            // api.getAllContacts(contacts => {
                // commit('setContacts', contacts)
			// 	api.getAllSubscribedThreads(subscribedThreads => {
            //         commit('setSubscribedThreads', subscribedThreads)
                    api.getAllActiveThreads(activeThreads => {
                        api.getAllActiveThreadsData({activeThreads: activeThreads}, activeThreadsData => {
                            commit('setActiveThreads', activeThreadsData)
                            setTimeout(() => {
                                commit('disableLoadingStatus')
                            }, 1000)
                        })
                    })    
            //     })
            // })
        // })
    })
}

export const sendContactMessage = ({ commit }, payload) => {
    api.createMessage(payload, message => {
        commit('recieveContactMessage', { message: message, thread: payload.thread, reciever: payload.contact })
    })
}

export const sendGroupMessage = ({ commit }, payload) => {
    api.createMessage(payload, message => {
        commit('recieveGroupMessage', {message, thread: payload.thread})
    })
}

export const sendMessage = ({ commit }, payload) => {
    api.createMessage(payload, message => {
        commit('recieveMessage', message)
    })
}

export const sendAudioRecord = ({ commit }, payload) => {
    api.createMessage(payload, message => {
        commit('recieveMessage', message)
    })
}

export const recievePreviousPagedMessages = ({ commit }, payload) => {
    commit('recievePreviousPagedMessages', payload)
}

export const sendPreviousMessages = ({ commit }, payload) => {
    commit('recievePreviousMessages', payload)
}

export const switchThread = ({ commit }, payload) => {
  commit('switchThread', payload)
}

export const returnToThread = ({ commit }, payload) => {
    commit('returnToThread', payload)
}

export const openChat = ({ commit }, payload) => {
    commit('openChat', payload)
}

export const hideProfile = ({ commit }, payload) => {
    commit('hideProfile', payload)
}

export const showProfile = ({ commit }, payload) => {
    commit('showProfile', payload)
}

export const showEmojiPicker = ({commit}) => {
    commit('showEmojiPicker')
}

export const hideEmojiPicker = ({commit}) => {
    commit('hideEmojiPicker')
}

export const toggleEmojiPicker = ({commit}) => {
    commit('toggleEmojiPicker')
}

export const addActiveThread = ({commit}, payload) => {
    api.getThreadData(payload, threadData => {
        commit('addActiveThread', {threadData, user: payload.user})
    })
}

export const removeActiveThread = ({commit}, payload) => {
    commit('removeActiveThread', payload.user)
}

export const addUserTyping = ({commit}, payload) => {
    commit('addUserTyping', payload)
}

export const removeUserTyping = ({commit}, payload) => {
    commit('removeUserTyping', payload)
}

export const filterThreads = ({commit}, payload) =>
{
    api.getFilteredThreads(payload, filteredResult => {
        if (payload.par == 'user'){
            commit('filterUserThreads', filteredResult)
        }
        else
            commit('filterGroupThreads', filteredResult)
    })
}
