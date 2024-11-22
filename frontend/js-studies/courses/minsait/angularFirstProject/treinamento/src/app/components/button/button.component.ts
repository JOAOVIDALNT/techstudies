import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-button',
  templateUrl: './button.component.html',
  styleUrls: ['./button.component.css']
})
export class ButtonComponent {
  @Input() color: string = 'dark'; //define que teremos um atributo no botão que caso não seja definido tem por padrão o tema dark
  @Input() size: string = '';
  @Input() disabled: boolean = false;
}
