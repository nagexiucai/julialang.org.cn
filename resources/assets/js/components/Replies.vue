<template>
    <div class="reply-list">
        <div v-for="(reply, key) in replies">
            <div class="media row" v-bind:name="'reply' + reply.id" v-bind:id="'reply' + reply.id">
                <div class="avatar col-md-1">
                    <a v-bind:href="'/users/show/' + reply.id">
                        <img class="media-object img-thumbnail" v-bind:alt="reply.user.name" v-bind:src="reply.user.avatar"  style="width:48px;height:48px;"/>
                    </a>
                </div>

                <div class="infos col-md-11">
                    <div class="media-heading">
                        <a v-bind:href="'/users/show/' + reply.id" v-bind:title="reply.user.name">
                            {{ reply.user.name }}
                        </a>
                        <span> •  </span>
                        <span class="meta" v-bind:title="reply.created_at">{{ reply.created_at }}</span>

                        <span v-if="reply.can_destroy === true" class="meta pull-right">
                            <button type="submit" class="btn btn-default btn-xs pull-right" v-on:click="remove(reply.id)">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </span>
                        <span v-if="can_comment === 1" class="meta pull-right">
                            <button class="btn btn-default btn-xs pull-right reply" v-on:click="comment(reply.id)">
                                <i class="glyphicon glyphicon-comment"></i>
                            </button>
                        </span>
                    </div>
                    <div class="reply-content">
                        <div v-if="reply.target !== undefined && reply.target.length !== 0" class="reply-ref">
                            <a class="ref" v-bind:href="'#' + 'reply' + reply.target.id">@{{ reply.target.user.name }}</a>
                            <div class="comment" v-html="reply.target.content"></div>
                            <hr />
                        </div>
                        <div v-html="reply.content"></div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Replies",
        props: [
            'topic_id',
            'can_comment'
        ],
        computed: {
            ...mapGetters({
                replies: 'getReplies'
            })
        },
        mounted() {
            this.load();
            this.$store.dispatch('modifyTarget', {
                'reply_type': 1,
                'target_id': this.topic_id
            });
        },
        methods: {
            load: function () {
                let url = '/replies/' + this.topic_id;
                let _this = this;
                axios.get(url, {params: {}}).then(function (response) {
                    console.log(response);
                    _this.$store.dispatch('modifyReplies', response.data);
                }).catch(function (error) {
                    console.log(error)
                })
            },
            remove: function (id) {
                console.log(id);
                this.$confirm('此操作将永久删除该文章, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    let _this = this;
                    let url = '/replies/' + id;
                    axios.delete(url, {params: {}}, {
                        headers: {
                            'Accept': 'application/json',
                        }
                    }).then(function (response) {
                        if (response.data.code === 0) {
                            _this.$message.success('你删除了一条评论。')
                            _this.load()
                        }
                    }).catch(function (error) {
                        _this.$notify({
                            type: 'error',
                            title: error.response.statusText,
                            message: error.response.data,
                            duration: 0
                        })
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });

            },
            comment: function (id) {
                window.location.href = '#reply';
                $($('#reply').find('textarea')[0]).focus();
                this.$store.dispatch('modifyTarget', {
                    'reply_type': 0,
                    'target_id': id
                });
            }
        }
    }
</script>

<style scoped lang="scss">
    .reply-ref {
        .ref {
            color: #3097D1;
        }
    }
</style>