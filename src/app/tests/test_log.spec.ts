import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { LoginComponent } from './login.component';

describe('LoginComponent', () => {
  let component: LoginComponent;
  let fixture: ComponentFixture<LoginComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ LoginComponent ],
      imports: [ ReactiveFormsModule, FormsModule ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('should validate email field', () => {
    const email = component.loginForm.controls['email'];
    email.setValue('invalid-email'); // Set an invalid email format
    expect(email.valid).toBeFalsy(); // Expect validation to fail

    email.setValue('valid@email.com'); // Set a valid email format
    expect(email.valid).toBeTruthy(); // Expect validation to pass
  });

  it('should validate password field', () => {
    const password = component.loginForm.controls['password'];
    password.setValue('123'); // Set a password with less than 6 characters
    expect(password.valid).toBeFalsy(); // Expect validation to fail

    password.setValue('password123'); // Set a password with 6 or more characters
    expect(password.valid).toBeTruthy(); // Expect validation to pass
  });

  // Add more tests as needed
});
