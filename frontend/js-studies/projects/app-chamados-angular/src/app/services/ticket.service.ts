import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ITicket } from '../interfaces/ticket';


@Injectable({
  providedIn: 'root'
})
export class TicketService {
  api = "http://localhost:8080/api/v1";
  endpoint = "tickets";

  constructor(private http: HttpClient) {}

  createTicket(ticket: ITicket) {
    return this.http.post(`${this.api}/${this.endpoint}`, ticket);
  }

  findAllTickets() {
    return this.http.get<ITicket[]>(`${this.api}/${this.endpoint}`);
  }

  findById(id: number) {
    return this.http.get<ITicket>(`${this.api}/${this.endpoint}/${id}`);
  }

  findByStatus(status: string) {
    return this.http.get<ITicket[]>(`${this.api}/${this.endpoint}/status/${status}`)
  }

  updateStatus(id: number, ticket: ITicket) {
    return this.http.put<ITicket>(`${this.api}/${this.endpoint}/status/${id}`, ticket)
  }

  updateReview(id: number, ticket: ITicket) {
    return this.http.put<ITicket>(`${this.api}/${this.endpoint}/review/${id}`, ticket)
  }

}
