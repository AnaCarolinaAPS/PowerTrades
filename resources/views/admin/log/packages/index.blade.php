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
        <panel-component titulo="Paquetes" classe="">
            {{-- {{json_encode($listaModelo)}} --}}
            <table-list-component
                v-bind:titulos="['#', 'Warehouse', 'Tracknumber', 'Cliente', 'Peso EUA', 'Peso CDE', 'Peso Cli', 'Fecha Retirada']"
                v-bind:itens="{{ json_encode($listaModelo) }}"
                ordem="desc" ordemcol="0"
                criar="" detalhe="/admin/paquetes/" editar="/admin/paquetes/" deletar="/admin/paquetes/" token="{{ csrf_token() }}"
                modal="sim" edtmodal="editar"
                >
            </table-list-component>
        </panel-component>
    </page-component>
    <modal-component nome="editar" titulo="Editar Paquete">
        {{-- <formulario-component id="formEditar" css="" :action="'/admin/paquetes/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}" complete="off"> --}}
            <div class="row">
                <input type="hidden" class="form-control" id="warehouse_id" name="warehouse_id" v-model="$store.state.item.warehouse_id">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_recebimento">Data Recibido</label>
                        <input type="date" class="form-control" id="data_recebimento" name="data_recebimento" v-model="$store.state.item.data_recebimento">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ctd_caixas">Ctd Cajas</label>
                        <input type="text" class="form-control" id="ctd_caixas" name="ctd_caixas" maxlength="6" v-model="$store.state.item.ctd_caixas" required>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="tracknumber">Tracknumber</label>
                        <input type="text" class="form-control" id="tracknumber" name="tracknumber" placeholder="Rastreo" v-model="$store.state.item.tracknumber" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="selectpicker form-control" data-live-search="true" id="cliente_id" name="cliente_id" v-model="$store.state.item.cliente_id">
                            <option value="">SIN NOMBRE</option>
                            @foreach ($listaClientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->codigo }} - {{ $cliente->referencia }}</option>
                            @endforeach
                          </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="peso">Peso Miami</label>
                        <input type="text" class="form-control" id="peso_eua" name="peso_eua" placeholder="" maxlength="6" v-model="$store.state.item.peso_eua" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="peso">Peso C.D.E.</label>
                        <input type="text" class="form-control" id="peso_pyg" name="peso_pyg" placeholder="" maxlength="6" v-model="$store.state.item.peso_pyg > 0 ? $store.state.item.peso_pyg : 0.0">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="data_retirada">Retirado en</label>
                        <input type="datetime-local" class="form-control" id="data_retirada" name="data_retirada" v-model="$store.state.item.data_retirada">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group" data-live-search="true">
                        <label>Retirado por</label>
                        <select class="selectpicker form-control">
                            <option value="NULL">SIN NOMBRE</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="peso">Peso Cliente</label>
                        <input type="text" class="form-control" id="peso_cli" name="peso_cli" placeholder="" maxlength="6" v-model="$store.state.item.peso_cli > 0 ? $store.state.item.peso_cli : 0.0">
                    </div>
                </div>
            </div>
        {{-- </formulario-component> --}}
        <span slot="botoes">
            {{-- <button form="formEditar" class="btn btn-primary float-right" style="margin: 0px 5px;">Guardar</button> --}}
            <a :href="'/admin/warehouses/'+$store.state.item.warehouse_id" class="btn btn-success" v-html="$store.state.item.warehouse"></p></a>
        </span>
    </modal-component>
@endsection
