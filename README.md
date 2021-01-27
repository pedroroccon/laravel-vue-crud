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

Instale as dependência utilizando o Composer dentro do pasta do projeto  
```
cd laravel-vue-crud
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

Por padrão, nós utilizamos SQLite como base de dados.  
Caso você deseje continuar utilizando o SQLite, não se esqueça de criar o arquivo em database/database.sqlite  
```
touch database/database.sqlite
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
Toda a API foi separada dentro da pasta **/crud** do projeto, desta forma isolamos as regras de negócio da API em um pacote somente dela, facilitando a migração e implementação em outras versões do Laravel.

### Listar produtos
```
GET /api/produto
```
Você também pode filtrar os produtos utilizando alguns campos especiais na URL  
```
GET /api/produto?s={pesquisa} // Irá fazer uma busca por código/titulo
GET /api/produto?codigo={seu_codigo} // Irá filtrar os produtos por código
GET /api/produto?titulo={titulo} // Irá filtrar os produtos por título
GET /api/produto?valor_inicial={valor} // Irá filtrar os produtos a partir de um valor inicial
GET /api/produto?valor_final={valor} // Irá filtrar os produtos com o valor final menor que o informado
```
Também podemos combinar mais de um filtro na URL. Por exemplo, se quisermos filtrar um produto pelo código ou título com o valor menor que R$5.000,00, podemos usar a URL  
```
GET /api/produto?s=iPhone&valor_final=5000
```

### Adicionar produtos
Para adicionar um produto, faça uma chamada **POST** para o endereço abaixo  
```
POST /api/produto
```
Os seguintes campos são necessários para adicionar um produto  
- Código (Obrigatório, único)
- Título (Obrigatório)
- Valor (Obrigatório, númerico)

### Visualizar produto
Para visualizar um produto faça uma chamada **GET** para o endereço abaixo, substituindo o parâmetro **{id}** pelo ID do produto  
```
GET /api/produto/{id}
```

### Editar produto
Para editar um produto faça uma chamada **PUT/PATCH** para o endereço abaixo, substituindo o parâmetro **{id}** pelo ID do produto  
```
PUT|PATCH /api/produto/{id}
```

### Remover produto
Para remover um produto faça uma chamada **DELETE** para o endereço abaixo, substituindo o parâmetro **{id}** pelo ID do produto  
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