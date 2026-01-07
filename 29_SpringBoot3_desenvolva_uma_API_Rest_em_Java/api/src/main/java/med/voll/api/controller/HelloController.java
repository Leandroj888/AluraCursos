package med.voll.api.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController // Indica ao spring que essa classe é um controller que trabalha com rest
@RequestMapping("/hello") // Indica o path que responde
public class HelloController {

    @GetMapping // Indica que será o método get responsável
    public String helloWorkdld () {
        return "Hello World Spring";
    }
}
