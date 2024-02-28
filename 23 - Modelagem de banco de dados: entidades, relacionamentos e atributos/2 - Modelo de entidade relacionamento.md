# Anotações
- Mini-mundo, conceito de trazer a realidade para as entidades
- Cliente -> Compra -> Livro <- Escreveu <- Autor
- Escolher ou isolar aspectos

- DER (Diagrama de Entidade e Relacionamento)
- MER (Modelo de Entidade e Relacionamento)


# Entrevista do Clube do Livro.

Queremos coletar os dados pessoais de nossos **`clientes`**, como se ele é pessoa física ou jurídica. No caso de PF o seu **`CPF e RG`**, e no caso de jurídica o **`CNPJ e IE`**. Além disso, queremos coletar e armazenar o seu **`nome, endereço, telefone e e-mail`**.

O produto principal do e-commerce são **`livros`**. Estes livros têm informações associadas a eles como o **`título, categoria, o ISBN (International Standard Book Number), o ano de publicação, o valor, a editora que publicou o livro, bem como o autor ou autora da obra`**.

Os livros são fornecidos por **`editoras`**. Precisamos ter guardados o **`telefone da editora, o nome de contato, o e-mail e no máximo 2 telefones`**.

Sabemos que não podemos ter o mesmo livro vindo de várias editoras. O livro é exclusivo de uma editora.

Nosso cliente pode comprar um ou mais livros através de um **pedido de compra**. Porém, sempre que ele faz uma compra precisamos verificar no **estoque** se o livro está ou não disponível antes de efetuar a operação.