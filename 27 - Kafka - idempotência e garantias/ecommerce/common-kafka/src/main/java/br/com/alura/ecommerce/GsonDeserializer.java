package br.com.alura.ecommerce;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import org.apache.kafka.common.serialization.Deserializer;

import java.util.Map;

public class GsonDeserializer implements Deserializer<Message> {
    private final Gson gson = new GsonBuilder().registerTypeAdapter(Message.class, new MessageAdapter()).create();

    @Override
    public Message deserialize(String s, byte[] data) {
        return gson.fromJson(new String(data), Message.class);
    }

    /*
    private Class<T> type;
    public static final String TYPE_CONFIG = "type_config";
    @Override
    public void configure(Map<String, ?> configs, boolean isKey) {
        var typeName = String.valueOf(configs.get(TYPE_CONFIG));
        try {
            type = (Class<T>) Class.forName(typeName);
        } catch (ClassNotFoundException e) {
            throw new RuntimeException("Type for deserialization does not exist en the classpath",e);
        }
    }
    @Override
    public T deserialize(String s, byte[] data) {
        return gson.fromJson(new String(data), type);
    }
    */
}
