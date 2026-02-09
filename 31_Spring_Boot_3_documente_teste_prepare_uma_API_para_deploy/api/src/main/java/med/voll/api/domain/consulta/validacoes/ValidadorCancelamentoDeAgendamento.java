package med.voll.api.domain.consulta.validacoes;

import med.voll.api.domain.consulta.Consulta;
import med.voll.api.domain.consulta.DadosCancelamentoConsulta;

public interface ValidadorCancelamentoDeAgendamento {
    void validar(DadosCancelamentoConsulta dados, Consulta consulta);
}
