$total = 100

# ========================== CPF ========================== #

function New-CPF {
    $rand = { Get-Random -Minimum 0 -Maximum 9 }
    $cpf = 1..9 | ForEach-Object { & $rand }

    function Calc-Digit($base) {
        $sum = 0
        for ($i = 0; $i -lt $base.Count; $i++) {
            $sum += $base[$i] * ($base.Count + 1 - $i)
        }
        $rest = ($sum * 10) % 11
        if ($rest -eq 10) { 0 } else { $rest }
    }

    $cpf += Calc-Digit $cpf
    $cpf += Calc-Digit $cpf

    -join $cpf
}

# ========================== TELEFONE ========================== #

$ddd = Get-Random -Minimum 10 -Maximum 99
$parte1 = Get-Random -Minimum 1000 -Maximum 9999
$parte2 = Get-Random -Minimum 100 -Maximum 999

# ========================== ENDEREÇOS ========================== #

$enderecos = @(
    @{logradouro="Avenida Paulista"; bairro="Bela Vista"; cidade="Sao Paulo"; uf="SP"; cep="01311000"},
    @{logradouro="Rua XV de Novembro"; bairro="Centro"; cidade="Curitiba"; uf="PR"; cep="80020010"},
    @{logradouro="Avenida Atlantica"; bairro="Copacabana"; cidade="Rio de Janeiro"; uf="RJ"; cep="22021001"},
    @{logradouro="Rua Augusta"; bairro="Consolacao"; cidade="Sao Paulo"; uf="SP"; cep="01305000"},
    @{logradouro="Rua das Laranjeiras"; bairro="Laranjeiras"; cidade="Rio de Janeiro"; uf="RJ"; cep="22240003"},
    @{logradouro="Avenida Afonso Pena"; bairro="Centro"; cidade="Belo Horizonte"; uf="MG"; cep="30130005"},
    @{logradouro="Avenida Borges de Medeiros"; bairro="Centro Historico"; cidade="Porto Alegre"; uf="RS"; cep="90020021"},
    @{logradouro="Rua Domingos Jose Martins"; bairro="Centro"; cidade="Vitoria"; uf="ES"; cep="29010090"},
    @{logradouro="Avenida Beira Mar"; bairro="Meireles"; cidade="Fortaleza"; uf="CE"; cep="60165121"},
    @{logradouro="Rua da Aurora"; bairro="Boa Vista"; cidade="Recife"; uf="PE"; cep="50050000"},

    @{logradouro="Avenida Brasil"; bairro="Centro"; cidade="Goiania"; uf="GO"; cep="74030010"},
    @{logradouro="Rua Sete de Setembro"; bairro="Centro"; cidade="Florianopolis"; uf="SC"; cep="88010001"},
    @{logradouro="Avenida Independencia"; bairro="Centro"; cidade="Campinas"; uf="SP"; cep="13013001"},
    @{logradouro="Rua Marechal Deodoro"; bairro="Centro"; cidade="Maceio"; uf="AL"; cep="57020060"},
    @{logradouro="Avenida Getulio Vargas"; bairro="Centro"; cidade="Manaus"; uf="AM"; cep="69020010"},
    @{logradouro="Rua Barao do Rio Branco"; bairro="Centro"; cidade="Joao Pessoa"; uf="PB"; cep="58010000"},
    @{logradouro="Avenida Rio Branco"; bairro="Centro"; cidade="Natal"; uf="RN"; cep="59025000"},
    @{logradouro="Rua Sao Jose"; bairro="Centro"; cidade="Aracaju"; uf="SE"; cep="49010000"},
    @{logradouro="Avenida Jeronimo de Albuquerque"; bairro="Cohama"; cidade="Sao Luis"; uf="MA"; cep="65071000"},
    @{logradouro="Rua Treze de Maio"; bairro="Centro"; cidade="Teresina"; uf="PI"; cep="64001000"},

    @{logradouro="Avenida Brasilia"; bairro="Plano Piloto"; cidade="Brasilia"; uf="DF"; cep="70040902"},
    @{logradouro="Rua Amazonas"; bairro="Centro"; cidade="Uberlandia"; uf="MG"; cep="38400118"},
    @{logradouro="Avenida Dom Pedro II"; bairro="Centro"; cidade="Joao Monlevade"; uf="MG"; cep="35930000"},
    @{logradouro="Rua Mato Grosso"; bairro="Centro"; cidade="Campo Grande"; uf="MS"; cep="79002010"},
    @{logradouro="Avenida Fernando Ferrari"; bairro="Jardim da Penha"; cidade="Vitoria"; uf="ES"; cep="29060100"},
    @{logradouro="Rua Pernambuco"; bairro="Centro"; cidade="Cuiaba"; uf="MT"; cep="78005000"},
    @{logradouro="Avenida JK"; bairro="Centro"; cidade="Palmas"; uf="TO"; cep="77001000"},
    @{logradouro="Rua Rio Grande do Sul"; bairro="Centro"; cidade="Boa Vista"; uf="RR"; cep="69301010"},
    @{logradouro="Avenida Tancredo Neves"; bairro="Centro"; cidade="Macapa"; uf="AP"; cep="68900001"},
    @{logradouro="Rua Para"; bairro="Centro"; cidade="Belem"; uf="PA"; cep="66017000"},

    @{logradouro="Avenida Santos Dumont"; bairro="Centro"; cidade="Londrina"; uf="PR"; cep="86010000"},
    @{logradouro="Rua Minas Gerais"; bairro="Centro"; cidade="Santos"; uf="SP"; cep="11013001"},
    @{logradouro="Avenida Sete de Setembro"; bairro="Centro"; cidade="Salvador"; uf="BA"; cep="40060001"},
    @{logradouro="Rua Santa Catarina"; bairro="Centro"; cidade="Joinville"; uf="SC"; cep="89201001"},
    @{logradouro="Avenida Presidente Vargas"; bairro="Centro"; cidade="Belem"; uf="PA"; cep="66010000"},
    @{logradouro="Rua Alagoas"; bairro="Centro"; cidade="Ribeirao Preto"; uf="SP"; cep="14015000"},
    @{logradouro="Avenida Central"; bairro="Centro"; cidade="Anapolis"; uf="GO"; cep="75020010"},
    @{logradouro="Rua Goias"; bairro="Centro"; cidade="Cascavel"; uf="PR"; cep="85801000"},
    @{logradouro="Avenida Mato Grosso"; bairro="Centro"; cidade="Rondonopolis"; uf="MT"; cep="78700000"},
    @{logradouro="Rua Bahia"; bairro="Centro"; cidade="Feira de Santana"; uf="BA"; cep="44001000"}
)


# ========================== TOKEN ========================== #

$loginBody = @{
    login = "ana.souza@voll.med"
    senha = "123456"
} | ConvertTo-Json

$tokenResponse = Invoke-RestMethod `
    -Uri "http://localhost:8080/login" `
    -Method Post `
    -ContentType "application/json" `
    -Body $loginBody

$token = $tokenResponse.token

# ========================== NOMES ========================== #
$firstNames = @(
    "Ana","Beatriz","Bruna","Camila","Carla","Daniela","Eduarda","Fernanda",
    "Gabriela","Helena","Isabela","Juliana","Larissa","Mariana",
    "Renata","Sabrina","Tatiane","Vanessa",
    "Andre","Bruno","Carlos","Daniel","Diego","Eduardo","Felipe","Guilherme",
    "Henrique","Igor","Leonardo","Lucas","Matheus","Miguel",
    "Pedro","Rafael","Rodrigo","Thiago","Vitor"
)

$lastNames = @(
    "Silva","Santos","Oliveira","Pereira","Costa","Rodrigues","Alves","Lima",
    "Gomes","Ribeiro","Carvalho","Souza","Fernandes","Araujo","Rocha",
    "Martins","Barbosa","Teixeira","Moreira","Correia","Mendes","Nogueira",
    "Freitas","Cavalcanti","Farias","Pacheco","Batista","Monteiro",
    "Moura","Rangel","Tavares","Figueiredo","Peixoto"
)

# ========================== PACIENTES ========================== #
for ($i = 1; $i -le $total; $i++) {

    Write-Progress `
        -Activity "Cadastrando Pacientes" `
        -Status "Registro $i de $total" `
        -PercentComplete (($i / $total) * 100)

    $endereco = Get-Random $enderecos
    $especialidade = Get-Random $especialidades
    $telefone = "($ddd) $parte1 - $parte2"
    $nome = "$(Get-Random $firstNames) $(Get-Random $lastNames) $(Get-Random $lastNames)"
    $email = ($nome.ToLower().Replace(" ", "_")) + "@email.com"

    $body = @{
        nome =$nome
        email = $email
        cpf = New-CPF
        telefone = $telefone
        endereco = @{
            logradouro = $endereco.logradouro
            bairro = $endereco.bairro
            cep = $endereco.cep
            cidade = $endereco.cidade
            uf = $endereco.uf
            numero = Get-Random -Minimum 1 -Maximum 999
            complemento = "Apto $(Get-Random -Minimum 1 -Maximum 99)"
        }
    } | ConvertTo-Json -Depth 5

    Invoke-RestMethod `
        -Uri "http://localhost:8080/pacientes" `
        -Method Post `
        -Headers @{
            Authorization = "Bearer $token"
            "Content-Type" = "application/json"
        } `
        -Body $body `
        -ErrorAction Stop | Out-Null
}

Write-Progress -Activity "Cadastrando Pacientes" -Completed

# ========================== ESPECIALIDADE ========================== #

$especialidades = @(
    "ORTOPEDIA",
    "CARDIOLOGIA",
    "GINECOLOGIA",
    "DERMATOLOGIA"
)

# ========================== MÉDICOS ========================== #
for ($i = 1; $i -le $total; $i++) {

    Write-Progress `
        -Activity "Cadastrando Médicos" `
        -Status "Registro $i de $total" `
        -PercentComplete (($i / $total) * 100)

    $endereco = Get-Random $enderecos
    $especialidade = Get-Random $especialidades
    $telefone = "($ddd) $parte1 - $parte2"
    $nome = "$(Get-Random $firstNames) $(Get-Random $lastNames) $(Get-Random $lastNames)"
    $email = ($nome.ToLower().Replace(" ", "_")) + "@email.com"

    $body = @{
        nome =$nome
        email = $email
        crm = Get-Random -Minimum 1000 -Maximum 999999
        especialidade = $especialidade
        telefone = $telefone
        endereco = @{
            logradouro = $endereco.logradouro
            bairro = $endereco.bairro
            cep = $endereco.cep
            cidade = $endereco.cidade
            uf = $endereco.uf
            numero = Get-Random -Minimum 1 -Maximum 999
            complemento = "Apto $(Get-Random -Minimum 1 -Maximum 99)"
        }
    } | ConvertTo-Json -Depth 5

    Invoke-RestMethod `
        -Uri "http://localhost:8080/medicos" `
        -Method Post `
        -Headers @{
            Authorization = "Bearer $token"
            "Content-Type" = "application/json"
        } `
        -Body $body `
        -ErrorAction Stop | Out-Null
}

Write-Progress -Activity "Cadastrando Médicos" -Completed