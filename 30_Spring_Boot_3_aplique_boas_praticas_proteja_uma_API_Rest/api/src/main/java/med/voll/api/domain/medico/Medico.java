package med.voll.api.domain.medico;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.NoArgsConstructor;
import med.voll.api.domain.endereco.Endereco;

import java.util.Optional;

@Table(name = "medicos")
@Entity(name = "Medico")
@Getter
@NoArgsConstructor
@AllArgsConstructor
@EqualsAndHashCode(of = "id")
public class Medico {

    @Id
    @GeneratedValue (strategy = GenerationType.IDENTITY)
    private Long id;
    private String crm;
    private String email;
    private String nome;
    private String telefone;

    @Enumerated(EnumType.STRING)
    private Especialidade especialidade;

    @Embedded
    private Endereco endereco;

    private Boolean ativo;

    public Medico(DadosCadastroMedico dados) {
        nome = dados.nome();
        email = dados.email();
        crm = dados.crm();
        telefone = dados.telefone();
        especialidade = dados.especialidade();
        endereco = new Endereco(dados.endereco());
        ativo = true;
    }

    public void atualizarInformacoes(DadosAtualizacaoMedico dados) {
        Optional.ofNullable(dados.nome()).ifPresent(n -> nome = n);
        Optional.ofNullable(dados.telefone()).ifPresent(t -> telefone = t);
        Optional.ofNullable(dados.endereco()).ifPresent(e -> endereco.atualizarInformacoes(e));
    }

    public void excluir() {
        ativo = false;
    }
}
