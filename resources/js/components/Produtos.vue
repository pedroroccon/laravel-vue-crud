<template>
    <div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 d-block mb-0">Produtos</h1>
            <a @click.prevent="showForm()" href="#" class="btn btn-primary"><i class="far fa-plus-square fa-fw fa-sm mr-2"></i>Adicionar produto</a>
        </div>

        <!-- Mensagens flash -->
        <div class="alert alert-primary" v-if="isShowingMessage">
            <strong>{{ flashMessage }}</strong>
            <button class="close" @click="hideFlashMessage">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Busca dos registros -->
        <div class="input-group form-group">
            <input type="text" name="s" value="" placeholder="Pesquisar..." class="form-control" v-model="search">
            <div class="input-group-append">
                <button @click="clearSearch" v-if="isSearching" class="btn btn-danger"><i class="fas fa-times fa-fw"></i></button>
                <button @click="get()" class="btn btn-success"><i class="fas fa-search fa-fw"></i></button>
            </div>
        </div>

        <div v-if="produtos.length > 0">            
            <article v-for="(produto, index) in produtos" :key="produto.id" class="position-relative card card-body shadow-sm mb-4 border-0">
                <div class="actions">
                    <div class="dropdown">
                        <button href="#" data-toggle="dropdown"><i class="fas fa-bars fa-fw"></i></button>
                        <div class="dropdown-menu dropdown-menu-right shadow-lg">
                            <a href="#" @click.prevent="showForm(index)" class="dropdown-item"><i class="far fa-edit fa-fw fa-sm mr-2"></i>Alterar</a>
                            <a href="#" @click.prevent="remove(index)" class="dropdown-item"><i class="far fa-trash-alt fa-fw fa-sm mr-2"></i>Remover</a>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex">
                    <div class="image mr-4">
                        <img src="https://via.placeholder.com/64" alt="Imagem de exemplo" class="rounded">
                    </div>
                    <div class="content">
                        <div class="info">
                            <h4 class="title"><a :href="produto.path" target="_blank">{{ produto.titulo }}</a></h4>
                            <span class="price my-2">{{ produto.valor | moeda }}</span>
                            <span class="d-block text-muted">Código: {{ produto.codigo }}</span>
                        </div>
                    </div>
                </div>
                <div v-if="produto.observacao" class="mt-2">
                    <hr>
                    <span class="text-muted">{{ produto.observacao }}</span>
                </div>
            </article>
            
            <div class="card card-body shadow-sm border-0 mb-4">
                <span class="h4 d-block mt-3 mb-1">Total: {{ valor | moeda }}</span>
                <small class="text-muted d-block mb-3">{{ total }} registro(s)</small>
            </div>
        </div>
        <div v-else>
            <div class="alert alert-info">
                <strong><i class="fas fa-info-circle fa-fw mr-2"></i>Nenhum registro encontrado</strong>
            </div>
        </div>

        <!-- Form modals -->
        <div class="modal fade" id="produtosForm" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ isEditing !== false ? 'Editar' : 'Adicionar' }} produto</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigo">Código *</label>
                            <input v-model="form.codigo" type="text" name="codigo" id="codigo" class="form-control" autocomplete="off">
                            <span class="form-text text-muted">O código deve ser único.</span>
                            <strong class="text-danger py-1 d-block" v-if="form.errors.has('codigo')" v-text="form.errors.get('codigo')"></strong>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título *</label>
                            <input v-model="form.titulo" type="text" name="titulo" id="titulo" class="form-control" autocomplete="off">
                            <strong class="text-danger py-1 d-block" v-if="form.errors.has('titulo')" v-text="form.errors.get('titulo')"></strong>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input v-model="form.valor" type="number" name="valor" id="valor" class="form-control" autocomplete="off">
                            </div>
                            <strong class="text-danger py-1 d-block" v-if="form.errors.has('valor')" v-text="form.errors.get('valor')"></strong>
                        </div>

                        <div class="form-group">
                            <label for="observacao">Observações</label>
                            <textarea v-model="form.observacao" name="observacao" id="observacao" cols="30" rows="5" class="form-control"></textarea>
                        </div>

                        <small class="d-block">Os campos marcados com * são obrigatórios.</small>
                    </div>
                    <div class="modal-footer">
                        <button @click="isEditing !== false ? update(isEditing) : create()" type="button" class="btn btn-success">{{ isEditing !== false ? 'Editar' : 'Adicionar' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .actions {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0;
        right: 0;
        width: 50px;
        height: 50px;
    }

    .actions button {
        border: none;
        background: none;
    }

    .title {
        display: block;
        max-width: 80%;
        margin-bottom: 0;
        line-height: 1;
        font-weight: 600;
        font-size: 1rem;
    }

    .price {
        display: block;
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: -0.025rem;
    }
</style>

<script>

    export default {
        data() {
            return {
                produtos: {}, 
                total: 0,
                valor: 0, 
                search: '', 
                isLoading: false, 
                isSearching: false, 
                isEditing: false, 
                isShowingMessage: false, 
                flashMessage: '',

                // Form está disponível globalmente 
                // por definição no arquivo app.js
                form: new Form({
                    codigo: '', 
                    titulo: '', 
                    valor: '', 
                    observacao: ''
                })
            }
        },
        methods: {

            // Exibe o formulário de cadastro/edição
            showForm: function(index) {

                if (typeof index !== 'undefined') {
                    // Define o índice que estamos editando.
                    this.isEditing = index;

                    let registro = this.produtos[index];

                    this.form.codigo = registro.codigo;
                    this.form.titulo = registro.titulo;
                    this.form.valor = registro.valor;
                    this.form.observacao = registro.observacao;
                } else {
                    this.isEditing = false;
                    this.form.reset();
                }

                $('#produtosForm').modal('show');
            }, 

            // Create
            create: function() {
                axios.post('/api/produto', this.form.data()).then(response => {
                    this.get();
                    this.showFlashMessage('Produto ' + this.form.titulo + ' adicionado com sucesso!');
                    this.form.reset()
                    $('#produtosForm').modal('hide');
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }, 

            // Read
            get: function() {
                
                this.isLoading = true;
                let endpoint = '/api/produto';

                if (this.search) {
                    this.isSearching = true;
                    endpoint = endpoint + '?s=' + this.search;
                }

                axios.get(endpoint).then(response => {
                    this.produtos = response.data.data;
                    this.total = response.data.total.registros;
                    this.valor = response.data.total.valor;
                }).catch(error => console.log(error))

                this.isLoading = false;
            },

            // Update
            update: function(index) {
                axios.put('/api/produto/' + this.produtos[index].id, this.form.data()).then(response => {
                    this.get();
                    this.showFlashMessage('Produto ' + this.form.titulo + ' alterado com sucesso!');
                    this.form.reset();
                    $('#produtosForm').modal('hide');
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                });
            }, 

            // Delete
            remove: function(index) {
                let registro = this.produtos[index];
                let confirmacao = confirm('Tem certeza que deseja remover o registro ' + registro.codigo + ' - ' + registro.titulo + '? Essa ação é irreversível.')

                if (confirmacao) {
                    axios.delete('/api/produto/' + registro.id).then(response => {
                        this.showFlashMessage('Produto ' + registro.titulo + ' removido!');
                        this.get();
                    }).catch(error => {
                        console.log(error);
                    })
                }
            }, 

            // Limpar busca
            clearSearch: function() {
                this.search = '';
                this.isSearching = false;

                this.get();
            }, 

            // Mensagens de feedback
            showFlashMessage: function(message) {
                this.isShowingMessage = true;
                this.flashMessage = message;
            }, 
            hideFlashMessage: function(message) {
                this.isShowingMessage = false;
                this.flashMessage = '';
            }
        }, 
        filters: {

            // Filtra os valores no 
            // formato brasileiro de 
            // moeda.
            moeda (value) {
                return parseFloat(value).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
            }
        }, 
        mounted() {
            this.get();
        }
    }
</script>
