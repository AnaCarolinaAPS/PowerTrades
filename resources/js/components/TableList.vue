<template>
    <div>
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-1">
                <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
                <modal-link-component v-if="criar && modal" tipo="button" nome="adicionar" titulo="Criar" css=""></modal-link-component>
            </div>
            <div class="col-md-3 offset-md-8">
                <div class="float-right">
                    <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                  <th class="collapse">butão</th>
                <th v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos" scope="col" style="cursor:pointer;"> {{ titulo}} </th>
              </tr>
            </thead>
            <tbody v-if="!edtmodal">
              <tr v-for="(item, index) in lista" v-on:click="clickList(item)">
                    <th v-for="campo in item" scope="row">{{campo | formataData}}</th>
              </tr>
            </tbody>
            <tbody v-if="edtmodal">
                <tr v-for="(item, index) in lista" v-on:click="openInModel(item)" data-toggle="modal" v-bind:data-target="'#'+edtmodal">
                    <!-- <th><modal-link-component v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo="Editar" css=""></modal-link-component></th> -->
                    <th v-for="campo in item" scope="row">{{campo | formataData}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['titulos', 'itens', 'criar', 'ordem', 'ordemcol', 'detalhe', 'editar', 'deletar', 'token', 'modal', 'edtmodal'],
        data:function(){
            return {
                buscar:'',
                ordemAux: this.ordem || 'asc',
                ordemColAuxs: this.ordemcol || 0
            }
        },
        methods: {
            executaForm:function(index) {
                document.getElementById(index).submit();
            },
            ordenaColuna:function(coluna) {
                this.ordemColAuxs = coluna;
                if (this.ordemAux.toLowerCase() == "asc") {
                    this.ordemAux = 'desc';
                } else {
                    this.ordemAux = 'asc';
                }
            },
            clickList: function (item) {
                window.location.href = this.editar + item.id;
            },
            openInModel: function (item) {
                axios.get(this.editar + item.id).then(res => {
                    this.$store.commit('setItem', res.data);
                });
            }
        },
        filters: {
            formataData: function (valor) {
                if (!valor) return '---';

                valor = valor.toString();
                if (valor.split('-').length == 3) {
                    valor = valor.split('-');
                    return valor[2].substr(0, 2) + "/" + valor[1] + "/" + valor[0]
                }
                return valor;
            }
        },
        computed: {
            lista:function(){
                let lista = this.itens;
                let ordem = this.ordemAux;
                let ordemCol = this.ordemColAuxs;

                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if (ordem == "asc") {
                    lista.sort(function(a,b) {
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return 1; }
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
                } else {
                    lista.sort(function(a,b) {
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return 1; }
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return -1; }
                        return 0;
                    });
                }

                if (this.buscar) {
                    // Faz uma iteração sobre itens, aplicando a função... res no caso é cada item que recebe, ou seja, todo o objeto com os campos
                    return lista.filter(res => {
                        for (let k = 0; k<Object.values(res).length; k++) {
                            if((Object.values(res)[k]+"").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                                return true;
                            }
                        }
                        return false;
                    });
                }
                return lista;

                // --------ANTIGO
                // let lista = this.itens.data;
                // let ordem = this.ordemAux;
                // let ordemCol = this.ordemColAuxs;

                // ordem = ordem.toLowerCase();
                // ordemCol = parseInt(ordemCol);

                // if (ordem == "asc") {
                //     lista.sort(function(a,b) {
                //         if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return 1; }
                //         if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return -1; }
                //         return 0;
                //     });
                // } else {
                //     lista.sort(function(a,b) {
                //         if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) { return 1; }
                //         if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) { return -1; }
                //         return 0;
                //     });

                // }

                // if (this.buscar) {
                //     // Faz uma iteração sobre itens, aplicando a função... res no caso é cada item que recebe, ou seja, todo o objeto com os campos
                //     return lista.filter(res => {
                //         for (let k = 0; k<Object.values(res).length; k++) {
                //             if((Object.values(res)[k]+"").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                //                 return true;
                //             }
                //         }
                //         return false;
                //     });
                // }
                // return lista;
            }
        }
    }
</script>

<style media="screen">

</style>
