#language: pt
Funcionalidade: Excluir formações
    Eu, como instrutor 
    Quero poder excluir uma formação
    Para poder Organizar minha lista de formação
    
    @e2e
    Cenário: Criar formação
        Dado estou em "/login"
        Quando preencho "email" com "email@example.com"
        E preencho "senha" com "123456"
        E pressiono "Fazer Login"
        E sigo o link "Formações"
        E sigo o link "Nova Formação"
        E preencho "descricao" com "Teste Automático"
        E pressiono "Salvar"
        Então devo ver "Formação cadastrada com sucesso"
        
    @e2e
    Cenário: Editar formação
        Dado estou em "/login"
        Quando preencho "email" com "email@example.com"
        E preencho "senha" com "123456"
        E pressiono "Fazer Login"
        E sigo o link "Formações"
        E sigo o link "Editar Teste Automático"
        E preencho "descricao" com "Teste Automático Editados"
        E pressiono "Salvar"
        Então devo ver "Formação atualizada com sucesso"

    @e2e
    Cenário: Excluir formação existente
        Dado estou em "/login"
        Quando preencho "email" com "email@example.com"
        E preencho "senha" com "123456"
        E pressiono "Fazer Login"
        E sigo o link "Formações"
        E sigo o link "Excluir Teste Automático Editados"
        Então devo ver "Formação excluída com sucesso"
        E não devo ver um elemento "Teste Automático Editados"
        E não devo ver "Teste Automático"