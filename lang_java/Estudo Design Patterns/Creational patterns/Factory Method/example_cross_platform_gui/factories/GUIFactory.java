package example_cross_platform_gui.factories;

import example_cross_platform_gui.buttons.Button;
import example_cross_platform_gui.checkboxes.Checkbox;

/**
 * Abstract factory knows about all (abstract) product types.
 */
public interface GUIFactory {
    Button createButton();
    Checkbox createCheckbox();
}