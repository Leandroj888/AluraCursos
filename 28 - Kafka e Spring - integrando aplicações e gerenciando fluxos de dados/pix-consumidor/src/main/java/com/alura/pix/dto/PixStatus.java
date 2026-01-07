package com.alura.pix.dto;

import java.util.Arrays;

public enum PixStatus {
    EM_PROCESSAMENTO, PROCESSADO, ERRO;

    public static PixStatus fromString(String value) {
        if (value == null || value.isBlank()) {
            throw new IllegalArgumentException("Status do Pix não pode ser nulo ou vazio.");
        }

        return Arrays.stream(PixStatus.values())
                .filter(status -> status.name().equalsIgnoreCase(value.trim()))
                .findFirst()
                .orElseThrow(() ->
                        new IllegalArgumentException("Status de Pix inválido: " + value)
                );
    }
}
