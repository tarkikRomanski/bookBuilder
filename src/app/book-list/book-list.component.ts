import { Component } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-list',
  templateUrl: './book-list.component.html'
})
export class BookListComponent {
  books: BookModel[] = [
    {
      author: 'Author 1',
      description: 'Description 1',
      pages: 12,
      progress: 0,
      title: 'Title 1',
      uid: 1,
    },
    {
      author: 'Author 2',
      description: 'Description 2',
      pages: 24,
      progress: 0,
      title: 'Title 2',
      uid: 2,
    },
    {
      author: 'Author 3',
      description: 'Description 3',
      pages: 48,
      progress: 0,
      title: 'Title 3',
      uid: 1,
    }
  ];
  active: boolean = false;

  updateProgress(progress: number) {
    alert(`U read ${progress} pages`);
  }
}
