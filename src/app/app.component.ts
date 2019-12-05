import { Component } from '@angular/core';
import { BookModel } from '../models/book.model';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: [ './app.component.scss' ]
})
export class AppComponent {
  activeList = true;
  book: BookModel | null = null;

  showBook(book: BookModel): void {
    this.book = book;
    this.activeList = false;
  }

  backToList(): void {
    this.book = null;
    this.activeList = true;
  }
}
