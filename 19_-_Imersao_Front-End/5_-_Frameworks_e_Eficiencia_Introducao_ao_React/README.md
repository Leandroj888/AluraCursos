# Links

# Anotações

NÃO USE CARACTERES ESPECIAIS NO NOME DAS PASTAS NO REACT

## Criar o projeto React

```bash
npx create-react-app nameProject
```

npx é o executor do npm e permite ao invés de instalar todo npm já criar o projeto direto

- next.js permite criar direto as estruturas

## subir aplicação

- npm start no projeto
- json-server --watch api-artists/artists.json --port 3001

## jsx

extensão chique para a gambiarra de misturar javascript + html

## class js

agora no react terá o nome de className

## usando imagens

você precisa importar a imagem através do import e para utilizar vai fazer interpolação

```jsx
import nameImage from "../assets/img.img";


<img src={smallRight} alt="image">
```

## expondo o componente

após criado o componente você precisa expor ele para ser usado

```jsx
export default Header;
```

## Usando o componente 

para usar o componente é necessário importar ele e utilizar como uma tag html

```jsx
import Header from './Header/Header';

function App() {
    return (
        <Header/>
    );
};

export default App;
```