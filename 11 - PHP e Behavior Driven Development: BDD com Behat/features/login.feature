#language: pt
Funcionalidade: login
    Descrição da funcionalidade
    
    @e2e
    Cenário: Realizar login
        Dado estou em "/login"
        Quando preencho "email" com "email@example.com"
        E preencho "senha" com "123456"
        E pressiono "Fazer Login"
        Então devo estar em "/listar-cursos"