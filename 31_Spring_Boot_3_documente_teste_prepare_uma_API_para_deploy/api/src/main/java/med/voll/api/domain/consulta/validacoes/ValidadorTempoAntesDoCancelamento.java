package med.voll.api.domain.consulta.validacoes;

import med.voll.api.domain.ValidacaoException;
import med.voll.api.domain.consulta.Consulta;
import med.voll.api.domain.consulta.DadosCancelamentoConsulta;
import org.springframework.stereotype.Component;

import java.time.LocalDateTime;

@Component
public class ValidadorTempoAntesDoCancelamento implements ValidadorCancelamentoDeAgendamento{

    @Override
    public void validar(DadosCancelamentoConsulta dados, Consulta consulta) {
        LocalDateTime limite = LocalDateTime.now().plusHours(24);
        LocalDateTime dataFutura = consulta.getData();

        if (dataFutura.isBefore(limite)) {
            throw new ValidacaoException("Consulta só pode ser cancelada até 24 horas antes");
        }
    }
}
