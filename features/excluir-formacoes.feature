#language: pt
Funcionalidade: Excluir formacoes
  Eu, como instrutor
  Quero poder excluir uma formacao
  Para poder organizar minha lista de formacoes

  @e2e
  Cenário: Excluir formacao existente
    Dado estou em "/login"
    E preencho "email" com "email@example.com"
    E preencho "senha" com "123456"
    E pressiono "Fazer Login"
    E sigo o link "Formacoes"
    Quando sigo o link "Excluir"
    Entao devo ver "Formacao excluída com sucesso"
    E devo estar em "/listar-formacoes"