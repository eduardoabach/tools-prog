package ecomerce.paymentformat;

public class PaymentFormatDebit implements PaymentFormat {

    @Override
    public String getName() {
        return "Débito";
    }

    @Override
    public boolean pay(double pay_value) {
        System.out.println("Pagamento no débito.");
        return true;
    }
}