package example_cross_platform_gui.factories;

import example_cross_platform_gui.buttons.Button;
import example_cross_platform_gui.buttons.WindowsButton;
import example_cross_platform_gui.checkboxes.Checkbox;
import example_cross_platform_gui.checkboxes.WindowsCheckbox;

/**
 * Each concrete factory extends basic factory and responsible for creating
 * products of a single variety.
 */
public class WindowsFactory implements GUIFactory {

    @Override
    public Button createButton() {
        return new WindowsButton();
    }

    @Override
    public Checkbox createCheckbox() {
        return new WindowsCheckbox();
    }
}