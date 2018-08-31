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
                            <form v-bind:action="'/replies/destroy/' + reply.id" method="post">
                                <button type="submit" class="btn btn-default btn-xs pull-right">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </form>
                        </span>
                        <span class="meta pull-right">
                            <a class="btn btn-default btn-xs pull-right reply">
                                <i class="glyphicon glyphicon-comment"></i>
                            </a>
                        </span>
                    </div>
                    <div class="reply-content">
                        {{ reply.content }}
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
            }
        }
    }
</script>

<style scoped>

</style>