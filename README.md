# Git comandos

## Clonar o diretório

```bash
git clone git@github.com:Leandroj888/AluraCursos.git
```

## Atualizar arquivos

```bash
git pull
```

## Adicionar modificações

```bash
git add .
```

## Comitar modificações

```bash
git commit -m "Envy-2023-01-13-01"
git commit -m "Pavilion-2023-01-13-01"
```

## Enviar modificações

```bash
git push
```

# SSH

## Criar chave
ssh-keygen -t ed25519 -C "email@servido.com.br"

## Pegar key
cat ~/.ssh/id_ed25519.pub

## Adicionar ssh
https://github.com/settings/keys -> new ssh key

## Testar conexão
ssh -T git@github.com


# Usuario Git
git config --global user.name "Your Name"

git config --global user.email "youremail@yourdomain.com"

# Extensões (https://www.youtube.com/watch?v=DFPvnxIgwKA)
- code runner - Executa parte de um código selecionado
- dotEnv - ajuda em sintax de arquivos .env
- Code Spell Checker / Brasilian Portugues Code Spell Checker - corretor ortográfico inglês - ptbr
- Portuguese (Brazil) Language Pack for Visual Studio - VS code ptbr
- PHP Snippets from PHPStorm - vários atalhos de escrita do phpstorm (fore)
- GitLens — Git supercharged - Mostra quem alterou a linha e a branch, acresenta funcionabilidades na área git
- Composer - permite visualizar os pacotes disponíveis no composer
- EditorConfig for VS Code - semelhante ao que tem no editor mas pode ser levado mais a fino para cada projeto / tipo de arquivo / arquivo especifico
- Path Intellisense - auto completa nomes
- Twig - sintax para trabalhar com twig (problemas com o autocompletar do html)
- PHP Intelephense - Coisas de php autocomplete e tals
- PHP Debug - Debugar xdebug
- PHP DocBlocker - escrever documentações de @parm @return
- PHP Sniffer - vasculhar erros que ferem as psr
- PHP Getters & Setters - permite adicionar get e set rapidamente
- PHPUnit - fazer testes unitários
- PHPUnit Test Explorer - Permite visualizar todos os testes


# Informações do sistema
screenfetch



## Debug trace
```php
print_r(debug_backtrace());
```
```bash
Array
(
    [0] => Array
        (
            [file] => /home/leandro/AluraCursos/8-PHP Exceptions: tratamento de erros/pilha.php
            [line] => 8
            [function] => funcao2
            [args] => Array
                (
                )

        )

    [1] => Array
        (
            [file] => /home/leandro/AluraCursos/8-PHP Exceptions: tratamento de erros/pilha.php
            [line] => 24
            [function] => funcao1
            [args] => Array
                (
                )

        )

)