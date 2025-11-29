package br.com.alura.ecommerce.consumer;

import br.com.alura.ecommerce.Message;
import br.com.alura.ecommerce.dispacher.GsonSerializer;
import br.com.alura.ecommerce.dispacher.KafkaDispatcher;
import org.apache.kafka.clients.consumer.ConsumerConfig;
import org.apache.kafka.clients.consumer.KafkaConsumer;
import org.apache.kafka.common.serialization.StringDeserializer;

import java.io.Closeable;
import java.time.Duration;
import java.util.Collections;
import java.util.Map;
import java.util.Properties;
import java.util.UUID;
import java.util.concurrent.ExecutionException;
import java.util.regex.Pattern;

public class KafkaService<T> implements Closeable {
    private final KafkaConsumer<String, Message<T>> consumer;
    private final ConsumerFunction<T> parse;

    public KafkaService(String groupId, String topic, ConsumerFunction<T> parse, Map<String, String> properties) {
        this(parse, groupId, properties);
        consumer.subscribe(Collections.singletonList(topic));
    }

    public KafkaService(String groupId, Pattern topic, ConsumerFunction<T> parse, Map<String, String> properties) {
        this(parse, groupId, properties);
        consumer.subscribe(topic);
    }

    public void run () throws ExecutionException, InterruptedException {
        try ( var deadLetter = new KafkaDispatcher<>()) {
            while(true) {
                var records = consumer.poll(Duration.ofMillis(100));
                if (!records.isEmpty()) {
                    System.out.println("Encontrei " + records.count() + " registros");

                    for (var record : records) {
                        try {
                            parse.consume(record);
                        } catch (Exception e) {
                            e.printStackTrace();
                            var message = record.value();
                            deadLetter.send(
                                    "ECOMMERCE_DEADLETTER",
                                    message.getId().toString(),
                                    new GsonSerializer().serialize("", message),
                                    message.getId().continueWith("DeadLetter"));
                        }
                    }
                }
            }

        }
    }

    @Override
    public void close() {
        consumer.close();
    }

    private KafkaService(ConsumerFunction<T> parse, String groupId, Map<String, String> properties) {
        this.parse = parse;
        consumer = new KafkaConsumer<>(getProperties(groupId, properties));
    }

    private Properties getProperties(String groupId, Map<String, String> overideProperties) {
        Properties properties = new Properties();
        properties.put(ConsumerConfig.BOOTSTRAP_SERVERS_CONFIG, "localhost:9092");
        properties.put(ConsumerConfig.KEY_DESERIALIZER_CLASS_CONFIG, StringDeserializer.class.getName());
        properties.put(ConsumerConfig.VALUE_DESERIALIZER_CLASS_CONFIG, GsonDeserializer.class.getName());
        // Se tiver dois serviços com mesmo grupo as mensagens serão distribuidas entre eles
        properties.put(ConsumerConfig.GROUP_ID_CONFIG, groupId);
        // Muda o nome do consumer para ficar mais amigavel
        properties.put(ConsumerConfig.CLIENT_ID_CONFIG, groupId + " - " + UUID.randomUUID().toString());
        // Número máximo de consumo por vez, quanto menor mais seguro para evitar quebras de processos
        properties.put(ConsumerConfig.MAX_POLL_RECORDS_CONFIG, "1");

        // Ao usar AUTO_OFFSET_RESET_CONFIG define por onde começar,
        // latest é a última mensgaem, ou seja, não processa antigas
        // earliest seria desde a mensagem mais antiga não processada
        // disable não levanta se não tiver
        properties.put(ConsumerConfig.AUTO_OFFSET_RESET_CONFIG, "earliest");

        // ISOLATION_LEVEL_CONFIG Define se consumirá só quando a mensagem estiver commitada em todas réplicas ou consome assim que possível.
        // read_commited espera comitar em todas replicas
        //properties.put(ConsumerConfig.ISOLATION_LEVEL_CONFIG, "read_commited");

        //properties.put(GsonDeserializer.TYPE_CONFIG, type.getName());

        properties.putAll(overideProperties);
        return properties;
    }
}
