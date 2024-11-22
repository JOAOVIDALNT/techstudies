import { Component, Input } from '@angular/core';
import Swal from 'sweetalert2';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { TicketService } from 'src/app/services/ticket.service';
import { ITicket } from 'src/app/interfaces/ticket';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-modal-review',
  templateUrl: './modal-review.component.html',
  styleUrls: ['./modal-review.component.css']
})
export class ModalReviewComponent {
  @Input() ticket!: ITicket;

  reviewForm = new FormGroup({
    review: new FormControl('', Validators.compose(
      [Validators.required, Validators.minLength(5), Validators.maxLength(255)]
    ))
  });

  constructor(public activeModal: NgbActiveModal, private ticketService: TicketService, private route: ActivatedRoute, private router: Router) {}

  

  ngOnInit() {
    this.ticketService.findById(this.ticket.id).subscribe((result : ITicket) => {
      this.reviewForm.setValue({
        review: result.review
      })
    }, (error) => {
      Swal.fire('Algo deu errado', error.error.message, 'error')
    })
  }

  reviewUpdate() {
    const ticket: ITicket = this.reviewForm.value as ITicket;
    
    this.ticketService.updateReview(this.ticket.id, ticket).subscribe((result) => {
      
      Swal.fire('Revisado', 'Chamado revisado com sucesso!', 'success')
      .then((reload) => {window.location.reload()});
      this.activeModal.close();
    }, (error) => {
      Swal.fire('Não foi possível revisar', error.error.message, 'error')
      .then((reload) => {window.location.reload()});
      this.activeModal.close();
      
    });
  }

  reload() {
    return window.location.reload();
  }
}
