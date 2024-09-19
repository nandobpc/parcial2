import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ParticipanteService {

  private apiUrl = 'http://localhost/api/controllers/ParticipanteController.php';

  constructor(private http: HttpClient) { }

  // Método para obtener todos los participantes
  getParticipantes(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  // Método para crear un nuevo participante
  createParticipante(participante: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, participante);
  }
}
