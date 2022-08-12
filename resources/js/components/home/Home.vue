<template>
    <div>
        <Navbar/>
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Voting App</h1>
                <br>
                <router-link class="btn btn-primary btn-lg" to="/polls/create" role="button">Create Poll</router-link>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="poll" v-for="(poll, index) in polls" :key="index">
                        <router-link :to="'/polls/manage/' + poll.id" target="_blank">{{ poll.question }}</router-link>
                        <span>{{ poll.votes_count }} Vote</span>
                        <div class="btn-group" role="group">
                             <router-link :to="'/polls/view/' + poll.id" target="_blank"><button type="button" class="btn btn-warning">Vote View</button></router-link>
                             <router-link :to="'/polls/manage/' + poll.id" target="_blank"><button type="button" class="btn btn-success">View Result</button></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Navbar from '../common/Navbar';

    export default {
        name: 'Home',
        components: {
            Navbar
        },
        data() {
            return {
                polls: []
            }
        },
        created() {
            this.getPolls();
        },
        methods: {
            getPolls() {
                window.api.call('post', '/polls/all', {}).then(({data}) => {
                    this.polls = data.polls;
                    this.$store.commit('hideLoader');
                });
            }
        }
    }

</script>
