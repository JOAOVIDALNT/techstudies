import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TicketsComponent } from './pages/tickets/tickets.component';
import { CreateTicketComponent } from './pages/create-ticket/create-ticket.component';
import { FindTicketComponent } from './pages/find-ticket/find-ticket.component';

const routes: Routes = [
  {path: 'adminendpoint', component: TicketsComponent},
  {path: '', component: CreateTicketComponent},
  {path: 'find', component: FindTicketComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
