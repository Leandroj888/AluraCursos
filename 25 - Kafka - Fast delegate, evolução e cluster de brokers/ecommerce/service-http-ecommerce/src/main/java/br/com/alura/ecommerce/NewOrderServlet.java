package br.com.alura.ecommerce;

import jakarta.servlet.ServletConfig;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.math.BigDecimal;
import java.util.UUID;

public class NewOrderServlet extends HttpServlet {

    private final KafkaDispatcher<Order> orderDispatcher = new KafkaDispatcher<>();
    private final KafkaDispatcher<Email> emailDispatcher = new KafkaDispatcher<>();

    @Override
    public void destroy() {
        super.destroy();
        orderDispatcher.close();
        emailDispatcher.close();
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException {
        try {
            var email = req.getParameter("email");
            var amount = new BigDecimal(req.getParameter("amount"));
            //var email = Math.random() + "@email.com";
            //var userId = UUID.randomUUID().toString();
            var orderId = UUID.randomUUID().toString();
            //var amount = BigDecimal.valueOf(Math.random() * 5000 + 1);

            //var order = new Order(userId, orderId, amount, email);
            var order = new Order(orderId, amount, email);
            orderDispatcher.send("ECOMMERCE_NEW_ORDER", email, order);
            var body = "Thank you for your order! We are processing your order!";
            var emailObject = new Email(email,  body);
            emailDispatcher.send("ECOMMERCE_SEND_EMAIL", email, emailObject);

            System.out.println("New Order send Successfully.");
            resp.getWriter().println("New Order send Successfully.");
            resp.setStatus(HttpServletResponse.SC_OK);
        } catch (Exception e) {
            throw new ServletException(e);
        }
    }
}
