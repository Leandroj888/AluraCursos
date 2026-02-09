package med.voll.api.controller;

import io.swagger.v3.oas.annotations.security.SecurityRequirement;
import jakarta.transaction.Transactional;
import jakarta.validation.Valid;
import med.voll.api.domain.medico.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.web.PageableDefault;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.util.UriComponentsBuilder;

@RestController
@RequestMapping("/medicos")
@SecurityRequirement(name = "bearer-key")
public class MedicoController {

    @Autowired
    private MedicoRepository repository;

    @PostMapping
    @Transactional //Abre a transação, pois terá escrita
    public ResponseEntity save(@RequestBody @Valid DadosCadastroMedico dados, UriComponentsBuilder uriBuilder) { // Essa anotação faz o Spring alimentar essa variável com o corpo da requisição
        var registro = repository.save(new Medico(dados));

        var uri = uriBuilder.path("medicos/{id}").buildAndExpand(registro.getId()).toUri();

        return ResponseEntity.created(uri).body(new DadosDetalhamentoMedico(registro));
    }

    @GetMapping
    public ResponseEntity<Page<DadosListagemMedico>> listar(@PageableDefault(size = 10, page = 0, sort = {"nome"}) Pageable paginacao) {
        var page = repository.findAllByAtivoTrue(paginacao).map(DadosListagemMedico::new);
        return ResponseEntity.ok(page);
    }

    @PutMapping
    @Transactional
    public ResponseEntity atualizar(@RequestBody @Valid DadosAtualizacaoMedico dados) {
        var registro = repository.getReferenceById(dados.id());
        registro.atualizarInformacoes(dados);

        return ResponseEntity.ok(new DadosDetalhamentoMedico(registro));
    }

    @DeleteMapping("/{id}")
    @Transactional
    public ResponseEntity excluir(@PathVariable Long id) {
        //repository.deleteById(id);
        var registro = repository.getReferenceById(id);
        registro.excluir();

        return ResponseEntity.noContent().build();
    }

    @GetMapping("/{id}")
    public ResponseEntity detalhar(@PathVariable Long id) {
        var registro = repository.getReferenceById(id);
        return ResponseEntity.ok(new DadosDetalhamentoMedico(registro));
    }
}
