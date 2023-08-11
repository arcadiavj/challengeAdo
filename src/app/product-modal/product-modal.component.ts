import { Component, Input } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-product-modal',
  templateUrl: './product-modal.component.html',
  styleUrls: ['./product-modal.component.css']
})
export class ProductModalComponent {
  @Input() product: any; // Recibir datos del producto desde el componente que abre el modal

  constructor(public activeModal: NgbActiveModal) {}


  // Agrega más lógica aquí si es necesario
}
