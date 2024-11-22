import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { NgbModal, NgbModalOptions } from '@ng-bootstrap/ng-bootstrap';
import { ModalTicketComponent } from 'src/app/components/modal-ticket/modal-ticket.component';
import Swal from 'sweetalert2';
import { ITicket } from 'src/app/interfaces/ticket';
import { TicketService } from 'src/app/services/ticket.service';
import { ModalReviewComponent } from 'src/app/components/modal-review/modal-review.component';
import { ActivatedRoute, Router } from '@angular/router';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCircleInfo, faCircleCheck, faBan } from '@fortawesome/free-solid-svg-icons'

@Component({
  selector: 'app-tickets',
  templateUrl: './tickets.component.html',
  styleUrls: ['./tickets.component.css']
})
export class TicketsComponent {
  tickets: ITicket[] = [];

  public paginaAtual = 1;

  constructor(private ticketService: TicketService,
    private modalService: NgbModal,
    private router: Router,
    private route: ActivatedRoute) { 
     }


  openModalTicket(ticket: ITicket) {
    const modalRef = this.modalService.open(ModalTicketComponent);
    modalRef.componentInstance.ticket = ticket;
  }

  openModalReview(ticket: ITicket) {
    let ngbModalOptions: NgbModalOptions = {
      backdrop: 'static',
      keyboard: false
    }

    const modalRef = this.modalService.open(ModalReviewComponent, ngbModalOptions);
    modalRef.componentInstance.ticket = ticket;
  }

  ngOnInit() {
    this.ticketService.findByStatus("PENDENTE").subscribe(result => { this.tickets = result });
  }

  statusSolve(id: number, ticket: ITicket) {
    this.ticketService.findById(id).subscribe((result) => {
      Swal.fire({
        title: 'Confirme a resolução do chamado',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Resolvido',
        denyButtonText: 'Não Resolvido'
      }).then((result => {
        if (result.isConfirmed) {
          ticket.status = "RESOLVIDO";
          this.ticketService.updateStatus(id, ticket).subscribe((result) => {
            Swal.fire('Resolvido!', 'Chamado resolvido, não esqueça de revisar', 'success')
            this.openModalReview(ticket)
          });
        } else if (result.isDenied) {
          Swal.fire('Cuidado!', 'Não é possível reabrir chamados depois de resolvidos', 'warning')
        }
      }))
    })
  }

  statusCancel(id: number, ticket: ITicket) {
    this.ticketService.findById(id).subscribe((result) => {
      Swal.fire({
        title: 'Tem certeza que deseja cancelar o chamado?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: 'Não'
      }).then((result => {
        if (result.isConfirmed) {
          ticket.status = "CANCELADO";
          this.ticketService.updateStatus(id, ticket).subscribe((result) => {
            Swal.fire('Cancelado!', 'Chamado cancelado com sucesso.', 'success')
              .then((reload) => { window.location.reload() });
          });
        } else if (result.isDenied) {
          Swal.fire('Cuidado!', 'Não é possível reabrir chamados depois de cancelado', 'warning');
        }
      }))
    })
  }

  circleInfo = faCircleInfo;
  circleCheck = faCircleCheck;
  ban = faBan;
}



