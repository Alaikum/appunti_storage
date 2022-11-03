<template>
    <header>
        <nav class="container">
            <div class="flex">
                <div>Logo</div>
                <ul class="flex">
                    <li v-for="(link,i) in navLinks" :key="30+i">
                        <router-link :to="link.path">{{link.text}}</router-link>
                    </li>
                    <li v-for="(link,i) in navLinks" :key="i">
                        <router-link :to="{name: link.name}">{{link.text}}</router-link>
                    </li>
                    <li >
                        <!-- posso usare il nome della rotta, così che se cambia qualcosa o è troppo lungo il nome non crea problemi -->
                        <router-link :to="{name: 'post'}">Blog</router-link>
                    </li>
                  
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
     data(){
        return{
            navLinks:[
                {
                    text:'Home',
                    path:'/',
                    name:'home'
                },
                {
                    text:'Chi Siamo',
                    path:'/contatti',
                    name:'contact-us'
                },
                {
                    text:'Blog',
                    path:'/post',
                    name:'post'
                }
            ]
        }
     }
    }
</script>



<style lang="scss" scoped>
</style>