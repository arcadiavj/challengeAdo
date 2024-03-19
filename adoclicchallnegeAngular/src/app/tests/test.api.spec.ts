import { TestBed } from '@angular/core/testing';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';
import { ApiService } from './api.service';

describe('ApiService', () => {
  let service: ApiService;
  let httpMock: HttpTestingController;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [ HttpClientTestingModule ],
      providers: [ ApiService ]
    });
    service = TestBed.inject(ApiService);
    httpMock = TestBed.inject(HttpTestingController);
  });

  afterEach(() => {
    httpMock.verify();
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('should fetch products from the API', () => {
    const mockData = [{ id: 1, name: 'Product 1' }, { id: 2, name: 'Product 2' }];
    service.getProducts().subscribe((data) => {
      expect(data.length).toBe(2); // Expect to receive 2 products from the API
      expect(data).toEqual(mockData); // Expect received data to match mock data
    });

    const req = httpMock.expectOne('https://fakestoreapi.com/products');
    expect(req.request.method).toBe('GET'); // Expect a GET request to be made to the API

    req.flush(mockData); // Simulate a successful response from the API
  });

  // Add more tests as needed
});
