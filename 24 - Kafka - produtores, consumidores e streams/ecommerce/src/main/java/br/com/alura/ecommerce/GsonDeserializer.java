package br.com.alura.ecommerce;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import org.apache.kafka.common.serialization.Deserializer;
import org.apache.kafka.common.serialization.StringDeserializer;

import java.util.Map;

public class GsonDeserializer<T>  implements Deserializer<T> {
    public static final String TYPE_CONFIG = "type_config";
    private final Gson gson = new GsonBuilder().create();
    private Class<T> type;

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
}
