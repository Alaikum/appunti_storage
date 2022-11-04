<template>
    <!-- così me lo posta solo se c'è il post, magari da sostituire con un piccolo loading -->
    <div v-if="post"> 
        <section>
            <div class="container">
                <h1>dettaglio articolo</h1>
                <!-- <p>{{$scopedSlots.params.slug}}</p> -->
                <p>slug non preso come Props{{ $route.params.slug }}</p>
                <p>{{ slug }}</p>
             

                <!-- Tags :tags='post.tags' per stampare i tag -->
            </div>
<div>
   <h3>Titolo del post :{{post.title}}</h3>
<p>Creato il{{post.date}}</p>

<!-- se category esiste me lo stampi se no nullo -->
<h4>Categoria={{post.category?.name}}</h4>
</div>
         Contenuto:   <div v-html="post.content"> </div>
        </section>
    </div>
</template>

<script>


export default {
    components: {

    },
    props: ['slug'],
    data() {
        return {
            post: null
        }
    },
    methods: {
        fetchPost() {
            // const slug= this.$route.params.slug
            axios.get(`/api/posts/${this.slug}`).then(res => {
                console.log(res.data)
                console.log('chiamata fatta')
                const { post } = res.data
                this.post=post
            }).catch((err) => {
                console.log(err.response)
                console.log('Non va')
                const {status} =err.response
                //redirect a pagina 404
                if(status===404){
                    this.$router.replace({name:'404'})   //andava bene anche il push sul replace
                    //il replace non ti fa tornare indietro ma a un passo prima
                }
            })
        }
    },
    beforeMount() {
        // console.log(this.$router)
        this.fetchPost()

    }

}
</script>
