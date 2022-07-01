# Future Space

API para a buscar as informações de lançamentos de foquetes.

## Instalação

Primeiro, execute o comando para instalar os pacotes necessários:

```
composer update
```

Em seguida, execute o comando copiar as configurações do arquivo `.env.example` e certifique-se de que as configurações de conexão do banco de dados estejam corretas.

```
cp .env.example .env
```

Por fim, execute o seguinte comando para inicializar o projeto.

```
php artisan serve
```

Abrir `http://localhost:8000`, para vizualizar as demais rotas execute o camando.

```
php artisan route:list
```
