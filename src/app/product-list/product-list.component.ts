import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ProductService } from '../services/product.service'; // Asegúrate de importar el servicio de productos correcto
import { Router } from '@angular/router';
import { AuthService } from '../auth/auth.service';
import { MatTableDataSource } from '@angular/material/table';

import { ProductModalComponent } from '../product-modal/product-modal.component';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {
  products: any[] = []; // Aquí deberías usar la interfaz o clase de productos según corresponda
  displayedColumns: string[] = ['id','title', 'category','price','detalle']; // Agrega más columnas si es necesario
  selectedCategory: string = '';
  productList: any[] = [];
  dataSource: MatTableDataSource<any>;
  categories: string[] = [];
  maxItems: number = 10;


  constructor(
    private productService: ProductService, // Inyecta el servicio de productos
    private modalService: NgbModal, // Importa MatDialog si planeas usar modales
    private router:Router,
    private authService:AuthService,
    //private modalService: NgbModal
  ) {
    this.dataSource = new MatTableDataSource(this.productList);
  }

  ngOnInit(): void {
    this.loadCategories();
    this.loadProducts();
    this.applyFilter();
  }

  loadProducts(): void {
    this.productService.getProducts().subscribe(
      (data: any) => {
        console.log(data);
        this.products = data; // Asigna los productos obtenidos de la API
      },
      error => {
        console.log(error); // Maneja posibles errores
      }
    );
  }

  loadProductsByCategory(category:string): void {
    this.productService.getProductsByCategory(category).subscribe(
      (data: any) => {
        console.log(data);
        this.products = data; // Asigna los productos obtenidos de la API
      },
      error => {
        console.log(error); // Maneja posibles errores
      }
    );
  }

  openProductDetails(product: any): void {
    const modalRef = this.modalService.open(ProductModalComponent);
    console.log(product);
    modalRef.componentInstance.product = product;
  }

 applyFilter() {
  let filteredData = this.productList;
    console.log(this.selectedCategory.trim().toLowerCase());
    if (this.selectedCategory) {
      this.loadProductsByCategory(this.selectedCategory);
      filteredData = filteredData.filter(product => product.category === this.selectedCategory);
      console.log(filteredData);
    }

    this.dataSource.data = filteredData.slice(0, this.maxItems);
    this.dataSource.filter = this.selectedCategory.trim().toLowerCase();
    this.loadProducts();
  }

  get uniqueCategories() {
    console.log(...new Set(this.productList.map(product => product.category)));
    return [...new Set(this.productList.map(product => product.category))];
  }

  loadCategories() {
    this.productService.getCategories().subscribe(
      (data: string[]) => {
        console.log(data);
        this.categories = data;
      },
      error => {
        console.error('Error fetching categories:', error);
      }
    );
  }


  logout() {
    this.authService.logout(); // Llama a tu función de cierre de sesión en AuthService
    this.router.navigate(['login']); // Redirige a la página de inicio de sesión
  }
}
