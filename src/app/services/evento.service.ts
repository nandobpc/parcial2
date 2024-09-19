import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EventoService {

  private apiUrl = 'http://localhost/api/controllers/EventoController.php';

  constructor(private http: HttpClient) { }

  // Método para obtener todos los eventos
  getEventos(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  // Método para crear un nuevo evento
  createEvento(evento: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, evento);
  }
}
