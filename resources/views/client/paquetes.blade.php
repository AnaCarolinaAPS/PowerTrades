@extends('layouts.adminlte')

@section('content')
    <page-component tamanho="12">
        <div class="row">
            <div class="col float-right">
                <breadcrumb-component v-bind:lista="{{ $listaMigalhas }}"></breadcrumb-component>
            </div>
        </div>
        <panel-component titulo="Paquetes" classe="border-purple">
            <div class="row">
                <div class="col-md-4">
                    <small-box-component qtd="80" titulo="Artigos" url="#" bgcor="bg-warning" icone="fa fa-pie-chart"></small-box-component>
                </div>
                <div class="col-md-4">
                    <small-box-component qtd="1500" titulo="Usuários" url="#" bgcor="bg-info" icone="fa fa-users"></small-box-component>
                </div>
                <div class="col-md-4">
                    <small-box-component qtd="3" titulo="Autores" url="#" bgcor="bg-teal" icone="fa fa-user"></small-box-component>
                </div>
            </div>
        </panel-component>
    </page-component>
@endsection
