# Desafio proposto para um processo seletivo de bycoders

O objetivo consiste em parsear [este arquivo de texto(CNAB)](https://github.com/ByCodersTec/desafio-ruby-on-rails/blob/master/CNAB.txt) e salvar suas informações(transações financeiras) em uma base de dados a critério do candidato.


# Setup
O projeto foi escrito em php sem framework versão 7.4.29 e MySQL versão 8.0.30, foi utilizado Docker para ser facilmente configurado o ambiente.

Para a aplicação funcionar corretamente é necessário fazer a importação do banco de dados no phpMyAdmin
1. Com o docker desktop rodando execude o comando "docker-compose up -d --build"
2. Após terminar de executar entre em localhost:8001 acesse o phpmyadmin com as seguintes credenciais: Sevidor:mysql_db Usuário:root, Senha:root
3. Crie um schema chamado "desafio-dev", abra ele e clique no botão importação, utilize o arquivo desafio-dev-importacao.sql
4. Agora a aplicação deve funcionar, acesse localhost para acessar o desafio-dev

# Descrição do projeto

Foram criada algumas pastas para a organização do projeto para se caso este projeto fosse escalado para uma aplicação maior, como pages (para guardar as páginas que contem php+html), lib( para guardar arquivos de configuração, apis e outro arquivos php úteis).

### Principais páginas criadas
1. index.php : Essa página possui apenas html/ css e javascript tem a finalidade de introduzir o desafio e apresentar-me, nele é possível encontrar um menu para outras páginas com algumas animações com javacript para deixar mais agradável navegar pelo site.
2. importacao.php : Essa página consiste num formulário para ser inserido o documento txt. Essa página envia o documento para ela mesma, que pega os dados escritos no arquivo e converte para uma string e envia para uma api, onde devolve o retorno da ação e exibe na tela.
3. imp_cnab.php : Ela é a api criada para ser possivel salvar os dados sem a necessidade da interface web. Ela recebe os dados, transforma em string, valida e insere no banco de dados, devolvendo um json com o resultado do precesso.
4. resgistro_transicoes.php : Responsável por pegar os dados do banco de dados e exibir na tela numa tabela, além de fazer a conta de entrada e saída de dinheiro, foi criado um filtro por loja para facilitar a leitura dos dados para o usuário.
5. function.php : A página possui algumas funções que eu achei interessante salvar num lugar separado para ficar mais fácil a leitura do código.
6. testes_api_cnab.php e testes_functions.php : Como não foi utilizado nenhum framework criei os testes para serem executados no navegador, eles cobrem uma série de requisitos que tanto as funções como a api deve passar para funcionar corretamente.

## Abaixo estão as documentações consideradas para realização do projeto

# Documentação do CNAB

| Descrição do campo  | Inicio | Fim | Tamanho | Comentário
| ------------- | ------------- | -----| ---- | ------
| Tipo  | 1  | 1 | 1 | Tipo da transação
| Data  | 2  | 9 | 8 | Data da ocorrência
| Valor | 10 | 19 | 10 | Valor da movimentação. *Obs.* O valor encontrado no arquivo precisa ser divido por cem(valor / 100.00) para normalizá-lo.
| CPF | 20 | 30 | 11 | CPF do beneficiário
| Cartão | 31 | 42 | 12 | Cartão utilizado na transação
| Hora  | 43 | 48 | 6 | Hora da ocorrência atendendo ao fuso de UTC-3
| Dono da loja | 49 | 62 | 14 | Nome do representante da loja
| Nome loja | 63 | 81 | 19 | Nome da loja

# Documentação sobre os tipos das transações

| Tipo | Descrição | Natureza | Sinal |
| ---- | -------- | --------- | ----- |
| 1 | Débito | Entrada | + |
| 2 | Boleto | Saída | - |
| 3 | Financiamento | Saída | - |
| 4 | Crédito | Entrada | + |
| 5 | Recebimento Empréstimo | Entrada | + |
| 6 | Vendas | Entrada | + |
| 7 | Recebimento TED | Entrada | + |
| 8 | Recebimento DOC | Entrada | + |
| 9 | Aluguel | Saída | - |


