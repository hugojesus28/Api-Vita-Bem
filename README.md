# 🌐 API - Vita-Bem

Esta é a API oficial do projeto **Vita-Bem**, um aplicativo de saúde voltado ao bem-estar físico e mental. A API foi desenvolvida para fornecer os dados e funcionalidades essenciais que alimentam os recursos do app, como registro de medidas, controle de medicamentos, entre outros.

---

## 🧠 Objetivo

Fornecer uma interface segura e eficiente para que o aplicativo **Vita-Bem** consiga realizar operações como armazenar, consultar, atualizar e deletar dados de saúde dos usuários.

---

## 🛠️ Tecnologias Utilizadas

- **Linguagem:** PHP (Laravel) 
- **Banco de Dados:** MySQL
- **ORM:** Eloquent (caso Laravel)

---

## 📦 Instalação e Execução Local

```bash
# Clone o repositório
git clone https://github.com/seuusuario/vita-bem-api.git

# Acesse a pasta
cd vita-bem-api

# Instale as dependências
composer install # ou npm install

# Configure o arquivo .env
cp .env.example .env

# Gere a chave da aplicação (caso Laravel)
php artisan key:generate

# Configure o banco de dados no .env

# Rode as migrações
php artisan migrate

# Inicie o servidor
php artisan serve
