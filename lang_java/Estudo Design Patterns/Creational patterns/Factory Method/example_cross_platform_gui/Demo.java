package example_cross_platform_gui;

import example_cross_platform_gui.app.Application;
import example_cross_platform_gui.factories.GUIFactory;
import example_cross_platform_gui.factories.MacOSFactory;
import example_cross_platform_gui.factories.WindowsFactory;

/**
 * Demo class. Everything comes together here.
 */
public class Demo {

    /**
     * Application picks the factory type and creates it in run time (usually at
     * initialization stage), depending on the configuration or environment
     * variables.
     */
    private static Application configureApplication() {
        Application app = null;
        GUIFactory factory = null;

        String osName = System.getProperty("os.name").toLowerCase();
        if (osName.contains("mac")) {
            factory = new MacOSFactory();
        } else if (osName.contains("windows")){
            factory = new WindowsFactory();
        }

        if(factory == null){
            System.out.println("A aplicação não tem suporte ao Sistema Operacional '" + osName + "'.");
            return null;
        }

        app = new Application(factory);
        return app;
    }

    public static void main(String[] args) {
        System.out.println("Init sys...");
        
        Application app = configureApplication();
        if(app != null)
            app.paint();

        System.out.println("End sys...");
    }
}