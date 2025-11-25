package br.com.alura.ecommerce;

import br.com.alura.ecommerce.consumer.KafkaService;
import br.com.alura.ecommerce.dispacher.KafkaDispatcher;
import org.apache.kafka.clients.consumer.ConsumerRecord;

import java.math.BigDecimal;
import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class EmailNewOrderService {
    private KafkaDispatcher<Email> emailDispatcher = new KafkaDispatcher<>();

    public static void main(String[] args) throws ExecutionException, InterruptedException {
        var emailNewOrderService = new EmailNewOrderService();
        try(var service = new KafkaService<>(
                EmailNewOrderService.class.getSimpleName(),
                "ECOMMERCE_NEW_ORDER",
                emailNewOrderService::parse,
                new HashMap<>())) {
            service.run();
        }
    }

    private void parse(ConsumerRecord<String, Message<Order>> record) throws InterruptedException, ExecutionException {
        Message<Order> message = record.value();

        System.out.println("----------------------------------------");
        System.out.println("Processing new order, preparing email");
        System.out.println(record.key());
        System.out.println(message);
        System.out.println(record.partition());
        System.out.println(record.offset());

        var id = message.getId().continueWith(EmailNewOrderService.class.getSimpleName());
        var email = message.getPayload().getEmail();

        var body = "Thank you for your order! We are processing your order!";
        var emailObject = new Email(email,  body);
        emailDispatcher.send("ECOMMERCE_SEND_EMAIL", email, emailObject, id);
    }
}
