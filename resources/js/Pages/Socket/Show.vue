<script setup>
import { onMounted } from '@inertiajs/vue3';

onMounted(()=>{
    Echo.channel('trades')
        .listen('NewTrade', (e) => {
            console.log(e.trade);
        })
});
</script>


<template>
    <h2>show websocket</h2>
</template>

