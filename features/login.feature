#language: pt
Funcionalidade: Login
  Descricao da funcionalidade de login aqui

  @e2e
  Cenário: Realizar login
    Dado estou em "/login"
    Quando preencho "email" com "email@example.com"
    E preencho "senha" com "123456"
    E pressiono "Fazer Login"
    Entao devo estar em "/listar-cursos"

  @e2e
  Cenário: Tentativa de login com email errado
    Dado estou em "/login"
    Quando preencho "email" com "email2@example.com"
    E preencho "senha" com "123456"
    E pressiono "Fazer Login"
    Entao devo estar em "/login"
    E devo ver "Usuário ou senha inválidos"

  @e2e
  Cenário: Tentativa de login com email errado
    Dado estou em "/login"
    Quando preencho "email" com "email@example.com"
    E preencho "senha" com "1234567"
    E pressiono "Fazer Login"
    Entao devo estar em "/login"
    E devo ver "Usuário ou senha inválidos"
