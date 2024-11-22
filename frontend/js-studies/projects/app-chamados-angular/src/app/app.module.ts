import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { TicketsComponent } from './pages/tickets/tickets.component';
import { ModalTicketComponent } from './components/modal-ticket/modal-ticket.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { ModalReviewComponent } from './components/modal-review/modal-review.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { CreateTicketComponent } from './pages/create-ticket/create-ticket.component';
import { FindTicketComponent } from './pages/find-ticket/find-ticket.component';



@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    TicketsComponent,
    ModalTicketComponent,
    ModalReviewComponent,
    CreateTicketComponent,
    FindTicketComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    NgxPaginationModule,
    FontAwesomeModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
