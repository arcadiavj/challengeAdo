import { TestBed } from '@angular/core/testing';
import { AuthService } from './auth.service';

describe('AuthService', () => {
  let service: AuthService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AuthService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('should authenticate user with correct credentials', () => {
    const isAuthenticated = service.authenticate('user@demo.com', '123456');
    expect(isAuthenticated).toBeTruthy(); // Expect authentication to pass with correct credentials
  });

  it('should not authenticate user with incorrect credentials', () => {
    const isAuthenticated = service.authenticate('user@demo.com', 'wrongpassword');
    expect(isAuthenticated).toBeFalsy(); // Expect authentication to fail with incorrect password
  });

  // Add more tests as needed
});
