<template>
    <div>
       <div class="container">

            <h1>
                {{ title }}
            </h1>
        </div>
        <div class="container">
            <Card > Ecco lo slot </Card>
            <div>
                <router-link :to="{name: 'posts.show', params:{slug:post.slug}}" v-for='post in posts' :key='post.id'>
                    <PostCard  :post="post" />
                    
                </router-link>
                <!-- <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link> -->
            </div>
        </div>

        <div class="container">
          
            <ul>
                <li :class="{
                'active': page===currentPage
            }"
             v-for="page in lastPage" :key="page"
            @click="fetchPosts(page)"
          >{{page}}</li>
            </ul>
        </div>
      
    </div>

</template>



<script>
import PostCard from '../components/PostCard.vue';
import Card from '../components/Card.vue';


export default {
    components: {
    PostCard,
    Card
},
    data() {
        return {
            title: 'Js disse: Sono Tornatoooooooooo',
            posts: [],
            currentPage:1,
            lastPage:0,
            total:0
        }
    },
    methods: {
        fetchPosts(page= 1) {
            axios.get('/api/posts',{
                params:{
                    page:page
                } 
            }).then((res) => {

                // const { posts } = res.data
                // this.posts = posts
                console.log(res.data)
                const { data, current_page, last_page, total}=res.data.result
                this.posts=data
                this.lastPage=last_page
                this.currentPage=current_page
                this.total=total
                console.log(this.currentPage)

            })

        }
    },

    beforeMount() {
        this.fetchPosts()

    }
}

</script>



<style scoped lang="scss">

.active{
    background-color: yellowgreen;
}
</style>

