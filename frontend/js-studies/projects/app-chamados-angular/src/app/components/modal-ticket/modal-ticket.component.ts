import { Component, Input } from '@angular/core';
import { tick } from '@angular/core/testing';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ITicket } from 'src/app/interfaces/ticket';
import { TicketService } from 'src/app/services/ticket.service';

@Component({
  selector: 'app-modal-ticket',
  templateUrl: './modal-ticket.component.html',
  styleUrls: ['./modal-ticket.component.css']
})
export class ModalTicketComponent {
  @Input() ticket!: ITicket;


  
  statusForm = new FormGroup({
    status: new FormControl()
  });

  constructor(public activeModal: NgbActiveModal, private ticketService: TicketService, private router: Router, private route: ActivatedRoute) {}





}
