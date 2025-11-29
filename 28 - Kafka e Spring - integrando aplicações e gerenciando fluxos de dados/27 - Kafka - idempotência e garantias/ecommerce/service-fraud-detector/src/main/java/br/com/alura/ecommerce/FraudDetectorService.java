package br.com.alura.ecommerce;

import br.com.alura.ecommerce.consumer.ConsumerService;
import br.com.alura.ecommerce.consumer.KafkaService;
import br.com.alura.ecommerce.consumer.ServiceRunner;
import br.com.alura.ecommerce.database.LocalDatabase;
import br.com.alura.ecommerce.dispacher.KafkaDispatcher;
import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.math.BigDecimal;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class FraudDetectorService implements ConsumerService<Order> {
    private final LocalDatabase database;
    private KafkaDispatcher<Order> orderDispatcher = new KafkaDispatcher<>();
/*
    public static void main(String[] args) throws ExecutionException, InterruptedException {
        var fraudDetectorService = new FraudDetectorService();
        try(var service = new KafkaService<>(
                FraudDetectorService.class.getSimpleName(),
                "ECOMMERCE_NEW_ORDER",
                fraudDetectorService::parse,
                new HashMap<>())) {
            service.run();
        }
    }
 */

    FraudDetectorService() throws SQLException {
        this.database = new LocalDatabase("frauds_database");

        this.database.createIfNotExists (
                "CREATE TABLE IF NOT EXISTS orders("+
                        "uuid VARCHAR(200) PRIMARY KEY," +
                        "is_fraud boolean)"
        );
    }
    public static void main(String[] args) {
        new ServiceRunner(FraudDetectorService::new).start(1);
    }
    @Override
    public String getConsumerGroup() {
        return FraudDetectorService.class.getSimpleName();
    }

    @Override
    public String getTopic() {
        return "ECOMMERCE_NEW_ORDER";
    }

    public void parse(ConsumerRecord<String, Message<Order>> record) throws InterruptedException, ExecutionException, SQLException {
        System.out.println("----------------------------------------");
        System.out.println("Processing new order, checking for fraud");
        System.out.println(record.key());
        System.out.println(record.value());
        System.out.println(record.partition());
        System.out.println(record.offset());
        var order = record.value().getPayload();
        if (wasProcessed(order.getOrderId())) {
            System.out.println("Order was already processed");
            return;
        }

        Thread.sleep(5000);

        var id = record.value().getId();

        if (isFraud(order)) {
            database.update("INSERT INTO orders (uuid, is_fraud) VALUES (?,true)", order.getOrderId());
            System.out.println("Ordens is a fraud!!!!" + order);
            orderDispatcher.send("ECOMMERCE_ORDER_REJECTED", order.getEmail(), order, id.continueWith(FraudDetectorService.class.getSimpleName()));
            return;
        }


        database.update("INSERT INTO orders (uuid, is_fraud) VALUES (?,false)", order.getOrderId());
        System.out.println("Approved: " + order);
        orderDispatcher.send("ECOMMERCE_ORDER_APPROVED", order.getEmail(), order, id.continueWith(FraudDetectorService.class.getSimpleName()));

    }

    private boolean wasProcessed(String orderId) throws SQLException {
        var resultSet = database.query("SELECT uuid FROM orders WHERE uuid = ? LIMIT 1", orderId);
        return resultSet.next();
    }

    private static boolean isFraud(Order order) {
        return order.getAmount().compareTo(new BigDecimal("4500")) >= 0;
    }
}
