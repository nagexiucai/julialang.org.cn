<template>
    <div>
        <div class="reply-box">
            <form v-bind:action="reply_action" method="POST" accept-charset="UTF-8" id="reply" v-on:submit.prevent="submit">
                <input type="hidden" name="topic_id" v-bind:value="topic_id">
                <div class="form-group">
                    <textarea v-if="auth_checked === 1 && can_comment === 1" class="form-control" rows="3" placeholder="分享你的想法" name="content"></textarea>
                    <textarea v-else-if="auth_checked === 0" class="form-control" rows="3" placeholder="登录以分享你的想法" name="content" disabled></textarea>
                    <textarea v-else class="form-control" rows="3" placeholder="您暂无评论权限，请联系管理员。" name="content" disabled></textarea>
                </div>
                <div class="form-group">
                    <el-tag
                            v-show="target.target_id !== 0"
                            closable
                            v-bind:disable-transitions="false"
                            @close="removeTarget()">
                        @{{ target.target_name }}
                    </el-tag>
                </div>
                <button v-if="auth_checked === 1 && can_comment === 1" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回复</button>
                <button v-else type="submit" class="btn btn-primary btn-sm" disabled><i class="fa fa-share"></i>回复</button>
                <input type="hidden" name="reply_type" v-bind:value="target.reply_type" />
                <input type="hidden" name="target_id" v-bind:value="target.target_id" />
            </form>
        </div>
        <hr>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "ReplyBox",
        props: [
            'reply_action',
            'topic_id',
            'auth_checked',
            'can_comment'
        ],
        computed: {
            ...mapGetters({
                target: 'getTarget'
            })
        },
        methods: {
            load: function () {
                let url = '/replies/' + this.topic_id;
                let _this = this;
                axios.get(url, {params: {}}).then(function (response) {
                    _this.$store.dispatch('modifyReplies', response.data);
                }).catch(function (error) {
                    _this.$notify({
                        type: 'error',
                        title: error.response.statusText,
                        message: '不妙，操作失败了，请等下再试哦~',
                        duration: 0
                    })
                })
            },
            submit: function (event) {
                let _this = this;
                let el = event.currentTarget;
                let elObj = $(el);
                let data = elObj.serializeObject();
                axios.post(elObj.attr('action'), data).then(function (response) {
                    if (response.data.code === 0) {
                        $(elObj.find('textarea')).val('');
                        _this.$message.success('你发送了一条评论。');
                        _this.load();
                        _this.$store.dispatch('modifyTarget', {
                            'reply_type': 0,
                            'target_id': 0,
                            'target_name': ''
                        });
                    }
                }).catch(function (error) {
                    _this.$notify({
                        type: 'error',
                        title: error.response.statusText,
                        message: error.response.data,
                        duration: 0
                    });
                })
            },
            removeTarget() {
                this.$store.dispatch('modifyTarget', {
                    'reply_type': 0,
                    'target_id': 0,
                    'target_name': ''
                });
            }
        }
    }
</script>

<style scoped>

</style>