@extends('layouts.adminlte')

@section('content')
    <page-component tamanho="12">
        <div class="row">
            <div class="col float-right">
                <breadcrumb-component v-bind:lista="{{ $listaMigalhas }}"></breadcrumb-component>
            </div>
        </div>
        <panel-component titulo="Painel" classe="">
            @can('eAdm')
                <div class="row">
                    <div class="col-md-4">
                        <small-box-component qtd="250" titulo="Clientes" url="#" bgcor="bg-teal" icone="fa fa-users"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="1.500 kgs" titulo="en Miami" url="#" bgcor="bg-info" icone="fa fa-box-open"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="U$ 10.000,00" titulo="Falta Cobrar" url="#" bgcor="bg-green" icone="fa fa-hand-holding-usd"></small-box-component>
                    </div>
                </div>
            @endcan
            @can('eLog')
                <div class="row">
                    <div class="col-md-4">
                        <small-box-component qtd="1.500 kgs" titulo="en Miami" url="#" bgcor="bg-teal" icone="fa fa-plane-departure"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="1.200 kgs" titulo="en Aduana" url="#" bgcor="bg-info" icone="fa fa-plane-arrival"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="1.200 kgs" titulo="en Stock" url="#" bgcor="bg-green" icone="fa fa-box-open"></small-box-component>
                    </div>
                </div>
            @endcan
            @can('eFin')
                <div class="row">
                    <div class="col-md-4">
                        <small-box-component qtd="U$ 10.000,00" titulo="Falta Cobrar" url="#" bgcor="bg-teal" icone="fa fa-hand-holding-usd"></small-box-component>
                    </div>
                    {{-- <div class="col-md-4">
                        <small-box-component qtd="U$ 1.000,00" titulo="Falta Pagar (Carga)" url="#" bgcor="bg-info" icone="fa fa-file-invoice-dollar"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="U$ 1.000,00" titulo="Gastos da Semana" url="#" bgcor="bg-green" icone="fa fa-dollar-sign"></small-box-component>
                    </div> --}}
                </div>
            @endcan
            @can('eCli')
                <div class="row">
                    @if ($cliente->codigo == '')
                        <div class="col">
                            <alert-component classe="bg-warning" titulo="Atenção!" icone="fa fa-warning">
                                <p>Nossa equipe está revisando seu cadastro, por favor aguarde liberação.</p>
                                <p>Você também pode enviar uma mensagem para nossa equipe para agilizar os processos em nosso número (+595 983781248).</p>
                            </alert-component>
                        </div>
                    @endif
                    {{-- <div class="col-md-4">
                        <small-box-component qtd="U$ 1.000,00" titulo="Falta Cobrar" url="#" bgcor="bg-teal" icone="fa fa-hand-holding-usd"></small-box-component>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <small-box-component qtd="U$ 1.000,00" titulo="Falta Pagar (Carga)" url="#" bgcor="bg-info" icone="fa fa-file-invoice-dollar"></small-box-component>
                    </div>
                    <div class="col-md-4">
                        <small-box-component qtd="U$ 1.000,00" titulo="Gastos da Semana" url="#" bgcor="bg-green" icone="fa fa-dollar-sign"></small-box-component>
                    </div> --}}
                </div>
            @endcan
            {{-- <div class="row">
                <div class="col">
                    <alert-component classe="bg-danger" titulo="Alert!" icone="fa fa-warning">
                        <p>Teste</p>
                    </alert-component>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col">
                    <callout-component classe="bg-maroon" titulo="">
                        <p>Teste</p>
                    </callout-component>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-4">
                    <info-box-component qtd="80" titulo="Artigos" bgcor="bg-maroon" icone="fa fa-pie-chart" progress="50%"></info-box-component>
                </div>
                <div class="col-md-4">
                    <info-box-component qtd="1500" titulo="Usuários" bgcor="bg-primary" icone="fa fa-users" progress="95%"></info-box-component>
                </div>
                <div class="col-md-4">
                    <info-box-component qtd="3" titulo="Autores" bgcor="bg-success" icone="fa fa-user" progress="25%"></info-box-component>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-4">
                    <small-box-component qtd="80" titulo="Artigos" url="#" bgcor="bg-warning" icone="fa fa-pie-chart"></small-box-component>
                </div>
                <div class="col-md-4">
                    <small-box-component qtd="1500" titulo="Usuários" url="#" bgcor="bg-info" icone="fa fa-users"></small-box-component>
                </div>
                <div class="col-md-4">
                    <small-box-component qtd="3" titulo="Autores" url="#" bgcor="bg-teal" icone="fa fa-user"></small-box-component>
                </div>
            </div> --}}
        </panel-component>
    </page-component>
{{-- <div class="container">
    <div class="row justify-content-center">

    </div>
</div> --}}
@endsection
