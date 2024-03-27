# Projeto Laravel com Integração Asaas

Este é um projeto Laravel que demonstra a integração com a API do Asaas para gerenciamento de clientes. Ele permite criar, visualizar, atualizar e excluir clientes, além de sincronizar os dados com o Asaas.

## Instalação

## Instalação

### Requisitos

- PHP >= 8.0
- Composer
- Node.js e NPM (opcional)

### Passos para Linux

1. Clone o repositório para sua máquina local:

    ```bash
    git clone git@github.com:Elizeu-Medeiros/Perfectpay-Desafio.git
    ```

2. Acesse o diretório do projeto:

    ```bash
    cd Perfectpay-Desafio
    ```

3. Instale as dependências do PHP com o Composer:

    ```bash
    composer install
    ```

4. Copie o arquivo `.env.example` para `.env`:

    ```bash
    cp .env.example .env
    ```

5. Gere a chave de aplicação do Laravel:

    ```bash
    php artisan key:generate
    ```

6. Abra o arquivo `.env` e configure as variáveis de ambiente do Asaas:

    ```
    ASASS_API_KEY=sua-chave-de-api
    ASASS_BASE_URL=https://sandbox.asaas.com/api/v3
    ```

7. Configure as variáveis de conexão com o banco de dados no arquivo `.env` conforme necessário.

8. Execute as migrações do banco de dados para criar as tabelas necessárias:

    ```bash
    php artisan migrate
    ```

9. Instale as dependências do frontend com o npm:

    ```bash
    npm install
    ```

10. Compile os recursos do frontend com o Laravel Mix:

    ```bash
    npm run dev
    ```

### Passos para Windows

1. Clone o repositório para sua máquina local:

    ```bash
    git clone git@github.com:Elizeu-Medeiros/Perfectpay-Desafio.git
    ```

2. Abra o prompt de comando do Windows ou PowerShell.

3. Acesse o diretório do projeto:

    ```bash
    cd Perfectpay-Desafio
    ```

4. Instale as dependências do PHP com o Composer:

    ```bash
    composer install
    ```

5. Copie o arquivo `.env.example` para `.env`:

    ```bash
    copy .env.example .env
    ```

6. Gere a chave de aplicação do Laravel:

    ```bash
    php artisan key:generate
    ```

7. Abra o arquivo `.env` e configure as variáveis de ambiente do Asaas:

    ```
    ASASS_API_KEY=sua-chave-de-api
    ASASS_BASE_URL=https://sandbox.asaas.com/api/v3
    ```

8. Configure as variáveis de conexão com o banco de dados no arquivo `.env` conforme necessário.

9. Execute as migrações do banco de dados para criar as tabelas necessárias:

    ```bash
    php artisan migrate
    ```

10. Instale as dependências do frontend com o npm:

    ```bash
    npm install
    ```

11. Compile os recursos do frontend com o Laravel Mix:

    ```bash
    npm run dev
    ```

## Uso

### Cadastro de Cliente

1. Acesse a aplicação através do seu navegador.
2. No menu, clique em "Register".
3. Preencha o formulário com as informações necessárias para criar uma conta.
4. Após o registro, faça login usando o email e senha cadastrados.
5. No menu superior à direita, clique para expandir os menus e selecione "Meus Dados".
6. Preencha o formulário com as informações do cliente.
7. Clique em "Cadastrar" para confirmar o cadastro do cliente.

### Atualização de Cliente

1. Para editar as informações de "Meus dados".
2. No menu superior à direita, clique para expandir os menus e selecione "Meus Dados".
2. Clique em "Editar".
3. Faça as alterações desejadas no formulário.
4. Clique em "Atualizar".

### Gerar Pagamento:

1. No menu superior à direita, clique para expandir os menus e selecione "Pagamento".
2. Na Lista de Pagamentos, Clique em "Novo Pagamento".
3. Preencha o formulário com as informações obrigatórias.
4. Clique em "Cadastrar".

### Efetuar Pagamento:
                    
1. Após realizar o cadastro, você será redirecionado para a lista com as os pagamentos.
2. Na Lista de Pagamentos, selecione e Clique no botão na coluna de Pagamento.
3. Faça o pagamento conforme forma de pagamento selecionado
                    

## Contribuição

Contribuições são bem-vindas! Se você quiser melhorar este projeto, siga estas etapas:

1. Faça um fork do projeto.
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`).
3. Faça commit das suas alterações (`git commit -am 'Adicione uma nova feature'`).
4. Faça push para a branch (`git push origin feature/MinhaFeature`).
5. Abra um Pull Request.


### Observação para avaliadores: 

O arquivo .env.example já inclui as configurações essenciais para o banco de dados, chave de aplicativo e integração com o Asaas. Antes de iniciar a aplicação, lembre-se de configurar o seu arquivo .env com as informações pertinentes.


## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE).
