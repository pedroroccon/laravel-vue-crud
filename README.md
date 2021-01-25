![App screenshot](http://pedroroccon.com.br/laravel-vue-crud/images/preview.png "Laravel + Vue.js CRUD")

# CRUD - Laravel + Vue.js
Repositório criado com o objetivo de apresentar um simples CRUD utilizando Laravel + Vue.js. A aplicação consiste no gerenciamento de produtos.

## Demonstração
Acessar a demo: [pedroroccon.com.br/laravel-vue-crud](http://pedroroccon.com.br/laravel-vue-crud/)

## Instalação e configuração
Para realizar a instalação deste repositório, faça os seguintes passos em seu terminal:

Clone o repositório em uma pasta  
```
git clone https://github.com/pedroroccon/laravel-vue-crud
```

Instale as dependência utilizando o Composer  
```
php composer.phar install
```

Faça uma cópia do arquivo de configuração  
```
cp -R .env.example .env
```

Gere uma chave para a sua aplicação  
```
php artisan key:generate
```

Faça a migração das bases de dados  
```
php artisan migrate --seed
```

Não se esqueça de definir as permissões (caso necessário) nas pasta /bootstrap, /storage, /database.

## Iniciando a aplicação
Você pode iniciar a aplicação através do comando:  
```
php artisan serve
```

## API endpoints
Toda a API foi separada dentro da pasta */crud* do projeto.

### Listar produtos
```
GET /api/produto
```

### Adicionar produtos
```
POST /api/produto
```

### Editar produto
```
PUT|PATCH /api/produto/{id}
```

### Remover produto
```
DELETE /api/produto/{id}
```

## Factories
As factories são utilizadas para criar os produtos de forma dinâmia.
Você pode utilizar as factories através do comando  

```
php artisan tinker
Crud\Models\Produto::factory()->create()
```