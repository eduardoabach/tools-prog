package ecomerce.app;

import java.util.Scanner;

public class Util{

    public static void clearScreen() {  
        System.out.print("\033[H\033[2J");  
        System.out.flush();  
    }  

    public static String getUserTerminalInput() {  
        Scanner scanner = new Scanner(System.in);
        return scanner.nextLine();        
    }  
}



