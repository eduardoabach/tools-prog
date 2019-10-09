package example_cross_platform_gui.factories;

import example_cross_platform_gui.buttons.Button;
import example_cross_platform_gui.buttons.MacOSButton;
import example_cross_platform_gui.checkboxes.Checkbox;
import example_cross_platform_gui.checkboxes.MacOSCheckbox;

/**
 * Each concrete factory extends basic factory and responsible for creating
 * products of a single variety.
 */
public class MacOSFactory implements GUIFactory {

    @Override
    public Button createButton() {
        return new MacOSButton();
    }

    @Override
    public Checkbox createCheckbox() {
        return new MacOSCheckbox();
    }
}