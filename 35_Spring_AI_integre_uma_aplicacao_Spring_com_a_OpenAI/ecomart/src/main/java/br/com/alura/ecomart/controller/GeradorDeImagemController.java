package br.com.alura.ecomart.controller;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.Comparator;
import java.util.stream.Stream;

import org.springframework.ai.image.ImageModel;
import org.springframework.ai.image.ImageOptions;
import org.springframework.ai.image.ImageOptionsBuilder;
import org.springframework.ai.image.ImagePrompt;
import org.springframework.ai.image.ImageResponse;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;


@RestController
@RequestMapping("imagem")
public class GeradorDeImagemController {

    private final ImageModel imageModel;

    public GeradorDeImagemController(ImageModel imageModel) {
        this.imageModel = imageModel;
    }


    @GetMapping    
    public String gerarImagem(@RequestParam String prompt) {
        ImageResponse response = imageModel.call(new ImagePrompt(prompt));
        return response.getResult().getOutput().getUrl();
    }


    @GetMapping(
            value = "/generate",
            produces = MediaType.IMAGE_PNG_VALUE
    )
    public ResponseEntity<byte[]> gerarExporImagem(
            @RequestParam String prompt) throws IOException {

        long inicio = System.currentTimeMillis();

        var options = ImageOptionsBuilder.builder().width(1024).height(1024).build();

        // Dispara a geração da imagem
        var response = imageModel.call(new ImagePrompt(prompt, options));

        var output = response.getResult().getOutput();
        System.out.println("Image URL: " + output.getUrl());
        System.out.println("Base64 presente: " + (output.getB64Json() != null));

        Path outputDir = Paths.get(
                System.getProperty("user.home"),
                "Documentos",
                "ComfyUI",
                "output"
        );

        Path imagemGerada = aguardarImagemMaisRecente(outputDir, inicio);

        byte[] imageBytes = Files.readAllBytes(imagemGerada);

        return ResponseEntity.ok()
                .contentType(MediaType.IMAGE_PNG)
                .body(imageBytes);
    }

    private Path aguardarImagemMaisRecente(Path outputDir, long inicio)
            throws IOException {

        long timeoutMs = 30000;
        long intervaloMs = 500;
        long limite = System.currentTimeMillis() + timeoutMs;

        while (System.currentTimeMillis() < limite) {
            try (Stream<Path> files = Files.list(outputDir)) {
                Path arquivo = files
                        .filter(p -> p.getFileName().toString().endsWith(".png"))
                        .filter(p -> p.getFileName().toString().startsWith("SpringAI_Test"))
                        .filter(p -> {
                            try {
                                return Files.getLastModifiedTime(p).toMillis() >= inicio;
                            } catch (IOException e) {
                                return false;
                            }
                        })
                        .max(Comparator.comparingLong(p -> {
                            try {
                                return Files.getLastModifiedTime(p).toMillis();
                            } catch (IOException e) {
                                return Long.MIN_VALUE;
                            }
                        }))
                        .orElse(null);

                if (arquivo != null) {
                    return arquivo;
                }
            }

            try {
                Thread.sleep(intervaloMs);
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
                throw new IllegalStateException("Thread interrompida ao aguardar imagem.", e);
            }
        }

        throw new IllegalStateException("Nenhuma imagem foi encontrada na pasta de saída do ComfyUI.");
    }

}
