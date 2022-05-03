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
        <panel-component titulo="Fleteros" classe="">
            {{-- {{json_encode($listaModelo)}} --}}
            <table-list-component
                v-bind:titulos="['#', 'Nome', 'Referencia', 'Documento', 'Contato']"
                v-bind:itens="{{ json_encode($listaModelo) }}"
                ordem="desc" ordemcol="0"
                criar="#criar" detalhe="/admin/freteiros/" editar="/admin/freteiros/" deletar="/admin/freteiros/" token="{{ csrf_token() }}"
                modal="sim" edtmodal="editar"
                >
            </table-list-component>
        </panel-component>
        <modal-component nome="adicionar" titulo="Nuevo Fletero">
            <formulario-component id="formAdicionar" css="" action="{{ route('freteiros.store') }}" method="post" enctype="" token="{{ csrf_token() }}" complete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nombre Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="referencia">Nombre Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" value="{{ old('referencia') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tipo_documento">Documento</label>
                            <select class="custom-select" id="tipo_documento" name="tipo_documento">
                                <option value="RUC" selected>RUC</option>
                                <option value="RG">RG</option>
                                <option value="SI">SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero_documento">Nro. Documento</label>
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contato">Contacto</label>
                            <input type="text" class="form-control" id="contato" name="contato" value="{{ old('contato') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nacionalidade">Nacionalidade</label>
                            <select class="custom-select" id="nacionalidade" name="nacionalidade">
                                <option value="PYG" selected>PYG</option>
                                <option value="BRA">BRA</option>
                                <option value="EUA">EUA</option>
                            </select>
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

        <modal-component nome="editar" titulo="Editar Fletero">
            <formulario-component id="formEditar" css="" :action="'/admin/freteiros/'+$store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}" complete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nombre Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" v-model="$store.state.item.nome">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="referencia">Nombre Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" v-model="$store.state.item.referencia">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contato">Contacto</label>
                            <input type="text" class="form-control" id="contato" name="contato" v-model="$store.state.item.contato">
                        </div>
                    </div>
                    <div class="col-md-5">
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
                            <label>Nacionalidad</label>
                            <select class="form-control" id="nacionalidade" name="nacionalidade" v-model="$store.state.item.nacionalidade" disabled>
                                <option value="PYG">Paraguaya</option>
                                <option value="BRA">Brasileira</option>
                                <option value="EUA">American</option>
                            </select>
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
                <button form="formEditar" class="btn btn-info float-right" style="margin-left: 10px;">Guardar</button>
            </span>
        </modal-component>
    </page-component>
@endsection
