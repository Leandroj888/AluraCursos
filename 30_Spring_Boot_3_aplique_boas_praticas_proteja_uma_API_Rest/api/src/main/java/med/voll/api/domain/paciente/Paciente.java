package med.voll.api.domain.paciente;

import jakarta.persistence.*;
import jakarta.validation.Valid;
import lombok.AllArgsConstructor;
import lombok.EqualsAndHashCode;
import lombok.Getter;
import lombok.NoArgsConstructor;
import med.voll.api.domain.endereco.Endereco;

import java.util.Optional;

@Table(name = "pacientes")
@Entity(name = "Paciente")
@Getter
@NoArgsConstructor
@AllArgsConstructor
@EqualsAndHashCode(of = "id")
public class Paciente {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nome;
    private String email;
    private String telefone;
    private String cpf;

    @Embedded
    private Endereco endereco;

    private Boolean ativo;

    public Paciente(DadosCadastroPaciente dados) {
        nome = dados.nome();
        email = dados.email();
        cpf = dados.cpf();
        telefone = dados.telefone();
        endereco = new Endereco(dados.endereco());
        ativo = true;
    }

    public void atualizarInformacoes(@Valid DadosAtualizacaoPaciente dados) {
        Optional.ofNullable(dados.nome()).ifPresent(n -> nome = n);
        Optional.ofNullable(dados.telefone()).ifPresent(t -> telefone = t);
        Optional.ofNullable(dados.endereco()).ifPresent(e -> endereco.atualizarInformacoes(e));
    }

    public void excluir() {
        ativo = false;
    }
}
