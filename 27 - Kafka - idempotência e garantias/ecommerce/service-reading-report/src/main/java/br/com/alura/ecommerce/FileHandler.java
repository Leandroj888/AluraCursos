package br.com.alura.ecommerce;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.StandardOpenOption;

public class FileHandler {
    public static void copyTo(Path source, File target) throws IOException {
        if (Files.exists(target.toPath())) {
            Files.delete(target.toPath());
        }

        target.getParentFile().mkdirs();
        Files.copy(source, target.toPath());
    }

    public static void append(File target, String content) throws IOException {
        Files.write(target.toPath(), content.getBytes(), StandardOpenOption.APPEND);
    }
}
