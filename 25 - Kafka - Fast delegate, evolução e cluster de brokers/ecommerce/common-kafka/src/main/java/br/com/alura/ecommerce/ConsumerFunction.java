package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.sql.SQLException;

public interface ConsumerFunction<T> {
    void consume(ConsumerRecord<String, T> record) throws Exception;
}
