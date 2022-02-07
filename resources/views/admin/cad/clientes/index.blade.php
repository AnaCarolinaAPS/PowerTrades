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
        <panel-component titulo="Clientes" classe="">
            {{-- {{json_encode($listaModelo)}} --}}
            <table-list-component
                v-bind:titulos="['#', 'COD', 'Nome', 'Referencia']"
                v-bind:itens="{{ json_encode($listaModelo) }}"
                ordem="desc" ordemcol="0"
                criar="" detalhe="/admin/clientes/" editar="/admin/clientes/" deletar="/admin/clientes/" token="{{ csrf_token() }}"
                modal="sim" edtmodal="editar"
                >
            </table-list-component>
        </panel-component>

        <modal-component nome="editar" titulo="Editar Cliente">
            <formulario-component id="formEditarCli" css="" :action="'/admin/clientes/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}" complete="off">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" maxlength="8" v-model="$store.state.item.codigo ? $store.state.item.codigo : $store.state.item.nacionalidade + $store.state.item.numeracao + $store.state.item.abreviacao" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nacionalidad</label>
                            <select v-if="$store.state.item.codigo" class="form-control" id="nacionalidade" name="nacionalidade" v-model="$store.state.item.nacionalidade" readonly>
                                <option value="PYG">Paraguaya</option>
                                <option value="BRA">Brasileira</option>
                                <option value="EUA">American</option>
                            </select>
                            <select v-if="!$store.state.item.codigo" class="form-control" id="nacionalidade" name="nacionalidade" v-model="$store.state.item.nacionalidade">
                                <option value="PYG">Paraguaya</option>
                                <option value="BRA">Brasileira</option>
                                <option value="EUA">American</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="numeracao">Numeración</label>
                            <input v-if="$store.state.item.codigo" type="text" class="form-control" id="numeracao" name="numeracao" maxlength="6" v-model="$store.state.item.numeracao" readonly>
                            <input v-if="!$store.state.item.codigo" type="text" class="form-control" id="numeracao" name="numeracao" maxlength="6" v-model="$store.state.item.numeracao">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="abreviacao">Abreviación</label>
                            <input v-if="$store.state.item.codigo" type="text" class="form-control" id="abreviacao" name="abreviacao" maxlength="6" v-model="$store.state.item.abreviacao" readonly>
                            <input v-if="!$store.state.item.codigo" type="text" class="form-control" id="abreviacao" name="abreviacao" maxlength="6" v-model="$store.state.item.abreviacao" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="referencia">Nombre Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" v-model="$store.state.item.referencia">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" v-model="$store.state.item.name" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="$store.state.item.email" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero_documento">Numero Documento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="form-control" id="tipo_documento" name="tipo_documento" v-model="$store.state.item.tipo_documento" disabled>
                                        <option value="RUC" selected>RUC</option>
                                        <option value="RG">RG</option>
                                        <option value="SI">SI</option>
                                    </select>
                                </div>
                                <input type="text" name="numero_documento" class="form-control" v-model="$store.state.item.numero_documento" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contato">Contacto</label>
                            <input type="text" class="form-control" id="contato" v-model="$store.state.item.contato" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="observacoes">Observaciones</label>
                            <textarea id="observacoes" name="observacoes" class="form-control" v-model="$store.state.item.observacoes"></textarea>
                        </div>
                    </div>
                </div>
            </formulario-component>
            <span slot="botoes">
                <button form="formEditarCli" class="btn btn-info float-right" style="margin-left: 10px;">Guardar</button>
                <modal-link-component tipo="button" nome="excluirpct" titulo="Excluir" css="btn btn-danger float-right"></modal-link-component>
            </span>
        </modal-component>
    </page-component>
@endsection
