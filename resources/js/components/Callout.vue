<template>
    <div v-bind:class="defineClass">
        <h4 v-if="titulo">{{titulo}}</h4>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:['classe', 'titulo'],
        computed:{
            defineClass: function() {
                return "callout " + (this.classe || "bg-primary");
            }
        }
    }
</script>

<style>
    .callout {
        border-radius: 3px;
        margin: 0 0 20px 0;
        padding: 15px 30px 15px 15px;
        border-left: 5px solid #eee;
    }
    .callout h4 {
        font-size: 18px;
        font-weight: 600;
        font-family: 'Source Sans Pro',sans-serif;
    }
    .callout p {
        margin-bottom: 0;
    }
    .bg-primary{
        background-color: #3c8dbc !important;
        color: #fff !important;
        border-color: #357ca5;
    }
    .bg-info{
        background-color: #00c0ef !important;
        color: #fff !important;
        border-color: #0097bc;
    }
    .bg-success {
        background-color: #00a65a !important;
        color: #fff !important;
        border-color: #00733e;
    }
    .bg-warning {
        background-color: #f39c12 !important;
        color: #fff !important;
        border-color: #c87f0a;
    }
    .bg-danger {
        background-color: #dd4b39 !important;
        color: #fff !important;
        border-color: #c23321;
    }
    .bg-navy {
        background-color: #193552 !important;
        color: #fff !important;
        border-color: #001a35;
    }
    .bg-teal {
        background-color: #39CCCC !important;
        color: #fff !important;
        border-color: #30bbbb;
    }
    .bg-purple {
        background-color: #605ca8 !important;
        color: #fff !important;
        border-color: #555299;
    }
    .bg-orange {
        background-color: #ff851b !important;
        color: #fff !important;
        border-color: #e57718;
    }
    .bg-maroon {
        background-color: #D81B60 !important;
        color: #fff !important;
        border-color: #ac154c;
    }
</style>
