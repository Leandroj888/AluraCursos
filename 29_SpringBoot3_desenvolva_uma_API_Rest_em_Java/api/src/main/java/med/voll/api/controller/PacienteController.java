package med.voll.api.controller;

import jakarta.transaction.Transactional;
import jakarta.validation.Valid;
import med.voll.api.paciente.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.web.PageableDefault;
import org.springframework.web.bind.annotation.*;


@RestController
@RequestMapping("/pacientes")
public class PacienteController {

    @Autowired
    private PacienteRepository repository;

    @PostMapping
    @Transactional //Abre a transação pois terá escrita
    public void save(@RequestBody @Valid DadosCadastroPaciente dados) { // Essa anotação faz o Spring alimentar essa variável com o corpo da requisição
        repository.save(new Paciente(dados));
    }

    @GetMapping
    public Page<DadosListagemPaciente> listar(@PageableDefault(sort = {"nome"})Pageable paginacao) {
        //return repository.findAll().stream().map(DadosListagemPaciente::new).toList();
        //return repository.findAll(paginacao).map(DadosListagemPaciente::new);
        return repository.findAllByAtivoTrue(paginacao).map(DadosListagemPaciente::new);
    }

    @PutMapping
    @Transactional
    public void atualizar(@RequestBody @Valid DadosAtualizacaoPaciente dados) {
        var registro = repository.getReferenceById(dados.id());
        registro.atualizarInformacoes(dados);
    }

    @DeleteMapping("/{id}")
    @Transactional
    public void excluir(@PathVariable Long id) {
        //repository.deleteById(id);
        var registro = repository.getReferenceById(id);
        registro.excluir();
    }
}
