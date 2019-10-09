package ecomerce.paymentformat;

public interface PaymentFormat {
    String getName();
    boolean pay(double pay_value);
}