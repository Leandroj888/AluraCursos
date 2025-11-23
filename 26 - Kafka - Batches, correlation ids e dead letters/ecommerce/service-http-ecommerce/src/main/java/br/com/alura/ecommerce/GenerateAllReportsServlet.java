package br.com.alura.ecommerce;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

public class GenerateOrderServlet extends HttpServlet {

    private final KafkaDispatcher<User> userDispatcher = new KafkaDispatcher<>();

    @Override
    public void destroy() {
        super.destroy();
        userDispatcher.close();
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException {
        try {
            for(User user: users){
                userDispatcher.send("USER_GENERATE_READING_REPORT", user.getUuid(), user);
            }
            System.out.println("Send generate report to all users");
            resp.getWriter().println("New Order send Successfully.");
            resp.setStatus(HttpServletResponse.SC_OK);
        } catch (Exception e) {
            throw new ServletException(e);
        }
    }
}
