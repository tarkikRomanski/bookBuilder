import { Component, EventEmitter, Input, Output } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-item',
  templateUrl: './book-item.component.html',
  styleUrls: [ './book-item.component.scss' ]
})
export class BookItemComponent {
  @Input() book: BookModel;

  @Output() giveId = new EventEmitter<number>();

  getCorrectBase64(base64: string): string {
    return `data:image/jpeg;base64,${base64}`;
  }
}
