package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.util.HashMap;

public class EmailService {
    public static void main(String[] args) {
        var emailService = new EmailService();
        try (var service = new KafkaService<>(
                EmailService.class.getSimpleName(),
                "ECOMMERCE_SEND_EMAIL",
                emailService::parse,
                Email.class,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Email> record) throws InterruptedException {
        System.out.println("----------------------------------------");
        System.out.println("Send email, checking for fraud");
        System.out.println(record.key());
        System.out.println(record.value());
        System.out.println(record.partition());
        System.out.println(record.offset());
        Thread.sleep(5000);
        System.out.println("Email sends");
    }

    /*
    public static void main(String[] args) throws InterruptedException {
        var consumer = new KafkaConsumer<String, String>(properties());
        consumer.subscribe(Collections.singletonList("ECOMMERCE_SEND_EMAIL"));

        while(true) {
            var records = consumer.poll(Duration.ofMillis(100));

            /-*
            if (records.isEmpty()) {
                System.out.println("Não encontrei registros");
                return;
            }
            /-*
            if (!records.isEmpty()) {
                System.out.println("Encontrei " + records.count() + " registros");

                for (var record : records) {
                    System.out.println("----------------------------------------");
                    System.out.println("Send email, checking for fraud");
                    System.out.println(record.key());
                    System.out.println(record.value());
                    System.out.println(record.partition());
                    System.out.println(record.offset());
                    Thread.sleep(5000);
                }
                System.out.println("Email sends");
            }
        }
    }

    private static Properties properties() {
        Properties props = new Properties();
        props.put(ConsumerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        props.put(ConsumerConfig.KEY_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        props.put(ConsumerConfig.VALUE_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        // Se tiver dois serviços com mesmo grupo as mensagens serão distribuidas entre eles
        props.put(ConsumerConfig.GROUP_ID_CONFIG, EmailService.class.getSimpleName());
        return props;
    }
    */
}
