package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.math.BigDecimal;
import java.util.HashMap;

public class FraudDetectorService {
    private KafkaDispatcher<Order> orderDispatcher = new KafkaDispatcher<>();

    public static void main(String[] args) {
        var fraudDetectorService = new FraudDetectorService();
        try(var service = new KafkaService<>(
                FraudDetectorService.class.getSimpleName(),
                "ECOMMERCE_NEW_ORDER",
                fraudDetectorService::parse,
                Order.class,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Order> record) throws InterruptedException {
        System.out.println("----------------------------------------");
        System.out.println("Processing new order, checking for fraud");
        System.out.println(record.key());
        System.out.println(record.value());
        System.out.println(record.partition());
        System.out.println(record.offset());
        Thread.sleep(5000);

        var order = record.value();

        if (isFraud(order)) {
            System.out.println("Ordens is a fraud!!!!" + order);
            orderDispatcher.send("ECOMMERCE_ORDER_REJECTED", order.getEmail(), order);
            return;
        }


        System.out.println("Approved: " + order);
        orderDispatcher.send("ECOMMERCE_ORDER_APPROVED", order.getEmail(), order);

    }

    private static boolean isFraud(Order order) {
        return order.getAmount().compareTo(new BigDecimal("4500")) >= 0;
    }

 /*
    public static void main(String[] args) throws InterruptedException {
        var consumer = new KafkaConsumer<String, String>(properties());
        consumer.subscribe(Collections.singletonList("ECOMMERCE_NEW_ORDER"));

        while(true) {
            var records = consumer.poll(Duration.ofMillis(100));

            /-*
            if (records.isEmpty()) {
                System.out.println("Não encontrei registros");
                return;
            }
            *-/
            if (!records.isEmpty()) {
                System.out.println("Encontrei " + records.count() + " registros");

                for (var record : records) {
                    System.out.println("----------------------------------------");
                    System.out.println("Precessing new order, checking for fraud");
                    System.out.println(record.key());
                    System.out.println(record.value());
                    System.out.println(record.partition());
                    System.out.println(record.offset());
                    Thread.sleep(5000);
                }
                System.out.println("Ordens processadas");
            }
        }
    }

    private static Properties properties() {
        Properties props = new Properties();
        props.put(ConsumerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        props.put(ConsumerConfig.KEY_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        props.put(ConsumerConfig.VALUE_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        // Se tiver dois serviços com mesmo grupo as mensagens serão distribuidas entre eles
        props.put(ConsumerConfig.GROUP_ID_CONFIG, FraudDetectorService.class.getSimpleName());
        // Muda o nome do consumer para ficar mais amigavel
        props.put(ConsumerConfig.CLIENT_ID_CONFIG, FraudDetectorService.class.getSimpleName() + " - " + UUID.randomUUID().toString());
        // Auto commit
        props.put(ConsumerConfig.MAX_POLL_RECORDS_CONFIG, "1");
        return props;
    }

  */
}
