package br.com.alura.ecommerce;

import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.UUID;
import java.util.concurrent.ExecutionException;

public class CreateUserService {

    private final Connection connection;

    CreateUserService() throws SQLException {
            String url = "jdbc:sqlite:target/users_database.db";
            connection = DriverManager.getConnection(url);
            connection.createStatement().execute("CREATE TABLE IF NOT EXISTS users("+
                    "uuid VARCHAR(200) PRIMARY KEY," +
                    "email VARCHAR(200))");
    }

    public static void main(String[] args) throws SQLException, ExecutionException, InterruptedException {
        var createUserService = new CreateUserService();
        try(var service = new KafkaService<>(
                CreateUserService.class.getSimpleName(),
                "ECOMMERCE_NEW_ORDER",
                createUserService::parse,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Message<Order>> record) throws SQLException {
        var order = record.value().getPayload();
        System.out.println("----------------------------------------");
        System.out.println("Processing new order, checking for new user");
        System.out.println(order);

        if (isNewUser(order.getEmail())){
            insertNewUser(order.getEmail());
        }
    }

    private boolean isNewUser(String email) throws SQLException {
        var exists = connection.prepareStatement("SELECT uuid FROM users " +
                "WHERE email = ? LIMIT 1");
        exists.setString(1, email);
        var resultSet = exists.executeQuery();
        return !resultSet.next();
    }

    private void insertNewUser(String email) throws SQLException {
        var uuid = UUID.randomUUID().toString();
        var insert = connection.prepareStatement("INSERT INTO users (uuid,email) " +
                "VALUES (?,?)");

        insert.setString(1, uuid);
        insert.setString(2, email);

        insert.execute();
        System.out.println("Usuário adicionado: " + uuid + ", " + email);
    }
}
