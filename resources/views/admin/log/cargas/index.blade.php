@extends('layouts.adminlte')

@section('content')
    <page-component tamanho="12">
        <div class="row">
            <div class="col float-right">
                <breadcrumb-component v-bind:lista="{{ $listaMigalhas }}"></breadcrumb-component>
            </div>
        </div>
        @if ($errors->all())
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ( $errors->all() as $key=>$value)
                <li> {{ $value }} </li>
                @endforeach
            </div>
        @endif
        <panel-component titulo="Cargas" classe="">
            {{-- {{json_encode($listaModelo)}} --}}
            <table-list-component
                v-bind:titulos="['#', 'Fecha Envio', 'Fecha Recibida']"
                v-bind:itens="{{ json_encode($listaModelo) }}"
                ordem="desc" ordemcol="0"
                criar="#criar" detalhe="/admin/warehouses/" editar="/admin/warehouses/" deletar="/admin/warehouses/" token="{{ csrf_token() }}"
                modal="sim"
                >
            </table-list-component>
        </panel-component>
    </page-component>
    <modal-component nome="adicionar" titulo="Nueva Carga">
        <formulario-component id="formAdicionar" css="" action="{{ route('warehouses.store') }}" method="post" enctype="" token="{{ csrf_token() }}" complete="off">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="data">Fecha Envio</label>
                        <input type="date" class="form-control" id="data" name="data" value="{{ (!old('data') ? date('Y-m-d') : '' ) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="despachante">Despachante</label>
                        <input type="text" class="form-control" id="despachante" name="despachante" placeholder="Nombre del Remitente (Shipper)" value="{{ old('remetente') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="despachante">Embarcador</label>
                        <input type="text" class="form-control" id="despachante" name="despachante" placeholder="Nombre del Remitente (Shipper)" value="{{ old('remetente') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="observacoes">Observaciones</label>
                        <textarea id="observacoes" name="observacoes" class="form-control">{{ old('observacoes') }}</textarea>
                    </div>
                </div>
            </div>
        </formulario-component>
        <span slot="botoes">
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
        </span>
    </modal-component>
@endsection
