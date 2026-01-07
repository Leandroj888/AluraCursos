package med.voll.api.infrastructure.exception;

import jakarta.persistence.EntityNotFoundException;
import org.springframework.http.ResponseEntity;
import org.springframework.validation.FieldError;
import org.springframework.web.bind.MethodArgumentNotValidException;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;

@RestControllerAdvice // Indica para o spring que essa classe fará tratamentos de erros
public class TratdorDeErros {

    @ExceptionHandler(EntityNotFoundException.class) // Filtro para definir quais erros esse método trabalha
    public ResponseEntity tratatrError404() {
        return ResponseEntity.notFound().build();
    }

    @ExceptionHandler(MethodArgumentNotValidException.class) // Filtro para definir quais erros esse método trabalha
    public ResponseEntity tratatrError400(MethodArgumentNotValidException e) {
        var erros = e.getFieldErrors();
        return ResponseEntity.badRequest().body(erros.stream().map(DadosErrosValidacao::new).toList());
    }


    private record DadosErrosValidacao(String campo, String mensage) {
        public DadosErrosValidacao(FieldError erro) {
            this(erro.getField(), erro.getDefaultMessage());
        }
    }
}
