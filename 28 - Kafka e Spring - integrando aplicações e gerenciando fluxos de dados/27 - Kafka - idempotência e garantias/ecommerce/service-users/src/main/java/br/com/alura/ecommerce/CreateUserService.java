package br.com.alura.ecommerce;

import br.com.alura.ecommerce.consumer.ConsumerService;
import br.com.alura.ecommerce.consumer.KafkaService;
import br.com.alura.ecommerce.consumer.ServiceProvider;
import br.com.alura.ecommerce.consumer.ServiceRunner;
import br.com.alura.ecommerce.database.LocalDatabase;
import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.UUID;
import java.util.concurrent.ExecutionException;

public class CreateUserService implements ConsumerService<Order> {
    private final LocalDatabase database;

    /*
        private final Connection connection;
    
        CreateUserService() throws SQLException {
                String url = "jdbc:sqlite:target/users_database.db";
                connection = DriverManager.getConnection(url);
                connection.createStatement().execute("CREATE TABLE IF NOT EXISTS users("+
                        "uuid VARCHAR(200) PRIMARY KEY," +
                        "email VARCHAR(200))");
        }
    */
    CreateUserService() throws SQLException {
        this.database = new LocalDatabase("users_database");

        this.database.createIfNotExists (
                "CREATE TABLE IF NOT EXISTS users("+
                "uuid VARCHAR(200) PRIMARY KEY," +
                "email VARCHAR(200))"
        );
    }
    public static void main(String[] args) {
        new ServiceRunner(CreateUserService::new).start(1);
    }

/*
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
*/
    @Override
    public String getConsumerGroup() {
        return CreateUserService.class.getSimpleName();
    }

    @Override
    public String getTopic() {
        return "ECOMMERCE_NEW_ORDER";
    }

    public void parse(ConsumerRecord<String, Message<Order>> record) throws SQLException {
        var order = record.value().getPayload();
        System.out.println("----------------------------------------");
        System.out.println("Processing new order, checking for new user");
        System.out.println(order);

        if (isNewUser(order.getEmail())){
            insertNewUser(order.getEmail());
        }
    }

    private boolean isNewUser(String email) throws SQLException {
        var resultSet = database.query("SELECT uuid FROM users WHERE email = ? LIMIT 1", email);
        return !resultSet.next();
    }

    private void insertNewUser(String email) throws SQLException {
        var uuid = UUID.randomUUID().toString();
        database.update("INSERT INTO users (uuid,email) VALUES (?,?)", uuid, email);
        System.out.println("Usuário adicionado: " + uuid + ", " + email);
    }
}
