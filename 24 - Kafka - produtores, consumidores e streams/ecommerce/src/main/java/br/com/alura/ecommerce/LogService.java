package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerConfig;
import org.apache.kafka.clients.consumer.KafkaConsumer;
import org.apache.kafka.common.serialization.StringDeserializer;

import java.time.Duration;
import java.util.Collections;
import java.util.Properties;
import java.util.regex.Pattern;

public class LogService {
    public static void main(String[] args) {
        var consumer = new KafkaConsumer<String, String>(properties());
        //Pattern para filtrar vários tópicos
        consumer.subscribe(Pattern.compile("ECOMMERCE.*"));

        while(true) {
            var records = consumer.poll(Duration.ofMillis(100));

            /*
            if (records.isEmpty()) {
                System.out.println("Não encontrei registros");
                return;
            }
            */
            if (!records.isEmpty()) {
                for (var record : records) {
                    System.out.println("----------------------------------------");
                    System.out.println("LOG: " + record.topic());
                    System.out.println(record.key());
                    System.out.println(record.value());
                    System.out.println(record.partition());
                    System.out.println(record.offset());
                }
            }
        }
    }

    private static Properties properties() {
        Properties props = new Properties();
        props.put(ConsumerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        props.put(ConsumerConfig.KEY_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        props.put(ConsumerConfig.VALUE_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        // Se tiver dois serviços com mesmo grupo as mensagens serão distribuidas entre eles
        props.put(ConsumerConfig.GROUP_ID_CONFIG, LogService.class.getSimpleName());
        return props;
    }
}
