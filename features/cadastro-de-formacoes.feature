#language: pt
Funcionalidade: Cadastro de formacoes
  Eu, como instrutor
  Quero cadastrar formacoes
  Para organizar meus cursos

  Regras:
  - Formacao precisa ter descricao
  - Descricao precisa ter ao menos 2 palavras

  @unit
  Cenário: Cadastro de formacao com 1 palavra
    Quando eu tentar criar uma formacao com a descricao "PHP"
    Entao eu vou ver a seguinte mensagem de erro "Descricao precisa ter pelo menos 2 palavras"

  @unit
  Cenário: Criacao de formacao valida
    Quando eu tentar criar uma formacao com a descricao "PHP na web"
    Entao eu devo ter uma formacao criada com a descricao "PHP na web"

  @integration
  Cenário: Cadastro de formacao valida deve salvar no banco
    Dado que estou conectado ao banco de dados
    Quando eu tentar criar uma nova formacao com a descricao "PHP na web"
    Entao se eu buscar no banco, devo encontrar essa formacao
