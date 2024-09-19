import { Component, OnInit } from '@angular/core';
import { EventoService } from '../../services/evento.service';

@Component({
  selector: 'app-eventos',
  templateUrl: './eventos.component.html',
  styleUrls: ['./eventos.component.css']
})
export class EventosComponent implements OnInit {

  // Arreglo para almacenar los eventos
  eventos: any[] = [];
  
  // Objeto para crear un nuevo evento
  evento: any = {
    nombre: '',
    fecha: '',
    ubicacion: '',
    descripcion: ''
  };

  constructor(private eventoService: EventoService) { }

  ngOnInit() {
    // Llamar a la función para cargar los eventos al iniciar el componente
    this.getEventos();
  }

  // Método para obtener la lista de eventos desde el servicio
  getEventos() {
    this.eventoService.getEventos().subscribe(
      (data: any[]) => {
        this.eventos = data; // Asignar la respuesta a la variable eventos
      },
      (error) => {
        console.error('Error al obtener los eventos', error);
      }
    );
  }

  // Método para crear un nuevo evento usando el servicio
  crearEvento() {
    if (this.evento.nombre && this.evento.fecha) {
      this.eventoService.createEvento(this.evento).subscribe(
        (response) => {
          console.log('Evento creado:', response);
          this.getEventos(); // Actualizar la lista de eventos después de crear uno nuevo
          this.resetForm();  // Limpiar el formulario
        },
        (error) => {
          console.error('Error al crear el evento', error);
        }
      );
    } else {
      console.warn('El nombre y la fecha son obligatorios');
    }
  }

  // Método para limpiar el formulario después de crear un evento
  resetForm() {
    this.evento = {
      nombre: '',
      fecha: '',
      ubicacion: '',
      descripcion: ''
    };
  }
}
