import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ITicket } from 'src/app/interfaces/ticket';
import { TicketService } from 'src/app/services/ticket.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-create-ticket',
  templateUrl: './create-ticket.component.html',
  styleUrls: ['./create-ticket.component.css']
})
export class CreateTicketComponent {


  ticketForm = new FormGroup({
    
    name: new FormControl('', Validators.compose([
      Validators.required, Validators.minLength(4), Validators.maxLength(50)
    ]
    )),
    sector: new FormControl('', Validators.required),
    problem: new FormControl('', Validators.required),
    description: new FormControl('', Validators.compose([
      Validators.required, Validators.minLength(10), Validators.maxLength(255)
    ]))
  })

  

  constructor(private ticketService: TicketService, private router: Router) {}
  


  create() {
    const ticket: ITicket = this.ticketForm.value as ITicket;
    this.ticketService.createTicket(ticket).subscribe((result) => {
      this.ticketForm.reset();
      Swal.fire(
        'Cadastrado!',
        'Chamado cadastrado com sucesso',
        'success'
      ).then((reload) => {window.location.reload()});
    }, (error) => {
      Swal.fire(
        'Não foi possível cadastrar o chamado',
        error.error.message,
        'error'
      ).then((reload) => {window.location.reload()});
    }); this.router.navigate(['/'])

  }

}
