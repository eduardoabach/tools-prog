package ecomerce.app;

import ecomerce.app.ShoppingFactory;
import ecomerce.app.PaymentFactory;
import ecomerce.app.LogisticFactory;

public class Application {

    public Application() {
        ShoppingFactory shopping = new ShoppingFactory();
        LogisticFactory logistic = new LogisticFactory();

        String toDo = null;
        boolean exitApp = false;
        while(exitApp == false){
            toDo = askWhatToDo();
            // if(toDo == 'show'){
            //     shopping.showCatalog();
            // } else if(toDo == 'go to product'){
            //     shopping.showProduct();
            // } else if(toDo == 'buy product'){
            //     shopping.buyProduct();
            // } else if(toDo == 'pay'){
                
                PaymentFactory payment = new PaymentFactory(500);
                boolean resultPgOk = payment.pay();
                System.out.println("Terminou de pagar...");
                // if(resultPgOk){
                //     logistic.send(shopping.getCart());
                // }
            // }    
        }
    }

    private String askWhatToDo(){
        return null;
    }
}

