package br.com.alura.ecommerce;

import br.com.alura.ecommerce.database.LocalDatabase;

import java.io.Closeable;
import java.io.IOException;
import java.sql.SQLException;

public class OrdersDatabase implements Closeable {
    private LocalDatabase database;

    public OrdersDatabase() throws SQLException {
        this.database = new LocalDatabase("order_database");

        this.database.createIfNotExists (
                "CREATE TABLE IF NOT EXISTS orders("+
                        "uuid VARCHAR(200) PRIMARY KEY)"
        );
    }

    private boolean wasProcessed(String orderId) throws SQLException {
        var resultSet = database.query("SELECT uuid FROM orders WHERE uuid = ? LIMIT 1", orderId);
        return resultSet.next();
    }

    public boolean save(String orderId) throws SQLException {
        if (wasProcessed(orderId)) {
            return false;
        }

        this.database.update("INSERT INTO orders (uuid) VALUES (?)", orderId);
        return true;
    }

    @Override
    public void close() throws IOException {
        try {
            database.close();
        } catch (SQLException e) {
            throw new IOException(e);
        }
    }
}
