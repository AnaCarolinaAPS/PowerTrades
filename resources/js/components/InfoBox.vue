<template>
    <div v-bind:class="defineBgBox">
        <span v-bind:class="defineBgIcon"><i v-bind:class="icone"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">{{titulo}}</span>
            <span class="info-box-number">{{qtd}}</span>
            <div v-if="progress" class="progress">
                <div v-bind:class="defineBgProgress" v-bind:style="defineProgress"></div>
            </div>
            <span v-if="progdesc" class="progress-description">
                {{ progdesc }}
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['qtd', 'titulo', 'bgcor', 'icone', 'bgicon', 'progress', 'progdesc'],
        computed:{
            defineBgBox:function() {
                return "info-box " + (this.bgcor || "");
            },
            defineBgIcon:function() {
                return "info-box-icon " + (this.bgicon || "");
            },
            defineBgProgress:function() {
                return "progress-bar " + (this.bgicon || "");
            },
            defineProgress:function() {
                return "width:  " + (this.progress || "0%");
            },
        }

    }
</script>

<style media="screen">
    .info-box {
        box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        border-radius: .25rem;
        background-color: #fff;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 1rem;
        min-height: 80px;
        padding: .5rem;
        position: relative;
        width: 100%;
    }
    .info-box .info-box-icon {
        border-radius: .25rem;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        font-size: 1.875rem;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        text-align: center;
        width: 70px;
    }
    .info-box .info-box-content {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        line-height: 1.8;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        padding: 0 10px;
    }
    .info-box .info-box-text, .info-box .progress-description {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .info-box .info-box-number {
        display: block;
        margin-top: .25rem;
        font-weight: 700;
    }
    .elevation-1 {
        box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24) !important;
    }
    .dark-mode .info-box {
        background-color: #343a40;
        color: #fff;
    }
    .info-box .progress {
        background-color: rgba(0,0,0,.125);
        height: 2px;
        margin: 5px 0;
    }
    .progress {
        box-shadow: none;
        border-radius: 1px;
    }
    .progress {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        height: 1rem;
        overflow: hidden;
        line-height: 0;
        font-size: .75rem;
        background-color: #e9ecef;
        border-radius: .25rem;
        box-shadow: inset 0 .1rem .1rem rgba(0,0,0,.1);
    }
    .info-box .progress .progress-bar {
        background-color: #fff;
    }
    .info-box .progress-description {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .bg-primary{
        background-color: #3c8dbc !important;
        color: #fff !important;
    }
    .bg-info{
        background-color: #00c0ef !important;
        color: #fff !important;
    }
    .bg-success {
        background-color: #00a65a !important;
        color: #fff !important;
    }
    .bg-warning {
        background-color: #f39c12 !important;
        color: #fff !important;
    }
    .bg-danger {
        background-color: #dd4b39 !important;
        color: #fff !important;
    }
    .bg-navy {
        background-color: #001F3F !important;
        color: #fff !important;
    }
    .bg-teal {
        background-color: #39CCCC !important;
        color: #fff !important;
    }
    .bg-purple {
        background-color: #605ca8 !important;
        color: #fff !important;
    }
    .bg-orange {
        background-color: #ff851b !important;
        color: #fff !important;
    }
    .bg-maroon {
        background-color: #D81B60 !important;
        color: #fff !important;
    }
</style>
