<template>
    <form v-bind:class="css" v-bind:action="action" v-bind:method="defineMethod" v-bind:enctype="enctype" v-bind:autocomplete="complete">
        <input v-if="alterMethod" type="hidden" name="_method" v-bind:value="alterMethod">
        <input v-if="token" type="hidden" name="_token" v-bind:value="token">
        <slot></slot>
    </form>
</template>

<script>
    export default {
        props: ['css', 'action', 'method', 'enctype', 'token', 'complete'],
        data: function() {
            return {
                alterMethod:"",
            }
        },
        computed:{
            defineMethod: function(){
                if (this.method.toLowerCase() == 'post' || this.method.toLowerCase() == 'get') {
                    return this.method.toLowerCase();
                }
                if (this.method.toLowerCase() == 'put') {
                    this.alterMethod = "put";
                }
                if (this.method.toLowerCase() == 'delete') {
                    this.alterMethod = "delete";
                }
                return "post";
            }
        }
    }
</script>

<style media="screen">

</style>
