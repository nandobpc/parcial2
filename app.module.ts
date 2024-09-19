import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { EventosComponent } from './components/eventos/eventos.component';
import { ParticipantesComponent } from './components/participantes/participantes.component';
import { InscripcionesComponent } from './components/inscripciones/inscripciones.component';

import { EventoService } from './services/evento.service';
import { ParticipanteService } from './services/participante.service';
import { InscripcionService } from './services/inscripcion.service';

@NgModule({
  declarations: [
    AppComponent,
    EventosComponent,
    ParticipantesComponent,
    InscripcionesComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    EventoService,
    ParticipanteService,
    InscripcionService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
