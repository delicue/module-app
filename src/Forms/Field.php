<?php 

namespace App\Forms;

class Field {
    private string $type;
    private string $name;
    private ?string $label;
    private array $attributes;

    public function __construct(string $type, string $name, ?string $label = null, array $attributes = []) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->attributes = $attributes;
    }

    public function render(): string {
        $attrString = '';
        foreach ($this->attributes as $key => $value) {
            $attrString .= htmlspecialchars($key) . '="' . htmlspecialchars($value) . '" ';
        }

        $labelHtml = $this->label ? '<label for="' . htmlspecialchars($this->name) . '">' . htmlspecialchars($this->label) . '</label>' : '';

        return sprintf(
            '%s<input type="%s" name="%s" id="%s" %s/>',
            $labelHtml,
            htmlspecialchars($this->type),
            htmlspecialchars($this->name),
            htmlspecialchars($this->name),
            trim($attrString)
        );
    }
}