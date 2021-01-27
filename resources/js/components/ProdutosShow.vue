<template>
    <div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 d-block mb-0">{{ produto.titulo }} - Produtos</h1>
        </div>

        <article class="position-relative card card-body shadow-sm mb-4 border-0">
            <div class="param"><strong>Código:</strong> {{ produto.codigo }}</div>
            <div class="param"><strong>Título:</strong> {{ produto.titulo }}</div>
            <div class="param"><strong>Valor:</strong> {{ produto.valor | moeda }}</div>
            <div class="param"><strong>Observacao:</strong> {{ produto.observacao }}</div>

        </article>
        
    </div>
</template>

<style>
    .param {
        padding: 10px;
        margin: 5px 0;
        display: block;
        background: #f4f4f4;
        border-radius: 6px;
    }
</style>

<script>

    export default {
        props: ['id'], 
        data() {
            return {
                isLoading: true, 
                produto: {
                    id: '', 
                    codigo: '', 
                    titulo: '', 
                    valor: '', 
                    observacao: ''
                }
            }
        },
        methods: {

            get: function() {
                
                this.isLoading = true;

                axios.get('/api/produto/' + this.id).then(response => {
                    this.produto.id = response.data.id;
                    this.produto.codigo = response.data.codigo;
                    this.produto.titulo = response.data.titulo;
                    this.produto.valor = response.data.valor;
                    this.produto.observacao = response.data.observacao;
                }).catch(error => console.log(error))

                this.isLoading = false;
            },
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
