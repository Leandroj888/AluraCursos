package br.com.alura.ecomart.controller;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import br.com.alura.ecomart.prompt.SystemPrompts;

import org.springframework.ai.chat.client.ChatClient;
import org.springframework.web.bind.annotation.GetMapping;


@RestController
@RequestMapping("gerador")
public class GeradorDeProdutosController {

    private final ChatClient chatClient;

    public GeradorDeProdutosController(ChatClient.Builder chatClientBuilder) {
        // Facilita para o prompt final (System Prompt)
        this.chatClient = chatClientBuilder.defaultSystem(SystemPrompts.GLOBAL).build();
    }

    @GetMapping    
    public String gerarProdutos() {
        String pergunta = "Gere o nome de 5 produtos ecologicos";

        return this.chatClient.prompt()
            .user(pergunta)
            .call()
            .content();
    }

}
