package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class EmailService {
    public static void main(String[] args) throws ExecutionException, InterruptedException {
        var emailService = new EmailService();
        try (var service = new KafkaService<>(
                EmailService.class.getSimpleName(),
                "ECOMMERCE_SEND_EMAIL",
                emailService::parse,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Message<Email>> record) throws InterruptedException {
        System.out.println("----------------------------------------");
        System.out.println("Send email, checking for fraud");
        System.out.println(record.key());
        System.out.println(record.value().getPayload());
        System.out.println(record.partition());
        System.out.println(record.offset());
        Thread.sleep(5000);
        System.out.println("Email sends");
    }
}
