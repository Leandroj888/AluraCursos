# Link

https://xdebug.org/wizard`auxilio top para instalar o xdebug`
https://dias.dev/2022-02-13-extensoes-php/`ok`
https://xdebug.org/docs/all_settings`ok`https://github.com/jokkedk/webgrind`OK`

# Extenção

xdebug é uma extenção em C para o php para instalar ele [acesse](https://xdebug.org/)

```bash
sudo apt-get install php-xdebug
php -v
# verifique se tem o with Xdebug v3.1.2, Copyright (c) 2002-2021, by Derick Rethans
```

Para VScode instalar o PHP Debug e editar o mesmo

# resetar PHP Ubuntu

```bash
sudo /etc/init.d/apache2 restart
```

# PHP ini

```bash
php --ini
# /etc/php/8.1/cli/php.ini
```

# xdebug modos

No php-ini inserir, para ter mais de um modo separe por virgula cada um

```bash
# desabilitar xdebug
xdebug.mode=off

# padrão faz alteração no var_dump e colore as saídas
xdebug.mode=develop

# bom para capturar o tempo dos processamentos e outras informações
xdebug.mode=profile

# mais usado e mais poderoso
xdebug.mode=debug

# rastreamento mais verboso de todos, pouco usado pelas pessoas
xdebug.mode=trace

# cobertura de código
xdebug.mode=coverage
```

# outros

No php-ini inserir

## xdebug colorido no terminal

`xdebug.cli_color=1`

## develop

padrão faz alteração no var_dump e colore as saídas

### apenas 3 caracteres na string

No php-ini inserir
`xdebug.var_display_max_data=3`

### mostrar stacktrace indiferente dela ser tratada ou não

`xdebug.show_exception_trace=1`

### mostrar mais informações (não vi diferença)

`xdebug.dump.SERVER = REMOTE_ADDR, REQUEST_METHOD`
`xdebug.dump.GET = *`

### exibir váriaveis loacais

`xdebug.show_local_vars=1`

## profile

bom para capturar o tempo dos processamentos e outras informações

blackfire é uma ferramenta paga infinitamente superior mas como dito paga

para ler os arquivos gerados da para usar a extensão **PHP Profiler** da **DEVSENSE**
`>PHP Profiler`

ou instalar o program kcachegrind

ou clonar e subir esse projeto https://github.com/jokkedk/webgrind

### local dos arquivos

`xdebug.output_dir="/sda5/code/AluraCursos/15 - XDebug: ferramenta de debug e profiling/profile"`

### trigger - ponto onde starta o log

`xdebug.start_with_request=trigger`

ai quando quiser gerar use na frente do comando
`XDEBUG_TRIGGER=1 php flat-array.php`

## debug

UFW - gerenciador firewall ubuntu
`xdebug.mode=debug`
`xdebug.client_port=9000`
`xdebug.start_with_request=yes`

quando quiser com trigger use na frente do comando
`xdebug.start_with_request=trigger`
`XDEBUG_TRIGGER=1 php flat-array.php`
`http://localhost:8080/1-teste.php?XDEBUG_TRIGGER=1` ou usar extenção `xdebug helper` no navegador

### docker

`xdebug.mode=debug`
`xdebug.client_port=9000`
`xdebug.client_host=host.docker.internal`
`xdebug.start_with_request=trigger`

### Controles xdebug
- Continuar - proximo break point (ponto de parada)
- Contornar (Step over) - avança próxima linha da função sem entrar em outras funções
- Intervir (Step into) - também avança para próxima linha mas se existir um função entra nela
- Sair - sai da função atual e volta a execução para a função que chamou


Dá para condicionar um breakpoint com o botão direito e clicar em editar ponto de parada


# Rodar web

```bash
php -S 0.0.0.0:8080
```
