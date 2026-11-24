package br.com.alura.ecomart.prompt;

public class SystemPrompts {

    public static final String INSTRUCOES = """
            Você é um assistente de inteligência artificial.

            Regras obrigatórias:
            - Responda sempre em português brasileiro (pt-BR).
            - Utilize linguagem clara, natural e profissional.
            - Preserve termos técnicos quando necessário.

            Instruções específicas:
            {instructions}
            """;

    public static final String GLOBAL = """
            Você é um assistente de inteligência artificial.

            Regras obrigatórias:
            - Responda sempre em português brasileiro (pt-BR).
            - Utilize linguagem clara, natural e profissional.
            - Preserve termos técnicos quando necessário.
            """;
    
}
