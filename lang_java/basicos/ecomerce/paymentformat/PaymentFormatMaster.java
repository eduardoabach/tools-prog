package ecomerce.paymentformat;

public class PaymentFormatMaster implements PaymentFormat {

    @Override
    public String getName() {
        return "Master Card";
    }

    @Override
    public boolean pay(double pay_value) {
        System.out.println("Pagamento no crédito com Mastercard.");
        return true;
    }
}