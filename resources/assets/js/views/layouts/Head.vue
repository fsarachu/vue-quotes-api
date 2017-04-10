<template>
    <nav class="nav has-shadow">
        <div class="container">

            <div class="nav-left">
                <router-link :to="{name: 'home'}" class="nav-item is-tab" activeClass="is-active" exact>Home</router-link>
                <router-link :to="{name: 'about'}" class="nav-item is-tab" activeClass="is-active">About</router-link>
            </div>

        </div>
    </nav>
</template>