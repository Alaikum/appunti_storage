<template>
 <div>
<img v-if="post.cover" :src="post.cover_path" alt="">
<h3>{{post.title}}</h3>
<p>Creato il{{post.date}}</p>
<p v-if="post.category">{{post.category.name}}</p>
<ul>
    <!-- <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li> -->
</ul>
 </div>
</template>

<script>
    export default {
      props:{
        post:{
            type:Object,
            required:true
        }
      }
    }
</script>
