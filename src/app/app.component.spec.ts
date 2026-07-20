import { TestBed, waitForAsync } from '@angular/core/testing';
import { AppComponent } from './app.component';
import { AppModule } from './app.module';

describe('AppComponent', () => {
  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      imports: [
        AppModule
      ],
    }).compileComponents();
  }));

  it('should create the app', () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    expect(app).toBeTruthy();
  });

  it('should default activeList to true', () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    expect(app.activeList).toBeTrue();
  });

  it('should set activeList to false when showing a book', () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    const testBook = {
      author: 'Test Author',
      description: 'Test Description',
      pages: 100,
      progress: 0,
      title: 'Test Title',
      uid: 1
    };
    app.showBook(testBook);
    expect(app.activeList).toBeFalse();
    expect(app.book).toEqual(testBook);
  });
});
