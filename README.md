# 📚 Sistema de Gerenciamento de Biblioteca

## 📋 Sobre o Projeto

Sistema web completo para gerenciamento de bibliotecas desenvolvido em **Laravel 11**, oferecendo funcionalidades robustas para administração de livros, funcionários, departamentos e usuários. O sistema implementa controle de estoque, sistema de auditoria completo, gestão de empréstimos e comunicação através de sistema de contato integrado.

###  Links 
Git hub: https://github.com/FeJoestar18/Projeto-Sistema-Gerenciamento-Biblioteca.git
Youtube: https://youtu.be/5Dzn--yJLTc?si=DTBA0SykKkqoEDIg

### ✨ Principais Funcionalidades

#### 👥 Gestão de Usuários
- **3 Níveis de Acesso**: Admin, Funcionário e Usuário
- Sistema de autenticação completo (login, registro, recuperação de senha)
- Perfis personalizados com informações detalhadas
- Bloqueio e desbloqueio de contas
- Criptografia de dados sensíveis (CPF, RG)

#### 📖 Gestão de Livros
- Cadastro completo com ISBN, autor, editora, ano de publicação
- Controle de estoque com entrada e saída
- Sistema de categorias e tags
- Histórico completo de movimentações
- Busca avançada e filtros

#### 🏢 Gestão de Departamentos e Funcionários
- Relação many-to-many entre funcionários e departamentos
- Departamento principal e departamentos secundários
- Histórico de lotação com datas de início e fim
- Criação automática de usuário ao cadastrar funcionário

#### 💬 Sistema de Comunicação
- **Fale Conosco**: Usuários podem enviar mensagens
- **Sistema de Tickets**: Com status (pendente, em andamento, resolvido, fechado)
- **Atendimento por Departamento**: Apenas funcionários do departamento de atendimento podem responder
- Histórico completo de conversas

#### 📊 Sistema de Auditoria
- Registro automático de todas as ações
- Rastreamento de criação, edição e exclusão
- Armazenamento de valores antigos e novos
- Registro de IP e usuário responsável
- Timestamps completos

#### ❓ Central de Ajuda
- FAQ com 20 perguntas frequentes
- Sistema de busca inteligente
- Categorização por tópicos
- Cards expansíveis com respostas detalhadas

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **Laravel 11** - Framework PHP
- **PHP 8.2+** - Linguagem de programação
- **MySQL** - Banco de dados relacional
- **Eloquent ORM** - Object-Relational Mapping

### Frontend
- **Blade** - Template engine do Laravel
- **CSS3** - Estilização com variáveis CSS customizadas
- **JavaScript (Vanilla)** - Interatividade
- **Font Awesome** - Biblioteca de ícones

### Segurança
- **Laravel Sanctum** - Autenticação
- **Criptografia AES-256** - Para dados sensíveis
- **CSRF Protection** - Proteção contra ataques CSRF
- **Validation** - Validação de dados no backend

---

## 🚀 Como Rodar o Projeto

### Pré-requisitos

Certifique-se de ter instalado:
- **PHP 8.2 ou superior**
- **Composer** - Gerenciador de dependências PHP
- **MySQL 5.7+** ou **MariaDB 10.3+**
- **Node.js & NPM** (opcional, para assets)
- **Git**

### 📦 Instalação

#### 1. Clone o Repositório

```bash
git clone https://github.com/FeJoestar18/Projeto-Sistema-Gerenciamento-Biblioteca.git
cd Projeto-Sistema-Gerenciamento-Biblioteca/Gerenciamento-Lib
```

#### 2. Instale as Dependências

```bash
composer install
```

Se for usar assets compilados:
```bash
npm install
```

#### 3. Configure o Ambiente

Copie o arquivo de ambiente de exemplo:
```bash
cp .env.example .env
```

Edite o arquivo `.env` com suas configurações:

```env
APP_NAME="Sistema de Biblioteca"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@biblioteca.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### 4. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

#### 5. Crie o Banco de Dados

Acesse o MySQL e crie o banco de dados:

```sql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 6. Execute as Migrações e Seeders

```bash
php artisan migrate --seed
```

Este comando irá:
- Criar todas as tabelas necessárias
- Popular com dados iniciais (departamentos e usuários de teste)

#### 7. Crie o Link Simbólico para Storage

```bash
php artisan storage:link
```

#### 8. Inicie o Servidor de Desenvolvimento

```bash
php artisan serve
```

O sistema estará disponível em: **http://localhost:8000**

---

## 👤 Usuários Padrão

Após executar os seeders, você terá acesso aos seguintes usuários:

### Administrador
- **Email**: admin@sistema.com
- **Senha**: admin123
- **Permissões**: Acesso total ao sistema

### Funcionário (será criado ao cadastrar funcionário)
- **Email**: funcionario@sistema.com
- **Senha**: func123
- **Permissões**: Gerenciar livros, estoque e atender contatos

### Usuário
- **Email**: usuario@sistema.com
- **Senha**: user123
- **Permissões**: Visualizar livros, solicitar empréstimos, enviar mensagens

---

## 📂 Estrutura do Projeto

```
Gerenciamento-Lib/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores da aplicação
│   │   ├── Middleware/      # Middlewares personalizados
│   │   └── Requests/        # Form Requests para validação
│   ├── Models/              # Modelos Eloquent
│   ├── Observers/           # Observers para auditoria
│   ├── Policies/            # Políticas de autorização
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Migrações do banco de dados
│   └── seeders/             # Seeders para popular dados
├── public/
│   ├── css/                 # Arquivos CSS
│   └── index.php            # Ponto de entrada
├── resources/
│   └── views/               # Views Blade
├── routes/
│   └── web.php              # Rotas web
└── storage/                 # Armazenamento de arquivos
```

---

## 🔐 Segurança

### Dados Criptografados
- **CPF** e **RG** são criptografados usando `Crypt::encryptString()`
- Senhas são hasheadas com **bcrypt**

### Controle de Acesso
- **Middleware de Autenticação**: Protege rotas privadas
- **Policies**: Controlam ações específicas por recurso
- **Role-Based Access**: Diferentes permissões por tipo de usuário

### Auditoria
Todas as ações importantes são registradas:
- Quem fez a ação
- Quando foi feita
- O que foi alterado (valores antigos e novos)
- De qual IP partiu a requisição

---

## 📊 Banco de Dados

### Principais Tabelas

| Tabela | Descrição |
|--------|-----------|
| `users` | Usuários do sistema |
| `employees` | Funcionários da biblioteca |
| `departments` | Departamentos organizacionais |
| `employee_department` | Relação many-to-many (tabela pivô) |
| `books` | Catálogo de livros |
| `stock_logs` | Histórico de movimentação de estoque |
| `contact_messages` | Mensagens do sistema Fale Conosco |
| `audit_logs` | Registro de auditoria |

### Relacionamentos

```
users 1---* employees
employees *---* departments (via employee_department)
books 1---* stock_logs
users 1---* contact_messages
users 1---* audit_logs
```

---

## 🎨 Design System

O projeto utiliza um design system moderno com variáveis CSS:

### Cores Principais
```css
--primary-red: #DC2626     /* Vermelho principal */
--dark-gray: #1F2937       /* Fundo escuro */
--medium-gray: #374151     /* Cinza médio */
--light-gray: #4B5563      /* Cinza claro */
--text-light: #9CA3AF      /* Texto secundário */
--white: #FFFFFF           /* Branco */
```

### Componentes Reutilizáveis
- Cards com bordas e sombras
- Botões com variantes (primary, outline, danger)
- Formulários padronizados
- Tabelas responsivas
- Modais e alertas

---

## 🧪 Testando o Sistema

### 1. Faça Login como Admin
```
Email: admin@sistema.com
Senha: admin123
```

### 2. Crie Departamentos
Acesse: **Departamentos > Adicionar Departamento**

### 3. Cadastre Funcionários
Acesse: **Funcionários > Adicionar Funcionário**
- Um usuário será criado automaticamente com role 'funcionario'
- Associe o funcionário a um ou mais departamentos

### 4. Adicione Livros
Acesse: **Livros > Adicionar Livro**

### 5. Gerencie Estoque
Acesse: **Livros > [Livro] > Gerenciar Estoque**

### 6. Teste o Sistema de Contato
Como usuário comum:
- Acesse **Fale Conosco**
- Envie uma mensagem
- Como funcionário do atendimento, responda a mensagem

---

## 🔧 Comandos Úteis

### Limpar Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Recriar Banco de Dados
```bash
php artisan migrate:fresh --seed
```

### Ver Rotas
```bash
php artisan route:list
```

### Criar Nova Migração
```bash
php artisan make:migration nome_da_migracao
```

### Criar Novo Controller
```bash
php artisan make:controller NomeController
```

### Criar Novo Model com Migração
```bash
php artisan make:model NomeModel -m
```

---

## 📝 Funcionalidades por Tipo de Usuário

### 👨‍💼 Administrador
✅ Acesso total ao sistema  
✅ Gerenciar usuários (criar, editar, bloquear)  
✅ Gerenciar funcionários e departamentos  
✅ Gerenciar livros e estoque  
✅ Visualizar auditoria completa  
✅ Responder mensagens de contato  
✅ Configurações do sistema  

### 👷 Funcionário
✅ Gerenciar livros e estoque  
✅ Visualizar empréstimos  
✅ Responder mensagens (se for do depto. atendimento)  
✅ Acessar relatórios básicos  
❌ Gerenciar usuários  
❌ Acessar configurações do sistema  

### 👤 Usuário
✅ Visualizar catálogo de livros  
✅ Solicitar empréstimos  
✅ Visualizar histórico pessoal  
✅ Enviar mensagens via Fale Conosco  
✅ Acessar FAQ (Quero Ajuda)  
✅ Editar próprio perfil  
❌ Acessar área administrativa  

---

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto é um sistema acadêmico/educacional desenvolvido para fins de aprendizado e demonstração de conceitos de desenvolvimento web com Laravel.

---

## 👨‍💻 Desenvolvedor

**FeJoestar18**
- GitHub: [@FeJoestar18](https://github.com/FeJoestar18)

---

## 📞 Suporte

Se você encontrar algum problema ou tiver dúvidas:

1. Verifique a seção de **FAQ** no sistema
2. Consulte a documentação do [Laravel](https://laravel.com/docs)
3. Abra uma [Issue](https://github.com/FeJoestar18/Projeto-Sistema-Gerenciamento-Biblioteca/issues) no GitHub

---

## 🔄 Atualizações Futuras

- [ ] Sistema de empréstimos com datas e devoluções
- [ ] Notificações por email
- [ ] Relatórios em PDF
- [ ] Dashboard com gráficos estatísticos
- [ ] Sistema de multas por atraso
- [ ] Reserva de livros
- [ ] API RESTful
- [ ] App mobile

---

## 📚 Recursos Adicionais

### Documentação
- [Laravel 11](https://laravel.com/docs/11.x)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [Blade Templates](https://laravel.com/docs/11.x/blade)

### Tutoriais
- [Laracasts](https://laracasts.com)
- [Laravel Daily](https://laraveldaily.com)

---

<div align="center">

**⭐ Se este projeto foi útil, considere dar uma estrela! ⭐**

Feito com ❤️ usando Laravel

</div>
