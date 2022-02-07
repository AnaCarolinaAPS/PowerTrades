@extends('layouts.adminlte')

@section('content')
    <page-component tamanho="12">
        <div class="row">
            <div class="col float-right">
                <breadcrumb-component v-bind:lista="{{ $listaMigalhas }}"></breadcrumb-component>
            </div>
        </div>
        <panel-component titulo="Mis Datos" classe="border-purple">
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
            <formulario-component id="formEditar" css="" :action="'/admin/dados/{{ $user->id }}'" method="put" enctype="" token="{{ csrf_token() }}" complete="off">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data">Codigo</label>
                            @if ($cliente != '[]')
                                <input type="text" class="form-control" value="{{ $cliente->codigo }}" readonly>
                            @else
                                <input type="text" class="form-control" value="AGUARDE" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nacionalidade</label>
                            <select class="selectpicker form-control" id="nacionalidade" name="nacionalidade">
                                <option value="PYG" {{ $user->nacionalidade == 'PYG' ? 'selected' : ''}}>Paraguaya</option>
                                <option value="BRA" {{ $user->nacionalidade == 'BRA' ? 'selected' : ''}}>Brasileira</option>
                                <option value="EUA" {{ $user->nacionalidade == 'EUA' ? 'selected' : ''}}>American</option>
                              </select>
                          </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="numero_documento">Documento</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">{{ $user->tipo_documento }}</span>
                                </div>
                                <input type="text" class="form-control" id="numero_documento" maxlength="11" required="" aria-describedby="basic-addon1" value="{{ $user->numero_documento }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data">Nome Completo</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="contato">Contato</label>
                            <input type="text" class="form-control" id="contato" name="contato" value="{{ $user->contato }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password_confirmation">Confirme a Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button form="formEditar" class="btn btn-primary float-right" style="margin: 0px 5px;">Guardar</button>
                    </div>
                </div>
            </formulario-component>
        </panel-component>
    </page-component>
@endsection
