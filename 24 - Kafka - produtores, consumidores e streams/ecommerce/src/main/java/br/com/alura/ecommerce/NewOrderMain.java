package br.com.alura.ecommerce;

import java.util.UUID;

public class NewOrderMain {
    public static void main(String [] args) {
        try (var dispatcher = new KafkaDispatcher()) {

            for (int i = 0; i < 1; i++) {
                String value = "1122234,122114,122355555";
                var key = UUID.randomUUID().toString();
                dispatcher.send("ECOMMERCE_NEW_ORDER", key, value);
                var email = "Thank you for your order! We are processing your order!";
                dispatcher.send("ECOMMERCE_SEND_EMAIL", key, email);
            }
        }

    }

    /*
    public static void main(String [] args) throws ExecutionException, InterruptedException {
        KafkaProducer<String, String> producer = new KafkaProducer<>(properties());

        for (int i = 0; i < 1; i++) {
            String value = "1122234,122114,122355555";

            var key = UUID.randomUUID().toString();
            var record = new ProducerRecord<>("ECOMMERCE_NEW_ORDER", key, value);
            // .get() força um retorno se conseguiu ou não enviar a mensagem
            producer.send(record, getCallback()).get();

            var email  = "Thank you for your order! We are processing your order!";
            var emailRecord = new ProducerRecord<>("ECOMMERCE_SEND_EMAIL", key, email);
            producer.send(emailRecord, getCallback()).get();
        }
    }

    private static Callback getCallback() {
        return (data, ex) -> {
            if (ex != null) {
                ex.printStackTrace();
                return;
            }
            System.out.println("sucesso enviando " + data.topic() + ":::: partition:" + data.partition() + "/ offset:" + data.offset() + "/ timestamp:" + data.timestamp());
        };
    }

    private static Properties properties() {
        Properties props = new Properties();
        props.put(ProducerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        props.put(ProducerConfig.KEY_SERIALIZER_CLASS_CONFIG, StringSerializer.class.getName());
        props.put(ProducerConfig.VALUE_SERIALIZER_CLASS_CONFIG, StringSerializer.class.getName());

        return props;
    }
     */
}
