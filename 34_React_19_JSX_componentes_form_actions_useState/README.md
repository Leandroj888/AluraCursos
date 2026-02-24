# 1 React, JSX e componentes

Figma: https://www.figma.com/design/GPdsCpuot5OHfX56Mylqzl/Node--React-e-Vite-%7C-Tecboard--Community-?node-id=0-1&p=f&t=CNIWsi4RSGbCWTgu-0



Para começar o react precisamos do node

versão do node
``` bash
node -v
```

instalar o node 

https://www.alura.com.br/artigos/como-instalar-node-js-windows-linux-macos
``` bash
# Download and install Chocolatey:
powershell -c "irm https://community.chocolatey.org/install.ps1|iex"
# Download and install Node.js:
choco install nodejs --version="24.13.1"
# Verify the Node.js version:
node -v # Should print "v24.13.1".
# Verify npm version:
npm -v # Should print "11.8.0".
```

criar o projeto, usando o vite vc consegue dar o inicio
``` bash
npm create vite@latest 
npm install
npm run dev
```

Daria para usar o live service (extensão do vscode) tmb



className -> class mas para 


Front-end imperativo -> interagindo direto com o dom, colocar class tirar class
Front-end declarativo -> interaje de forma indireta 


## Regras do JSX
- Sempre retornar um elemento apenas, ou uma div
- Fechar todas as tags, mesmo tags orfás devem ser fechadas
- Usar camelCase na maioria das coisas de react para não infrigir palavras reservadas

# 2 Compondo com Componentes

...promps - desconstroi tudo

# 3 Trabalhando como lista

jsx -> createElement -> {} (Cria um objeto) -> Virtual DOM (objeto em memória) -> Muda o DOM 


O React usa o cálcula e armazena no Virtual DOM e depois é feito a validação com o DOM real e por fim altera só o necessário

Sempre use key em listas para otimizar a atualização


# 4 Submentendo o Formulário