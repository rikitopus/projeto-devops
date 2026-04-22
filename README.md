# Projeto de Estudo para a matéria de DEVOPS

## Funcionalidade

Mural de recados que registra o nome, mensagem e data.
Além do formulário, a página mostra uma lista com os últimos recados registrados.

## Setup

### 1. Inicie os containers

```bash
docker-compose up -d
```

### 2. Inicialize o banco de dados

Acesse o container PHP e execute o script de inicialização:

```bash
docker-compose exec php php src/init-db.php
```

Isso irá criar a tabela `recados` com os seguintes campos:

- `id` (AUTO_INCREMENT PRIMARY KEY)
- `nome` (VARCHAR 255, obrigatório)
- `mensagem` (TEXT, obrigatório)
- `data` (DATE, obrigatório)

### 3. Acesse a aplicação

Abra seu navegador e navegue para:

```
http://localhost:8000/src/index.php
```

## Validações

- **Todos os campos são obrigatórios** (nome, data, mensagem)
- **A data não pode ser no futuro** - O formulário impede a seleção de datas futuras usando o atributo `max` e valida no servidor

## Lint

Para corrigir automaticamente os problemas de estilo de código de acordo com o padrão PSR12:

```bash
docker-compose exec php php vendor/bin/phpcbf src/ --standard=PSR12
```

## Testes

Para executar os testes com PHPUnit:

```bash
docker-compose exec php ./vendor/bin/phpunit
```

Os testes devem ser criados no diretório `tests/` seguindo a convenção `*Test.php`.

