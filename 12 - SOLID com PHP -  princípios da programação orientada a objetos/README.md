# Links

# Comandos
```bash
composer install
```

# pdepend
Ferramenta php que calcula nível de dependência de classes

# SOLID
| SIGLA | Significado | DESCRIÇÃO | EXEMPLO|
| ---- | ---- | ---- | ---- | 
| S | Single Responsibility Principle | Cada classe ser responsável por suas ações (Entidade Aluno não deve ter função de crud) | Só porque dá para colocar toda implementação em um código vc não deve fazer|
| O | Open/Closed Principle | Não expor tudo de uma classe, apenas o necessário | Para por um casaco você não precisa fazer uma cirurgia de peito aberto|
| L | Liskov Substitution Principle | Métodos substituídos de classes extendidas devem respeitar não só as assinaturas mas o tipo de retorno | Se o retorno for uma string e nela tiver uma url, todas as classes que herdam e modificam esse método devem retornar uma string contendo uma url |
| I | Interface Segregation Principle | Não forçar as classes a depender de métodos que não utilizará | Uma class pode ter mais de uma implementação de interface function AcaiComGranola implements Drink, Eat|
| D | Dependency Inversion Principe | Depender de interface e abstrações e não de objetos | Não soldar o fio da lâmpada na tomada, use uma flecha |