# Project pre-request

``` js
// ========================== CPF ========================== \\

function gerarCPF() {
  const rand = () => Math.floor(Math.random() * 9);

  const cpf = Array.from({ length: 9 }, rand);

  const calcDigito = (base) => {
    const soma = base.reduce(
      (acc, num, idx) => acc + num * (base.length + 1 - idx),
      0
    );
    const resto = (soma * 10) % 11;
    return resto === 10 ? 0 : resto;
  };

  cpf.push(calcDigito(cpf));
  cpf.push(calcDigito(cpf));

  return cpf.join("");
}

pm.environment.set("cpf", gerarCPF());


// ========================== CRM ========================== \\

const min = 1000;      // 4 dígitos
const max = 999999;   // 6 dígitos

pm.environment.set(
  "crm",
  Math.floor(Math.random() * (max - min + 1)) + min
);

// ========================== TELEFONE ========================== \\

// Telefone no formato (99) 9999 - 999
const ddd = Math.floor(Math.random() * 90) + 10;
const parte1 = Math.floor(Math.random() * 9000) + 1000;
const parte2 = Math.floor(Math.random() * 900) + 100;

pm.environment.set(
  "telefone",
  `(${ddd}) ${parte1} - ${parte2}`
);

// ========================== ESPECIALIDADE ========================== \\

const especialidades = [
  "ORTOPEDIA",
  "CARDIOLOGIA",
  "GINECOLOGIA",
  "DERMATOLOGIA"
];

const especialidadeSorteada =
  especialidades[Math.floor(Math.random() * especialidades.length)];

pm.environment.set("especialidade", especialidadeSorteada);

// ========================== ENDEREÇOS ========================== \\

const enderecos = [
  {
    logradouro: "Avenida Paulista",
    bairro: "Bela Vista",
    cidade: "São Paulo",
    uf: "SP",
    cep: "01311000"
  },
  {
    logradouro: "Rua Augusta",
    bairro: "Consolação",
    cidade: "São Paulo",
    uf: "SP",
    cep: "01305000"
  },
  {
    logradouro: "Avenida Atlântica",
    bairro: "Copacabana",
    cidade: "Rio de Janeiro",
    uf: "RJ",
    cep: "22021001"
  },
  {
    logradouro: "Rua das Laranjeiras",
    bairro: "Laranjeiras",
    cidade: "Rio de Janeiro",
    uf: "RJ",
    cep: "22240003"
  },
  {
    logradouro: "Avenida Afonso Pena",
    bairro: "Centro",
    cidade: "Belo Horizonte",
    uf: "MG",
    cep: "30130005"
  },
  {
    logradouro: "Rua XV de Novembro",
    bairro: "Centro",
    cidade: "Curitiba",
    uf: "PR",
    cep: "80020010"
  },
  {
    logradouro: "Avenida Borges de Medeiros",
    bairro: "Centro Histórico",
    cidade: "Porto Alegre",
    uf: "RS",
    cep: "90020021"
  },
  {
    logradouro: "Rua Domingos José Martins",
    bairro: "Centro",
    cidade: "Vitória",
    uf: "ES",
    cep: "29010090"
  },
  {
    logradouro: "Avenida Beira Mar",
    bairro: "Meireles",
    cidade: "Fortaleza",
    uf: "CE",
    cep: "60165121"
  },
  {
    logradouro: "Rua da Aurora",
    bairro: "Boa Vista",
    cidade: "Recife",
    uf: "PE",
    cep: "50050000"
  }
];

const endereco =
  enderecos[Math.floor(Math.random() * enderecos.length)];

pm.environment.set("logradouro", endereco.logradouro);
pm.environment.set("bairro", endereco.bairro);
pm.environment.set("cidade", endereco.cidade);
pm.environment.set("uf", endereco.uf);
pm.environment.set("cep", endereco.cep);
```

# Médico
## Detalhamento
GET: http://localhost:8080/medicos/19

## Cadastro Errado
POST: http://localhost:8080/medicos

``` json 
{
    "nome": "",
    "email": "sdgsdfg",
    "crm": "23",
    "telefone": "1",
    "especialidade": "{{especialidade}}",
    "endereco": {
        "logradouro": "{{logradouro}}",
        "bairro": "{{bairro}}",
        "cep": "{{cep}}",
        "cidade": "{{cidade}}",
        "uf": "{{uf}}",
        "numero": "{{$randomInt}}",
        "complemento": "{{$randomWord}}"
    }
}
```  


# Paciente
## Detalhamento
GET: http://localhost:8080/pacientes/19


# Usuário
POST: http://localhost:8080/login

``` json 
{
    "login": "ana.souza@voll.med",
    "senha": "123456"
}
``` 
