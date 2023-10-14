<script setup>
import {ref} from 'vue';

const message = ref('');

function sentMessage(){
 // Assuming you've set up Laravel Echo properly
 Echo.channel('chat') // replace 'chat' with your channel name
        .whisper('message', {
            content: message.value,
        });
    message.value = ''; // Clear the input after sending
}

</script>


<template>
    <h2>Create Message websocket</h2>
    <hr>
    <div>
        <input v-model="message" />
        <button @click="sentMessage" class="btn btn-blue-500 rounded-md px-5 py-2">send message </button>
    </div>
</template>

