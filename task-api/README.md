# Task API

Uma API RESTful para gerenciamento de tarefas construída com Laravel 12.

## 🚀 Tecnologias

Este projeto utiliza as seguintes tecnologias:

- PHP 8.2+
- Laravel 12.0
- Laravel Tinker 2.10.1
- SQLite/MySQL/PostgreSQL (banco de dados configurável)
- Swagger/OpenAPI para documentação

## 📋 Pré-requisitos

Para rodar este projeto, você precisa ter instalado:

- PHP 8.2 ou superior
- Composer
- Banco de dados de sua preferência (SQLite, MySQL ou PostgreSQL)

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone [url-do-repositorio]
cd task-api
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure seu banco de dados no arquivo `.env`

5. Execute as migrações:
```bash
php artisan migrate --seed
```

## 🚀 Executando o projeto

Para desenvolvimento, você pode usar o comando:

```bash
php artisan serve
```

## 📖 Documentação da API (Swagger)

A API é totalmente documentada usando o padrão OpenAPI/Swagger. A documentação está disponível em dois formatos:

### Interface Swagger UI
Acesse a documentação interativa em:
```
http://localhost:8000/documentation
```

### Arquivo JSON
O arquivo JSON da documentação está disponível em:
```
http://localhost:8000/docs
```

### Recursos Documentados

A documentação inclui:

- Autenticação
  - Login (POST /api/login)
  - Logout (POST /api/logout)

- Gerenciamento de Tarefas
  - Listar tarefas (GET /api/tasks)
  - Criar tarefa (POST /api/tasks)
  - Atualizar tarefa (PUT /api/tasks/{task_id})
  - Excluir tarefa (DELETE /api/tasks/{task_id})

Para cada endpoint, você encontrará:
- Descrição detalhada
- Parâmetros necessários
- Exemplos de requisição e resposta
- Códigos de status HTTP
- Esquemas de dados
- Requisitos de autenticação

### Atualizando a Documentação

A documentação é mantida em um arquivo JSON em:
```
storage/api-docs/api-docs.json
```

## 🧪 Testes

O projeto inclui testes automatizados para garantir o funcionamento correto das policies e validações.

### Executando os Testes

Para executar todos os testes:
```bash
php artisan test
```

Para executar testes específicos:
```bash
# Testes de Policies
php artisan test tests/Unit/Policies/TaskPolicyTest.php

# Testes de Validação do Controller
php artisan test tests/Unit/Controllers/TaskControllerValidationTest.php
```

### Cobertura de Testes

#### Testes de Policy (TaskPolicyTest)
- ✓ Verifica se qualquer usuário autenticado pode ver tasks
- ✓ Verifica se o proprietário pode ver sua task
- ✓ Verifica se um não proprietário não pode ver a task
- ✓ Verifica se usuários autenticados podem criar tasks
- ✓ Verifica se o proprietário pode atualizar sua task
- ✓ Verifica se um não proprietário não pode atualizar a task
- ✓ Verifica se o proprietário pode deletar sua task
- ✓ Verifica se um não proprietário não pode deletar a task

#### Testes de Validação (TaskControllerValidationTest)
- ✓ Valida título obrigatório na criação
- ✓ Valida que título deve ser string
- ✓ Valida tamanho máximo do título
- ✓ Permite descrição opcional
- ✓ Valida título quando presente na atualização
- ✓ Valida descrição quando presente na atualização
- ✓ Valida status quando presente na atualização
- ✓ Aceita todos os status válidos (pending, in_progress, completed)

### Banco de Dados de Teste

Os testes utilizam SQLite em memória para maior velocidade. A configuração está no arquivo `phpunit.xml`.

### Factories

O projeto utiliza factories para criar dados de teste:

- UserFactory: Cria usuários para teste
- TaskFactory: Cria tasks com dados aleatórios

## 📦 Estrutura do Projeto

- `/app` - Código principal da aplicação
  - `/Http/Controllers` - Controladores da API
  - `/Models` - Modelos do Eloquent
  - `/Policies` - Políticas de autorização
- `/tests` - Testes automatizados
  - `/Unit/Policies` - Testes de políticas
  - `/Unit/Controllers` - Testes de validação
- `/database`
  - `/factories` - Factories para testes
  - `/migrations` - Estrutura do banco de dados
- `/storage/api-docs` - Documentação OpenAPI/Swagger

## 📄 Licença

Este projeto está sob a licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para mais detalhes.
