# Cat API Integration with Laravel

Este projeto demonstra a integração com The Cat API usando o HTTP Client do Laravel.

## Configuração do Projeto

1. Clone o repositório
2. Instale as dependências:
```bash
composer install
```
3. Copie o arquivo `.env.example` para `.env`:
```bash
cp .env.example .env
```
4. Gere a chave da aplicação:
```bash
php artisan key:generate
```
5. Configure a chave da API:
   - Cadastre-se em [The Cat API](https://thecatapi.com/) para obter sua chave de API
   - Adicione sua chave de API no arquivo `.env`:
   ```
   CAT_API_KEY=sua_chave_api_aqui
   ```

## Endpoints da API

Todos os endpoints são prefixados com `/api/cats`

### 1. Obter Imagem Aleatória de Gato

```
GET /api/cats/random
```

Retorna uma imagem aleatória de gato.

#### Exemplo de Resposta:
```json
{
    "success": true,
    "data": {
        "id": "MTk5MDY1MA",
        "url": "https://cdn2.thecatapi.com/images/MTk5MDY1MA.jpg",
        "width": 640,
        "height": 480
    }
}
```

### 2. Listar Todas as Raças

```
GET /api/cats/breeds
```

Retorna uma lista de todas as raças de gatos disponíveis.

### 3. Buscar Gatos por Raça

```
GET /api/cats/breeds/{breedId}/images
```

Retorna até 10 imagens de gatos de uma raça específica.

### 4. Votar em uma Imagem

```
POST /api/cats/votes
```

Permite votar em uma imagem de gato (curtir ou não curtir).

#### Corpo da Requisição:
```json
{
    "image_id": "MTk5MDY1MA",
    "value": 1  // 1 para curtir, -1 para não curtir
}
```

### 5. Listar Favoritos

```
GET /api/cats/favorites
```

Retorna uma lista das suas imagens favoritas de gatos.

### 6. Adicionar aos Favoritos

```
POST /api/cats/favorites
```

Adiciona uma imagem de gato aos seus favoritos.

#### Corpo da Requisição:
```json
{
    "image_id": "MTk5MDY1MA"
}
```

## Respostas de Erro

Todos os endpoints retornam uma resposta de erro padronizada quando algo dá errado:

```json
{
    "success": false,
    "message": "Mensagem de erro aqui",
    "error": "Informações detalhadas do erro"
}
```

## Como Testar

Você pode testar os endpoints usando Postman ou curl. Aqui estão alguns exemplos de comandos curl:

```bash
# Obter um gato aleatório
curl http://seu-app-url/api/cats/random

# Listar todas as raças
curl http://seu-app-url/api/cats/breeds

# Buscar gatos por raça (exemplo com raça 'abys')
curl http://seu-app-url/api/cats/breeds/abys/images

# Votar em uma imagem
curl -X POST http://seu-app-url/api/cats/votes \
  -H "Content-Type: application/json" \
  -d '{"image_id": "MTk5MDY1MA", "value": 1}'

# Listar favoritos
curl http://seu-app-url/api/cats/favorites

# Adicionar aos favoritos
curl -X POST http://seu-app-url/api/cats/favorites \
  -H "Content-Type: application/json" \
  -d '{"image_id": "MTk5MDY1MA"}'
```

## Tratamento de Erros

A aplicação inclui tratamento adequado para:
- Falhas de autenticação da API
- Erros de rede
- Respostas inválidas
- Erros de validação
- Parâmetros ausentes ou inválidos

## Segurança

A chave da API é armazenada de forma segura no arquivo `.env` e acessada através do sistema de configuração do Laravel. Todos os endpoints validam adequadamente os dados de entrada antes de fazer requisições para The Cat API.
