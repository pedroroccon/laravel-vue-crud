# CRUD - Laravel + Vue.js
Repositório criado com o objetivo de apresentar um simples CRUD utilizando Laravel + Vue.js. A aplicação consiste no gerenciamento de produtos.

## Demonstração
Acesso uma demonstração deste pacote.

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

### Listar produtos
```
GET /api/produtos
```

### Adicionar produtos

### Editar produto

### Remover produto

## Factories