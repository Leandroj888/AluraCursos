import './titulo-formulario.estilo.css'
// no react, componentes são funções que retornam um pedaço de código HTML, que é o que será renderizado na tela. O nome do componente deve começar com letra maiúscula para que o React possa diferenciá-lo de elementos HTML comuns.
// JSX é um html dentro do JavaScript, ou seja, é uma sintaxe que permite escrever código HTML dentro do JavaScript. O JSX é convertido em JavaScript puro pelo React, o que permite que o código seja interpretado pelo navegador.

// props é um objeto que contém as propriedades passadas para o componente. No exemplo abaixo, o componente TituloFormulario recebe uma propriedade chamada "texto", que é usada para exibir o título do formulário. As props são imutáveis, ou seja, não podem ser alteradas dentro do componente. Elas são usadas para passar dados de um componente pai para um componente filho.
// props.children é uma propriedade especial que contém os elementos filhos de um componente
export function TituloFormulario(props) {
  return (
    <h2 className="titulo-form">{props.children}</h2>
  )
}
