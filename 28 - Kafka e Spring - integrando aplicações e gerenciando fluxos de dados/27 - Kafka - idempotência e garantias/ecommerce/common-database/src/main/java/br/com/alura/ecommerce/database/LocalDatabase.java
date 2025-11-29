package br.com.alura.ecommerce.database;

import java.sql.*;

public class LocalDatabase {

    private final Connection connection;

    public LocalDatabase(String name) throws SQLException {
        String url = "jdbc:sqlite:target/" + name + ".db";
        connection = DriverManager.getConnection(url);
    }

    public void createIfNotExists(String sql) throws SQLException {
        connection.createStatement().execute(sql);
    }

    public Connection getConnection() {
        return connection;
    }

    public boolean update(String statement, String ... params) throws SQLException {
        return prepare(statement, params).execute();
    }

    public ResultSet query(String query, String ... params) throws SQLException {
        return prepare(query, params).executeQuery();
    }

    private PreparedStatement prepare(String query, String[] params) throws SQLException {
        var prepareStatement = connection.prepareStatement(query);
        for(int i = 0; i< params.length; i++) {
            prepareStatement.setString(i+1, params[i]);
        }
        return prepareStatement;
    }

    public void close() throws SQLException {
        connection.close();
    }
}
