package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.UUID;
import java.util.concurrent.ExecutionException;

public class BatchSendMessageService {
    private final Connection connection;
    private final KafkaDispatcher<User> userDispatcher = new KafkaDispatcher<>();

    BatchSendMessageService() throws SQLException {
        String url = "jdbc:sqlite:target/users_database.db";
        connection = DriverManager.getConnection(url);
        connection.createStatement().execute("CREATE TABLE IF NOT EXISTS users("+
                "uuid VARCHAR(200) PRIMARY KEY," +
                "email VARCHAR(200))");
    }

    public static void main(String[] args) throws SQLException, ExecutionException, InterruptedException {
        var batchSendMessageService = new BatchSendMessageService();
        try(var service = new KafkaService<>(
                BatchSendMessageService.class.getSimpleName(),
                "ECOMMERCE_SEND_MESSAGE_TO_ALL_USERS",
                batchSendMessageService::parse,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Message<String>> record) throws SQLException {
        var message = record.value();
        var payload = message.getPayload();
        var id = message.getId();
        System.out.println("----------------------------------------");
        System.out.println("Processing new batching");
        System.out.println("Topic: " + payload);

        for(User user: getAllUsers()){
            userDispatcher.sendAsync(payload, user.getUuid(), user, id.continueWith(BatchSendMessageService.class.getSimpleName()));
            System.out.println("Acho que Enviei para " + user);
        }

    }

    private List<User> getAllUsers() throws SQLException {
        var results = connection.prepareStatement("SELECT uuid FROM users").executeQuery();
        List<User> users = new ArrayList<>();
        while(results.next()) {
            users.add(new User(results.getString(1)));
        }
        return users;
    }
}

