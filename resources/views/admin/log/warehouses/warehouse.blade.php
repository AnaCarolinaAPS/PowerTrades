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
        <div class="row">
            <div class="col-md-6">
                <panel-component titulo="WR-{{ $warehouse->warehouse }}" classe="">
                    <formulario-component id="formEditar" css="" :action="'/admin/warehouses/{{ $warehouse->id }}'" method="put" enctype="" token="{{ csrf_token() }}" complete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="warehouse">Warehouse</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">WR-</span>
                                        </div>
                                        <input type="text" class="form-control" id="warehouse" name="warehouse" placeholder="00000" maxlength="11" required="" aria-describedby="basic-addon1" value="{{ $warehouse->warehouse }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="date" class="form-control" id="data" name="data" value="{{ $warehouse->data }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="remitente">Remitente</label>
                                    <input type="text" class="form-control" id="remetente" name="remetente" placeholder="Nombre del Remitente (Shipper)" value="{{ $warehouse->remetente }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="observacoes">Observaciones</label>
                                    <textarea id="observacoes" name="observacoes" class="form-control">{{ $warehouse->observacoes }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                            <div class="col">
                                <button form="formEditar" class="btn btn-primary float-right" style="margin: 0px 5px;">Guardar</button>
                                <modal-link-component tipo="button" nome="excluir" titulo="Excluir" css="btn btn-danger float-right"></modal-link-component>
                            </div>
                        </div>
                    </formulario-component>
                </panel-component>
            </div>
            <div class="col-md-6">
                <panel-component titulo="Resumo del WR-{{ $warehouse->warehouse }}" classe="bg-primary">
                    <div class="row">
                        <div class="col">
                            <h4 class="modal-title text-center">Cantidad de paquetes: {{ $resumoModelo[0]->ctd_packages }} pcts</h4>
                            <h4 class="modal-title text-center">Cantidad en Stock: {{ $resumoModelo[0]->ctd_packages - $resumoModelo[0]->ctd_retirados }} pcts</h4>
                            <h4 class="modal-title text-center">Cantidad de kgs (EUA): {{ $resumoModelo[0]->total_peso_eua }} kgs</h4>
                            <h4 class="modal-title text-center">Cantidad de kgs (CDE): {{ $resumoModelo[0]->total_peso_pyg == '' ? '0' : $resumoModelo[0]->total_peso_pyg }} kgs</h4>
                            <h4 class="modal-title text-center">Cantidad de kgs (CLI): {{ $resumoModelo[0]->total_peso_cli == '' ? '0' : $resumoModelo[0]->total_peso_cli }} kgs</h4>
                            <h4 class="modal-title text-center">Cantidad de clientes: clientes</h4>
                            <a href="{{ route('warehouses.index') }}" class="btn btn-light float-right">Ver Mais</a>
                        </div>
                    </div>
                </panel-component>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <panel-component titulo="Paquetes del WR-{{ $warehouse->warehouse }}" classe="">
                    <div class="row">
                        <div class="col">
                            {{-- {{json_encode($listaModelo)}} --}}
                            <table-list-component
                                v-bind:titulos="['#', 'Tracknumber', '(COD) Cliente', 'Peso EUA', 'Peso CDE', 'Peso CLI', 'Retirado en']"
                                v-bind:itens="{{ json_encode($listaModelo) }}"
                                ordem="desc" ordemcol="0"
                                criar="#criar" detalhe="/admin/paquetes/" editar="/admin/paquetes/" deletar="/admin/paquetes/" token="{{ csrf_token() }}"
                                modal="sim" edtmodal = "editar"
                                >
                            </table-list-component>
                            {{-- <tabela-lista-component
                                v-bind:titulos="['#', 'Tracknumber', '(COD) Cliente', 'Peso EUA', 'Peso CDE', 'Peso CLI', 'Retirado en']"
                                v-bind:itens="{{ json_encode($listaModelo) }}"
                                ordem="desc" ordemcol="0"
                                criar="#criar" detalhe="/admin/paquetes/" editar="/admin/paquetes/" deletar="/admin/paquetes/" token="{{ csrf_token() }}"
                                modal="sim"
                                >
                            </tabela-lista-component> --}}
                        </div>
                    </div>
                </panel-component>
            </div>
        </div>
    </page-component>
    <modal-component nome="excluir" titulo="Eliminar Warehouse">
        <div class="row">
            <div class="col">
                <h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar la warehouse WR-{{$warehouse->warehouse}}?</h4>
            </div>
            <form id="{{ $warehouse->id }}" action="/admin/warehouses/{{ $warehouse->id }}" method="post" enctype="" token="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
        <span slot="botoes">
            <button form="{{ $warehouse->id }}" class="btn btn-danger">Eliminar</button>
        </span>
    </modal-component>
    <modal-component nome="adicionar" titulo="Nuevo Paquete">
        <formulario-component id="formAdicionar" css="" action="{{ route('paquetes.store') }}" method="post" enctype="" token="{{ csrf_token() }}" complete="off">
            <div class="row">
                <input type="hidden" class="form-control" id="warehouse_id" name="warehouse_id" value="{{ $warehouse->id }}">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_recebimento">Data Recibido</label>
                        <input type="date" class="form-control" id="data_recebimento" name="data_recebimento" value="{{ (!old('data_recebimento') ? date('Y-m-d') : old('data_recebimento') ) }}" autofocus>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ctd_caixas">Ctd Cajas</label>
                        <input type="text" class="form-control" id="ctd_caixas" name="ctd_caixas" maxlength="6" value= "{{ (!old('ctd_caixas') ? 1 : old('ctd_caixas') ) }}" required>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="tracknumber">Tracknumber</label>
                        <input type="text" class="form-control" id="tracknumber" name="tracknumber" placeholder="Rastreo" required value="{{ old('tracknumber') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="selectpicker form-control" data-live-search="true" id="cliente_id" name="cliente_id">
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
                        <input type="text" class="form-control" id="peso_eua" name="peso_eua" placeholder="" maxlength="6" value= "{{ !old('peso_eua')? 0.0 : old('peso_eua') }}" required>
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
            <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
        </span>
    </modal-component>

    <modal-component nome="editar" titulo="Editar Paquete">
        <formulario-component id="formEditarPct" css="" :action="'/admin/paquetes/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}" complete="off">
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
                    <div class="form-group">
                        <label>Retirado por</label>
                        <select class="form-control">
                            <option value="NULL">SIN NOMBRE</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="peso">Peso Cliente</label>
                        <input type="text" class="form-control" id="peso_cli" name="peso_cli" placeholder="" maxlength="6" v-model="$store.state.item.peso_cli > 0 ? $store.state.item.peso_cli : 0.0" >
                    </div>
                </div>
            </div>
        </formulario-component>
        <span slot="botoes">
            <button form="formEditarPct" class="btn btn-info float-right" style="margin-left: 10px;">Guardar</button>
            <modal-link-component tipo="button" nome="excluirpct" titulo="Excluir" css="btn btn-danger float-right"></modal-link-component>
        </span>
    </modal-component>

    <modal-component nome="excluirpct" titulo="Eliminar Paquete">
        <div class="row">
            <div class="col">
                <h4 class="modal-title text-center" id="myModalLabel" v-html="'¿Deseas eliminar el paquete '+$store.state.item.tracknumber+'?'"></h4>
            </div>
            <form :id="$store.state.item.id" :action="'/admin/paquetes/'+$store.state.item.id" method="post" enctype="" token="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
        <span slot="botoes">
            <button :form="$store.state.item.id" class="btn btn-danger">Eliminar</button>
        </span>
    </modal-component>
    {{-- <script>
        $(document).on('shown.bs.modal', function (e) {
            $(e.target, '[autofocus]').focus()
            })
    </script> --}}

@endsection
