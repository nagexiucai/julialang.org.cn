import Vue from 'vue'
import Vuex from 'vuex'
import RepliesTarget from './modules/replies'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        RepliesTarget
    }
})