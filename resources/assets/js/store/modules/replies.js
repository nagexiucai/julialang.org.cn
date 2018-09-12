import * as types from '../mutation-types'

const state = {
    target : {
        reply_type: 0,
        target_id: 0,
        target_name: '0'
    },
    replies: []
}

const getters = {
    getTarget: (state) => {
        return state.target
    },
    getReplies: (state) => {
        return state.replies
    }
}

const actions = {
    modifyTarget({commit, state}, target) {
        commit(types.CHANGE_REPLY_TARGET, target)
    },
    modifyReplies({commit, state}, repies) {
        commit(types.CHANGE_REPLY_LIST, repies)
    }
}

const mutations = {
    [types.CHANGE_REPLY_TARGET](state, target) {
        state.target = target
    },
    [types.CHANGE_REPLY_LIST](state, replies) {
        state.replies = replies
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}