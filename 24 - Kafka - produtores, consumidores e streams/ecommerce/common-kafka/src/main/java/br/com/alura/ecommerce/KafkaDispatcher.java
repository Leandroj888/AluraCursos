package br.com.alura.ecommerce;

import org.apache.kafka.clients.producer.Callback;
import org.apache.kafka.clients.producer.KafkaProducer;
import org.apache.kafka.clients.producer.ProducerConfig;
import org.apache.kafka.clients.producer.ProducerRecord;
import org.apache.kafka.common.serialization.StringSerializer;

import java.io.Closeable;
import java.util.Properties;
import java.util.concurrent.ExecutionException;

public class KafkaDispatcher<T> implements Closeable {
    private final KafkaProducer<String, T> producer;

    public KafkaDispatcher() {
        this.producer = new KafkaProducer<>(properties());
    }

    public void send(String topic, String key, T value) {
        var record = new ProducerRecord<>(topic, key, value);
        try {
            producer.send(record, getCallback()).get();
        } catch (InterruptedException | ExecutionException e) {
            throw new RuntimeException(e);
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
        props.put(ProducerConfig.VALUE_SERIALIZER_CLASS_CONFIG, GsonSerializer.class.getName());
        return props;
    }

    @Override
    public void close() {
        producer.close();
    }
}
