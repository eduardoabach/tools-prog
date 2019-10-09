package ecomerce.app;

import java.util.List;
import java.util.ArrayList;
import ecomerce.paymentformat.*;
import ecomerce.exception.*;

import static ecomerce.app.Util.*;

public class PaymentFactory {
    private List<PaymentFormat> listPaymentFormat;
    private double amount;
    private double paid;

    private Integer stateOptPayFormat;
    private Double statePayValue;

    public PaymentFactory(double amount) {
        this.setAmount(amount);
        this.setPaid(0);
        this.loadPymentFormat();
    }

    private void loadPymentFormat(){
        this.listPaymentFormat = new ArrayList<PaymentFormat>();
        this.listPaymentFormat.add(new PaymentFormatDebit());
        this.listPaymentFormat.add(new PaymentFormatMaster());
    }

    public void setAmount(double amount){
        this.amount = amount;
    }

    public void setPaid(double paid){
        this.paid = paid;
    }

    public double getDebtResidualValue(){
        double diff = amount - paid;
        return (diff > 0) ? diff : 0;
    }

    public void clearState(){
        this.stateOptPayFormat = null;
        this.statePayValue = null;
    }

    public void showState(){
        if(this.statePayValue != null)
            System.out.println("Valor a pagar: " + this.statePayValue);
        else
            System.out.println("Valor a pagar: " + this.getDebtResidualValue());
            
        if(this.stateOptPayFormat != null)
            System.out.println("Forma de Pagamento: "+ listPaymentFormat.get(this.stateOptPayFormat).getName());
    }

    public void addPaidValue(double paid){
        this.paid += paid;
    }

    public boolean pay(){
        clearScreen();
        System.out.println("#Pagar");
        System.out.println("");

        while(this.getDebtResidualValue() > 0){
            try {
                this.clearState();
                this.makeSinglePayment();
            } catch (CancelPaymentException e) {
                break;
            }
        }

        System.out.println("Processo de pagamento finalizado! [Enter] para continuar...");
        String inputString = getUserTerminalInput();
        return (this.getDebtResidualValue() <= 0);
    }

    private void makeSinglePayment() throws CancelPaymentException{
        this.stateOptPayFormat = this.getOptPaymentFormat();
        this.statePayValue = (this.askIsParcialPay()) ? this.getPaymentValue() : this.getDebtResidualValue();
        
        boolean successPayByPaymentFormat = listPaymentFormat.get(this.stateOptPayFormat).pay(this.statePayValue);
        if(successPayByPaymentFormat){
            this.addPaidValue(this.statePayValue);
            
            clearScreen();
            System.out.println("Pagamento de " + this.statePayValue + " realizado com sucesso! [Enter] para continuar...");
            String inputString = getUserTerminalInput();
        }
    }

    public boolean askIsParcialPay(){
        Boolean opt = null;
        while(opt == null){
            clearScreen();
            this.showState();
            System.out.println("Gostaria de pagar esse valor integral?");
            System.out.println("S - Sim / N - Não");
            String inputString = getUserTerminalInput();
            
            if(inputString.equalsIgnoreCase("S"))
                opt = false;
            else if(inputString.equalsIgnoreCase("N"))
                opt = true;
                
        }
        return opt;
    }

    public int getOptPaymentFormat() throws CancelPaymentException{
        Integer opt = null;
        while(opt == null){
            clearScreen();
            this.showState();
            System.out.println("Escolha a forma de pagamento, digitando o número:");
            System.out.print(this.getListOptPaymentFormat());
            System.out.println("99 - Cancelar compra");
            
            String inputString = getUserTerminalInput();
            opt = Integer.parseInt(inputString);

            if(opt == 99){
                throw new CancelPaymentException("Compra cancelada.");

            }

            if(opt < 0 || listPaymentFormat.size() <= opt || listPaymentFormat.get(opt) == null){
                opt = null;
                System.out.println("Opção de pagamento inválida");
            }
        }

        return opt;
    }

    public String getListOptPaymentFormat(){
        String list = "";
        for(int i = 0; i < listPaymentFormat.size(); i++){
            list += i + " - " + listPaymentFormat.get(i).getName() + "\n";
        }
        return list;
    }

    public double getPaymentValue(){
        double pay_value = 0;
        while(pay_value <= 0){
            clearScreen();
            this.showState();
            System.out.println("Informe o valor que deseja pagar:");
            String inputString = getUserTerminalInput();

            pay_value = Double.parseDouble(inputString);
            if(pay_value <= 0){
                pay_value = 0;
                System.out.println("Valor de pagamento inválido");
            }
        }

        return pay_value;
    }

}
