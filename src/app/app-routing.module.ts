import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginFormComponent } from './login-form/login-form.component';
import { ProductListComponent } from './product-list/product-list.component'; // Agrega la importación de ProductListComponent

const routes: Routes = [
 { path: '', redirectTo: 'login', pathMatch: 'full' }, // Ruta por defecto redirige a 'login'
  { path: 'login', component: LoginFormComponent },
  { path: 'product-list', component: ProductListComponent }, // Agrega esta línea para la ruta de ProductListComponent
  // Agrega otras rutas según sea necesario
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
