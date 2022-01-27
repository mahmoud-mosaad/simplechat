
const data = require('./mock-data')
const LATENCY = 16

function rand(){
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

function axiosURL(url){
    axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
    axios.defaults.headers.common['Content-Type'] = 'application/json'
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
    return (window._backpack_url || '') + '/' + url
}

function axiosURLNode(url){
    axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
    axios.defaults.headers.common['Content-Type'] = 'application/json'
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content')
    return ('http://simplechatcore.herokuapp.com' || '') + '/' + url
    // http://localhost:3000
}

export function getAllMessages (cb) {
  setTimeout(() => {
    cb([])
    // axios
    //     .post(axiosURL('graphql'), 
    //         {
    //             query: require('../gql/queries/messages.gql').loc.source.body.toString(), 
    //             variables: {
    //                 first: 5,
    //                 page: 1
    //             }
    //         },
    //         {
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'Accept': 'application/json',
    //             }
    //         }
    //     )
    //     .then(response => {
    //         cb(response.data.data.messages.data)
    //     })
    
    //   axios
    //     .get(axiosURL('api/messages'))
    //     .then(response => (
    //         cb(response.data)
    //     ))
  }, LATENCY)
}

export function getAllContacts (cb) {
    setTimeout(() => {
        cb([])

        // axios
        //     .get(axiosURL('api/users'))
        //     .then(response => (
        //         cb(response.data)
        //     ))
    }, LATENCY)
}

export function getAuthUserData (cb) {
    setTimeout(() => {
        axios
            .get(axiosURL('api/authuser'))
            .then(response => {
                var authUser = response.data

                axios
                    .post(axiosURLNode('graphql'), 
                        {
                            query: require('../gql/queries/user.gql').loc.source.body.toString(), 
                            variables: {
                                id: authUser.id,
                                last: 5,
                                before: ""
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
                        cb(response.data.data.user)
                    })

            })
    }, LATENCY)
}

export function getAllActiveThreads (cb) {
  setTimeout(() => {
      axios
        .get(axiosURLNode('user/active'))
        .then(response => (
            cb(response.data)
        ))
  }, LATENCY)
}

export function getAllActiveThreadsData ({activeThreads}, cb) {
    setTimeout(() => {
        cb([])
      axios
        .get(axiosURL('api/threadUsers'), {
                params: {
                    activeThreads: activeThreads
                }
            })
        .then(response => (
            cb(response.data)
        ))
  }, LATENCY)
}

export function getAllSubscribedThreads (cb) {
    setTimeout(() => {
        cb([])
      axios
        .get(axiosURL('api/userSubscribedThreads'))
        .then(response => (
            cb(response.data)
        ))
  }, LATENCY)
}

export function getFilteredThreads ({searchTerm, par}, cb) {
    setTimeout(() => {
        axios
            .get(axiosURL('api/' + ((par == 'group') ? 'searchGroups' :'searchUsers')), {
                params: {
                    searchTerm: searchTerm
                }
            })
            .then(response => {
                cb(response.data)
            })
    }, LATENCY)
}

export function getThreadData ({user, auth}, cb) {
    setTimeout(() => {
            axios
            .get(axiosURL('api/threadData'), {
                params: {
                    user: user.id
                }
            })
            .then(response => {
                cb(response.data)
            })
    }, LATENCY)
}

export function createMessage ({ id, text, timestamp, attachments, record, author, thread}, cb) {
    const message = {
        id,
        author,
        thread: {
            id: thread.id,
            type: thread.type,
            users: thread.users,
            messages: []
        },
        text,
        timestamp,
        attachments,
        record
    }
    if (thread.type == 'group'){
        message.thread.name = thread.name
        message.thread.description = thread.description
    }
    setTimeout(function () {
        cb(message)
    }, LATENCY)
}
