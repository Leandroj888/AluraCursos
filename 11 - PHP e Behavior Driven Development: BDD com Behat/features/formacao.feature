#language: pt
Funcionalidade: Cadastro de formações
    Eu  como instrutor|
    Quero cadastra formações
    Para Organizar meus cursos
    
    # |    User Story             | descrição                             |
    # |Eu  como instrutor         | Quem vai utilizar                     |
    # |Quero cadastra formações   | O que vai fazer                       |
    # |Para Organizar meus cursos | Para que fazer essa funcionalidade    |
    
    Regra: 
        - Formação precisa ter uma descrição
        - Descrição precisa ter pelo menos 2 palavras

    @unit
    Cenário: Cadastro de formação com 1 palavra
        When eu criar uma formação com a descrição "PHP"
        Então eu vou ver a seguinte mensagem de erro "Descrição precisa ter pelo menos 2 palavras"
        
    @unit
    Cenário: Cadastro de formação válida
        Quando eu criar uma formação com a descrição "PHP na web"
        Então eu vou ter uma formação criada com a descrição "PHP na web"
    
    @integration
    Cenário: "Cadastro de formação válida deve salvar no banco"
        Dado que estou conectado ao banco de dados
        Quando tento salvar uma nova formação com a descrição "PHP na web"
        # E sua descrição é "PHP para Web"
        Então se eu buscar no banco, devo encontrar essa formação
        # E sua descrição deve estar correta
        