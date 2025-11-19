package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerConfig;
import org.apache.kafka.clients.consumer.KafkaConsumer;
import org.apache.kafka.common.serialization.StringDeserializer;

import java.io.Closeable;
import java.io.IOException;
import java.time.Duration;
import java.util.Collections;
import java.util.Map;
import java.util.Properties;
import java.util.UUID;
import java.util.regex.Pattern;

public class KafkaService<T> implements Closeable {
    private final KafkaConsumer<String, T> consumer;
    private final ConsumerFunction parse;

    public KafkaService(String groupId, String topic, ConsumerFunction parse, Class<T> type, Map<String, String> properties) {
        this(parse, groupId, type, properties);
        consumer.subscribe(Collections.singletonList(topic));
    }

    public KafkaService(String groupId, Pattern topic, ConsumerFunction parse, Class<T> type, Map<String, String> properties) {
        this(parse, groupId, type, properties);
        consumer.subscribe(topic);
    }

    public void run () {
        while(true) {
            var records = consumer.poll(Duration.ofMillis(100));
            if (!records.isEmpty()) {
                System.out.println("Encontrei " + records.count() + " registros");

                for (var record : records) {
                    parse.consume(record);
                }
            }
        }
    }

    @Override
    public void close() {
        consumer.close();
    }

    private KafkaService(ConsumerFunction parse, String groupId, Class<T> type, Map<String, String> properties) {
        this.parse = parse;
        consumer = new KafkaConsumer<>(getProperties(groupId, type, properties));
    }

    private Properties getProperties(String groupId, Class<T> type, Map<String, String> overideProperties) {
        Properties properties = new Properties();
        properties.put(ConsumerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        properties.put(ConsumerConfig.KEY_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        properties.put(ConsumerConfig.VALUE_DESERIALIZER_CLASS_CONFIG, GsonDeserializer.class.getName());
        // Se tiver dois serviços com mesmo grupo as mensagens serão distribuidas entre eles
        properties.put(ConsumerConfig.GROUP_ID_CONFIG, groupId);
        // Muda o nome do consumer para ficar mais amigavel
        properties.put(ConsumerConfig.CLIENT_ID_CONFIG, groupId + " - " + UUID.randomUUID().toString());

        properties.put(GsonDeserializer.TYPE_CONFIG, type.getName());

        properties.putAll(overideProperties);
        return properties;
    }
}
