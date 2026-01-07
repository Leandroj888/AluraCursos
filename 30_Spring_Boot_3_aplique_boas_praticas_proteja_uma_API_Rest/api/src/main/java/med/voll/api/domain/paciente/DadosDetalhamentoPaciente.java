package med.voll.api.domain.paciente;

import med.voll.api.domain.endereco.Endereco;

public record DadosDetalhamentoPaciente(
        Long id,
        String nome,
        String email,
        String crm,
        String telefone,
        Endereco endereco
) {
    public DadosDetalhamentoPaciente(Paciente registro) {
        this(
                registro.getId(),
                registro.getNome(),
                registro.getEmail(),
                registro.getCpf(),
                registro.getTelefone(),
                registro.getEndereco()
        );
    }
}
