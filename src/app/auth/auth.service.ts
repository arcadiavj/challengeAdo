import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private readonly validUser = { email: 'user@demo.com', password: '123456' };

  login(email: string, password: string): Observable<boolean> {
    if (email === this.validUser.email && password === this.validUser.password) {
      localStorage.setItem('isLoggedIn', 'true');
      return of(true);
    } else {
      return of(false);
    }
  }

  isAuthenticated(): boolean {
    return localStorage.getItem('isLoggedIn') === 'true';
  }

  logout(): void {
    localStorage.removeItem('isLoggedIn');
  }
}

