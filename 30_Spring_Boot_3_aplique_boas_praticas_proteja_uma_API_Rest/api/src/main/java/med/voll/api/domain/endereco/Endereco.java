package med.voll.api.domain.endereco;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;

import java.util.Optional;

@Embeddable
@Getter
@NoArgsConstructor
@AllArgsConstructor
public class Endereco {
    private String logradouro;
    private String bairro;
    private String cep;
    private String cidade;
    private String uf;
    private String numero;
    private String complemento;

    public Endereco(DadosEndereco endereco) {
        logradouro = endereco.logradouro();
        bairro = endereco.bairro();
        cep = endereco.cep();
        cidade = endereco.cidade();
        uf = endereco.uf();
        numero = endereco.numero();
        complemento = endereco.complemento();
    }

    public void atualizarInformacoes(DadosEndereco dados) {
        Optional.ofNullable(dados.logradouro()).ifPresent(n -> logradouro = n);
        Optional.ofNullable(dados.bairro()).ifPresent(n -> bairro = n);
        Optional.ofNullable(dados.cep()).ifPresent(n -> cep = n);
        Optional.ofNullable(dados.cidade()).ifPresent(n -> cidade = n);
        Optional.ofNullable(dados.uf()).ifPresent(n -> uf = n);
        Optional.ofNullable(dados.numero()).ifPresent(n -> numero = n);
        Optional.ofNullable(dados.complemento()).ifPresent(n -> complemento = n);
    }
}
