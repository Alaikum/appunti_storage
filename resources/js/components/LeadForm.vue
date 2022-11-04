<template>
    <div>

        <form @submit.prevent="send">
            <p>
                <input type="text" name="name" v-model="name" placeholder="il tuo nome">
                <input type="text" name="email" v-model="email" placeholder="la tua mail">
            <p>

                <textarea name="message" v-model="message" id="" cols="30" rows="10"
                    placeholder="Il tuo messaggio"></textarea>
            </p>

            <p v-if="errors">
                <p v-for="(error,i) in errors" :key="i">
                {{error.name}}
                {{error.email}}
                {{error.message}}
                </p>
            </p>

            </p>
            <input type="submit" value="invia">
        </form>
    </div>

</template>


<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            message: '',
            errors: {},
        }
    },
    methods: {
        send() {
            const data = {
                name: this.name,
                email: this.email,
                message: this.message
            }
         

            axios.post('/api/leads',data).then(res => {
                console.log(res)
                console.log('manda')
                this.name=this.email=this.message=''
            }).catch(err => {
                console.log(err.response)
                console.log('non manda')
                const{ errors }=err.response.data
                this.errors=errors
            })
        }
    }
}


</script>