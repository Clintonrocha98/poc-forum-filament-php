# Fórum com Filament

## Requisitos

* PHP 8.1+
* Composer
* Node.js e NPM
* Banco de dados (SQLite, MySQL ou PostgreSQL)
* Laravel 10+
* Extensões Laravel Livewire, Filament, Alpine.js

## Instalação

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

composer install
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env

php artisan migrate --seed

npm install && npm run dev
php artisan serve
```

Acesse `http://localhost:8000/admin` para acessar o painel Filament.

## Estrutura

* **Models**:

  * `Community`: representa um grupo de discussão.
  * `Post`: representa uma postagem dentro de uma comunidade.
  * `Reply`: respostas a postagens, com suporte a respostas aninhadas.

* **Relacionamentos**:

  * Uma `Community` possui muitos `Post`.
  * Um `Post` pertence a uma `Community` e possui muitas `Reply`.
  * `Reply` possui relacionamentos recursivos para suportar respostas aninhadas.

## Funcionalidades

* Criação de postagens em comunidades específicas
* Respostas e sub-respostas organizadas em árvore
* Página personalizada para exibição de postagens
* Formulários dinâmicos com Livewire e Alpine.js
* Estilização responsiva com Tailwind CSS

