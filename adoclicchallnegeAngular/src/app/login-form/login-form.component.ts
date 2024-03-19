import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../auth/auth.service'; // Ruta de tu servicio de autenticación

@Component({
  selector: 'app-login-form',
  templateUrl: './login-form.component.html',
  styleUrls: ['./login-form.component.css']
})
export class LoginFormComponent implements OnInit {
  loginForm!: FormGroup;
  title = 'Login Form';
  detail = 'Angular Demo'


  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    // Configurar el formulario usando Reactive Forms
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(6)]]
    });
  }

  onSubmit(): void {
    if (this.loginForm.valid) {
      const email = this.loginForm.value.email;
      const password = this.loginForm.value.password;
      this.authService.login(email, password).subscribe(
        () => {
          if (email === 'user@demo.com' && password === '123456') {
            // Redirect to Product List page
            console.log({email,password});
            this.router.navigate(['product-list']);
          }
        },
        error => {
          console.log(error);
        }
      );
    }
  }
}
