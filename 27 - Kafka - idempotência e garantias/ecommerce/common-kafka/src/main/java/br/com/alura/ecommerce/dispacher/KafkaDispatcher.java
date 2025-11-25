package br.com.alura.ecommerce.dispacher;

import br.com.alura.ecommerce.CorrelationId;
import br.com.alura.ecommerce.Message;
import org.apache.kafka.clients.producer.*;
import org.apache.kafka.common.serialization.StringSerializer;

import java.io.Closeable;
import java.util.Properties;
import java.util.concurrent.ExecutionException;
import java.util.concurrent.Future;

public class KafkaDispatcher<T> implements Closeable {
    private final KafkaProducer<String, Message<T>> producer;

    public KafkaDispatcher() {
        this.producer = new KafkaProducer<>(properties());
    }

    public Future<RecordMetadata> sendAsync(String topic, String key, T payload, CorrelationId id) {
        var value = new Message<>(id.continueWith("_" + topic), payload);
        var record = new ProducerRecord<>(topic, key, value);
        return producer.send(record, getCallback());
    }

    // Usar sempre a função com nome mais simples sendo a mais segura como padrão
    // Dessa forma o dev evita chamar erroneamente
    public void send(String topic, String key, T payload, CorrelationId id) throws ExecutionException, InterruptedException {
        Future<RecordMetadata> future = sendAsync(topic, key, payload, id);
        future.get();
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
        props.put(ProducerConfig.ACKS_CONFIG, "all"); // Como funciona a validação da mensagem dos get de confirmação, 0 - nenhuma, 1 - apenas o lider receber, all - espera todas replicas e o líder que estão em sincronia
        return props;
    }

    @Override
    public void close() {
        producer.close();
    }
}
