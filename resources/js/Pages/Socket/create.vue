<script setup>
import {ref} from 'vue';
import { onMounted } from 'vue';
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
const message = ref('');

function sentMessage(){
    axios.post('http://localhost:8000/broadcast',{
        channel:'trades',
        event_name:'NewTrade',
        event_data:message.value
    }).then(res=>{
        console.log(res)
    }).catch(error=>{
        console.log(error)
    })
    
    // window.Echo.join('trades').whisper('NewEvent',{
    //         data: 'This message will be available from the server.'
    //     }
    // );
    
}



onMounted(()=>{
    window.Echo.channel('trades')
            .listen('NewTrade', (event) => {
                // Handle the incoming trade data
                console.log('New Trade:', event);
            });
});
</script>


<template>
    <h2>Create Message websocket</h2>
    <hr>
    <div>
        <input v-model="message" />
        <button @click="sentMessage" class="text-white hover:bg-blue-700  bg-blue-500 rounded-md px-5 py-2">send message </button>
    </div>
</template>

