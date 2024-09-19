import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class InscripcionService {

  private apiUrl = 'http://localhost/api/controllers/InscripcionController.php';

  constructor(private http: HttpClient) { }

  // Método para obtener todas las inscripciones
  getInscripciones(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  // Método para crear una nueva inscripción
  createInscripcion(inscripcion: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, inscripcion);
  }
}
