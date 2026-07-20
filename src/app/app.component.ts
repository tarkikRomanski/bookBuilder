import { Component } from '@angular/core';
import { BookModel } from '../models/book.model';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
  standalone: false
})
export class AppComponent {
  activeList = true;
  book: BookModel | null = null;

  showBook(book: BookModel): void {
    this.book = book;
    this.activeList = false;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  backToList(): void {
    this.book = null;
    this.activeList = true;
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  onBookProgressUpdated(updatedBook: BookModel): void {
    if (this.book && this.book.uid === updatedBook.uid) {
      this.book = { ...updatedBook };
    }
  }
}
