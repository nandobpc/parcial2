import { Component, OnInit } from '@angular/core';
import { ParticipanteService } from '../../services/participante.service';

@Component({
  selector: 'app-participantes',
  templateUrl: './participantes.component.html',
  styleUrls: ['./participantes.component.css']
})
export class ParticipantesComponent implements OnInit {

  // Arreglo para almacenar los participantes
  participantes: any[] = [];

  // Objeto para crear un nuevo participante
  participante: any = {
    nombre: '',
    apellido: '',
    email: '',
    telefono: ''
  };

  constructor(private participanteService: ParticipanteService) { }

  ngOnInit() {
    // Cargar la lista de participantes al iniciar el componente
    this.getParticipantes();
  }

  // Método para obtener la lista de participantes desde el servicio
  getParticipantes() {
    this.participanteService.getParticipantes().subscribe(
      (data: any[]) => {
        this.participantes = data; // Asignar la respuesta a la variable participantes
      },
      (error) => {
        console.error('Error al obtener los participantes', error);
      }
    );
  }

  // Método para crear un nuevo participante usando el servicio
  crearParticipante() {
    if (this.participante.nombre && this.participante.apellido) {
      this.participanteService.createParticipante(this.participante).subscribe(
        (response) => {
          console.log('Participante creado:', response);
          this.getParticipantes(); // Actualizar la lista de participantes después de crear uno nuevo
          this.resetForm();  // Limpiar el formulario
        },
        (error) => {
          console.error('Error al crear el participante', error);
        }
      );
    } else {
      console.warn('El nombre y apellido son obligatorios');
    }
  }

  // Método para limpiar el formulario después de crear un participante
  resetForm() {
    this.participante = {
      nombre: '',
      apellido: '',
      email: '',
      telefono: ''
    };
  }
}
