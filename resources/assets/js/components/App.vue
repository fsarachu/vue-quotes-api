<template>
  <div id="app">
    <app-head></app-head>
    <router-view></router-view>
  </div>
</template>

<script>
    import AppHead from '../views/layouts/Head.vue';

    export default {
        components: {
            AppHead
        }
    };
</script>