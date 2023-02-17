# Leandro Readme

## Links

## Comandos
```bash
composer install
#php bin/doctrine orm:schema-tool:create
#php bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '\$argon2i\$v=19\$m=65536,t=4,p=1\$WHpBb1FzTDVpTmQubU55bA\$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
php -S 0.0.0.0:8080 -t public
```

## Login
- Usuário  `email@example.com` 
- Senha `123456`.


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