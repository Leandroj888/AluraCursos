package br.com.alura.ecomart;

import static org.junit.jupiter.api.Assertions.assertTrue;

import org.junit.jupiter.api.Test;
import org.springframework.boot.test.context.SpringBootTest;

// O teste carrega o contexto sem chamar a API da OpenAI.
@SpringBootTest(properties = "spring.ai.openai.api-key=test-key")
class EcomartApplicationTests {

    @Test
    void contextLoads() {
        assertTrue(true);
    }

}
