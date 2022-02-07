<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a v-bind:href="link" class="brand-link text-center">
            <!-- <img v-if="empresa" v-bind:src="logo" v-bind:alt="empresa+' Logo'" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <img v-if="empresa" v-bind:src="logo" alt="Logo" class="brand-image" style="float: none !important;">
            <span class="brand-text font-weight-light" style="opacity: 0.00">{{ "." }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img v-bind:src="avatar" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a v-bind:href="linkuser" class="d-block">{{ usuario }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <slot></slot>
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        props:['logo', 'empresa', 'link', 'avatar', 'usuario', 'linkuser'],
    }
</script>

<style>
    .main-sidebar {
        position: fixed !important;;
    }
</style>
