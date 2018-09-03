<template>
    <div class="reply-list">
        <div v-for="(reply, key) in replies">
            <div class=" media" v-bind:name="'reply' + reply.id" v-bind:id="'reply' + reply.id">
                <div class="avatar pull-left">
                    <a v-bind:href="'/users/show/' + reply.id">
                        <img class="media-object img-thumbnail" v-bind:alt="reply.user.name" v-bind:src="reply.user.avatar"  style="width:48px;height:48px;"/>
                    </a>
                </div>

                <div class="infos">
                    <div class="media-heading">
                        <a v-bind:href="'/users/show/' + reply.id" v-bind:title="reply.user.name">
                            {{ reply.user.name }}
                        </a>
                        <span> •  </span>
                        <span class="meta" v-bind:title="reply.created_at">{{ reply.created_at }}</span>

                        <span class="meta pull-right">
                            <button type="submit" class="btn btn-default btn-xs pull-right" v-on:click="remove(reply.id)">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </span>
                        <span class="meta pull-right">
                            <a class="btn btn-default btn-xs pull-right reply">
                                <i class="glyphicon glyphicon-comment"></i>
                            </a>
                        </span>
                    </div>
                    <div class="reply-content" v-html="reply.content">

                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Replies",
        props: [
            'topic_id'
        ],
        data() {
            return {
                replies: []
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load: function () {
                let url = '/replies/' + this.topic_id;
                let _this = this;
                axios.get(url, {params: {}}).then(function (response) {
                    console.log(response);
                    _this.replies = response.data;
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
                            _this.$message.success('You\'ve deleted an article.')
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
        }
    }
</script>

<style scoped>

</style>