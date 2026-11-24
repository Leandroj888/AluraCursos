package br.com.alura.ecomart.controller;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.knuddels.jtokkit.Encodings;
import com.knuddels.jtokkit.api.Encoding;
import com.knuddels.jtokkit.api.EncodingRegistry;
import com.knuddels.jtokkit.api.ModelType;

import br.com.alura.ecomart.prompt.SystemPrompts;


import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.ai.chat.client.ChatClient;
import org.springframework.ai.chat.client.advisor.SimpleLoggerAdvisor;
import org.springframework.ai.chat.metadata.Usage;
import org.springframework.ai.chat.model.ChatResponse;
import org.springframework.ai.chat.prompt.ChatOptions;
import org.springframework.web.bind.annotation.GetMapping;


@RestController
@RequestMapping("categorizador")
public class CategorizadorDeProdutosController {

    private static final Logger log =
            LoggerFactory.getLogger(CategorizadorDeProdutosController.class);

    private final ChatClient chatClient;

    public CategorizadorDeProdutosController(ChatClient.Builder chatClientBuilder) {
        this.chatClient = chatClientBuilder
            .defaultSystem(SystemPrompts.INSTRUCOES)
            .defaultOptions(
                ChatOptions.builder()
                    .temperature(0.85)
                    .model("qwen3:4b"))
            .build();
    }

    @GetMapping    
    public String categorizar(@RequestParam String produto) {
        String system = """
            Você é um categorizador de produtos e deve responder apenas o nome da categoria do produto informado
                
            Escolha uma categoria dentro da lista abaixo:
            1. Higiene pessoal
            2. Eletrônicos
            3. Esportes
            4. Outros
                
            ###### exemplo de uso:
                
            Pergunta: Bola de futebol
            Resposta: Esportes
            """;

        /*
        return this.chatClient.prompt()
            .system(s -> s.param("instructions", system))
            .user(produto)
            .options(ChatOptions.builder().temperature(0.85).model("qwen3:4b"))
            .call()
            .content();        
        */
        
        ChatResponse response =  this.chatClient.prompt()
            .advisors(new SimpleLoggerAdvisor())
            .system(s -> s.param("instructions", system))
            .user(produto)
            .options(ChatOptions.builder().temperature(0.85).model("qwen3:4b"))
            .call()
            .chatResponse();


        if (response == null) {
            throw new IllegalStateException("Resposta da IA indisponível.");
        }

        Usage usage = response.getMetadata().getUsage();

        if (usage != null) {
            log.info("Spring AI - Tokens de entrada: {}", usage.getPromptTokens());
            log.info("Spring AI - Tokens de saída: {}", usage.getCompletionTokens());
            log.info("Spring AI - Total de tokens: {}", usage.getTotalTokens());
        }


        String content = response.getResult().getOutput().getText();

        contarTokensEntrada(system, produto);
        // Content não parece ser o retorno real
        contarTokenSaída(content);

        return content;
    }





    private void contarTokensEntrada(String system, String produto){
        log.info("JTokkit - Tokens de entrada: {}", contarTokens(SystemPrompts.INSTRUCOES + system + produto));
    }

    private void contarTokenSaída(String valor){
        log.info("JTokkit - Tokens de Saída: {}", contarTokens(valor));
    }

    private int contarTokens(String valor){
        EncodingRegistry registry = Encodings.newDefaultEncodingRegistry();

        // Get encoding for a specific model via type-safe enum
        Encoding enc = registry.getEncodingForModel(ModelType.GPT_4O_MINI);

        return enc.countTokens(valor);
    }

}
