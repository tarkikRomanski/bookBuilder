import { Component, Input, OnInit } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-show',
  templateUrl: './book-show.component.html',
})
export class BookShowComponent {
  constructor() { }

  @Input() book: BookModel;

  getCorrectBase64(base64: string): string {
    return `data:image/jpeg;base64,${base64}`;
  }
}
